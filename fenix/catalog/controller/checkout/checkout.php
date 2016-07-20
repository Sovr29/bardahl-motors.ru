<?php
class ControllerCheckoutCheckout extends Controller {
	public function index() {
		// Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$this->response->redirect($this->url->link('checkout/cart'));
		}

		// Validate minimum quantity requirements.
		$products = $this->cart->getProducts();

		foreach ($products as $product) {
			$product_total = 0;

			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}

			if ($product['minimum'] > $product_total) {
				$this->response->redirect($this->url->link('checkout/cart'));
			}
		}

		$this->load->language('checkout/checkout');

                $this->document->setName($this->language->get('heading_title'));
		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

		// Required by klarna
		if ($this->config->get('klarna_account') || $this->config->get('klarna_invoice')) {
			$this->document->addScript('http://cdn.klarna.com/public/kitt/toc/v1.0/js/klarna.terms.min.js');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_cart'),
			'href' => $this->url->link('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('checkout/checkout', '', 'SSL')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_checkout_option'] = $this->language->get('text_checkout_option');
		$data['text_checkout_account'] = $this->language->get('text_checkout_account');
		$data['text_checkout_payment_address'] = $this->language->get('text_checkout_payment_address');
		$data['text_checkout_shipping_address'] = $this->language->get('text_checkout_shipping_address');
		$data['text_checkout_shipping_method'] = $this->language->get('text_checkout_shipping_method');
		$data['text_checkout_payment_method'] = $this->language->get('text_checkout_payment_method');
		$data['text_checkout_confirm'] = $this->language->get('text_checkout_confirm');
		
		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_address_1'] = $this->language->get('entry_address_1');
		$data['entry_comment'] = $this->language->get('entry_comment');
		
                $data['column_image'] = $this->language->get('column_image');
                $data['column_name'] = $this->language->get('column_name');
                $data['column_model'] = $this->language->get('column_model');
                $data['column_quantity'] = $this->language->get('column_quantity');
                $data['column_price'] = $this->language->get('column_price');
                $data['column_total'] = $this->language->get('column_total');
                        
		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		} else {
			$data['error_warning'] = '';
		}

		$data['logged'] = $this->customer->isLogged();

		if (isset($this->session->data['account'])) {
			$data['account'] = $this->session->data['account'];
		} else {
			$data['account'] = '';
		}

		$data['shipping_required'] = $this->cart->hasShipping();

		if(isset($this->session->data['shipping_method']))
		{
			$data['shipping_type'] = explode('.', $this->session->data['shipping_method']['code'])[0];
			$data['shipping_code'] = explode('.', $this->session->data['shipping_method']['code'])[1];
		}
                else{
                    $this->response->redirect($this->url->link('checkout/cart'));
                }
		
                $this->document->addScriptText("
                    $('#input-payment-telephone').mask('+7 (999) 999-99-99');
                    $('from#createOrder').submit(function(){
                    if($(this).valid())
                    {
                     return true;
                    }
                    else
                    {
                     return false;
                    }
                });");
                $data['coupon'] = $this->load->controller('checkout/coupon');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
                
		$products = $this->cart->getProducts();
                
		foreach ($products as $product) {
			$product_total = 0;

			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}

			if ($product['minimum'] > $product_total) {
				$data['error_warning'] = sprintf($this->language->get('error_minimum'), $product['name'], $product['minimum']);
			}

			if ($product['image']) {
				$image = $this->model_tool_image->resize($product['image'], $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));
			} else {
				$image = '';
			}

			$option_data = array();

			foreach ($product['option'] as $option) {
				if ($option['type'] != 'file') {
					$value = $option['value'];
				} else {
					$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

					if ($upload_info) {
						$value = $upload_info['name'];
					} else {
						$value = '';
					}
				}

				$option_data[] = array(
					'name'  => $option['name'],
					'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value)
				);
			}

			// Display prices
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$price = false;
			}

			// Display prices
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']);
			} else {
				$total = false;
			}

			$recurring = '';

			if ($product['recurring']) {
				$frequencies = array(
					'day'        => $this->language->get('text_day'),
					'week'       => $this->language->get('text_week'),
					'semi_month' => $this->language->get('text_semi_month'),
					'month'      => $this->language->get('text_month'),
					'year'       => $this->language->get('text_year'),
				);

				if ($product['recurring']['trial']) {
					$recurring = sprintf($this->language->get('text_trial_description'), $this->currency->format($this->tax->calculate($product['recurring']['trial_price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax'))), $product['recurring']['trial_cycle'], $frequencies[$product['recurring']['trial_frequency']], $product['recurring']['trial_duration']) . ' ';
				}

				if ($product['recurring']['duration']) {
					$recurring .= sprintf($this->language->get('text_payment_description'), $this->currency->format($this->tax->calculate($product['recurring']['price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax'))), $product['recurring']['cycle'], $frequencies[$product['recurring']['frequency']], $product['recurring']['duration']);
				} else {
					$recurring .= sprintf($this->language->get('text_payment_cancel'), $this->currency->format($this->tax->calculate($product['recurring']['price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax'))), $product['recurring']['cycle'], $frequencies[$product['recurring']['frequency']], $product['recurring']['duration']);
				}
			}

			$data['products'][] = array(
				'key'       => $product['key'],
				'thumb'     => $image,
				'name'      => $product['name'],
				'model'     => $product['model'],
				'option'    => $option_data,
				'recurring' => $recurring,
				'quantity'  => $product['quantity'],
				'stock'     => $product['stock'] ? true : !(!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning')),
				'reward'    => ($product['reward'] ? sprintf($this->language->get('text_points'), $product['reward']) : ''),
				'price'     => $price,
				'total'     => $total,
				'href'      => $this->url->link('product/product', 'product_id=' . $product['product_id'])
			);
		}
                        
		$total_data = array();
		$total = 0;
		$taxes = $this->cart->getTaxes();

		// Display prices
		if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
			$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);

					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}

			$sort_order = array();

			foreach ($total_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $total_data);
		}

		$data['totals'] = array();

		foreach ($total_data as $total) {
			$data['totals'][] = array(
				'show_possible_discount' => isset($total['show_possible_discount']) ? $total['show_possible_discount'] : 0,
				'title' => $total['title'],
				'text'  => $this->currency->format($total['value'])
			);
		}
                        
		$data['cart'] = $this->url->link('checkout/cart');
		$data['formAction'] = $this->url->link('checkout/checkout/createOrder');
		
                if (isset($this->request->post['lastname'])) {
                    $data['lastname'] = $this->request->post['lastname'];
		} else {
                    $data['lastname'] = '';
		}
                
                if (isset($this->request->post['firstname'])) {
                    $data['firstname'] = $this->request->post['firstname'];
		} else {
                    $data['firstname'] = '';
		}
		
                if (isset($this->request->post['email'])) {
                    $data['email'] = $this->request->post['email'];
		} else {
                    $data['email'] = '';
		}
                
                if (isset($this->request->post['telephone'])) {
                    $data['telephone'] = $this->request->post['telephone'];
		} else {
                    $data['telephone'] = '';
		}
                
                if (isset($this->request->post['comment'])) {
                    $data['comment'] = $this->request->post['comment'];
		} else {
                    $data['comment'] = '';
		}
		
                if (isset($this->request->post['city'])) {
                    $data['city'] = $this->request->post['city'];
		} else {
                    $data['city'] = '';
		}
                
                if (isset($this->request->post['address_1'])) {
                    $data['address_1'] = $this->request->post['address_1'];
		} else {
                    $data['address_1'] = '';
		}
		
                if (isset($this->request->post['closed'])) {
                    $data['closed'] = $this->request->post['closed'];
		} else {
                    $data['closed'] = 0;
		}
                
		$this->setPayment();
		$data['payment_methods'] = $this->session->data['payment_methods'];
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/checkout.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/checkout/checkout.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/checkout/checkout.tpl', $data));
		}
	}
        
        public function setShipping() {
            $address_data = array(
                    'address_id'     => 0,
                    'firstname'      => '',
                    'lastname'       => '',
                    'company'        => '',
                    'address_1'      => '',
                    'address_2'      => '',
                    'postcode'       => '',
                    'city'           => '',
                    'zone_id'        => '',
                    'zone'           => '',
                    'zone_code'      => '',
                    'country_id'     => '',
                    'country'        => '',
                    'iso_code_2'     => '',
                    'iso_code_3'     => '',
                    'address_format' => '',
                    'custom_field'   => false,
            );
            $method_data = array();

            $this->load->model('extension/extension');

            $results = $this->model_extension_extension->getExtensions('shipping');

            foreach ($results as $result) {
                    if ($this->config->get($result['code'] . '_status')) {
                            $this->load->model('shipping/' . $result['code']);

                            $quote = $this->{'model_shipping_' . $result['code']}->getQuote($address_data);

                            if ($quote) {
                                    $method_data[$result['code']] = array(
                                            'title'      => $quote['title'],
                                            'quote'      => $quote['quote'],
                                            'sort_order' => isset($quote['sort_order']) ? $quote['sort_order'] : 999,
                                            'error'      => $quote['error']
                                    );
                            }
                    }
            }

            $sort_order = array();

            foreach ($method_data as $key => $value) {
                    $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $method_data);

            $this->session->data['shipping_methods'] = $method_data;
        }
        
        public function setPayment() {
            
            $address_data = array(
                    'address_id'     => 0,
                    'firstname'      => '',
                    'lastname'       => '',
                    'company'        => '',
                    'address_1'      => '',
                    'address_2'      => '',
                    'postcode'       => '',
                    'city'           => '',
                    'zone_id'        => '',
                    'zone'           => '',
                    'zone_code'      => '',
                    'country_id'     => '',
                    'country'        => '',
                    'iso_code_2'     => '',
                    'iso_code_3'     => '',
                    'address_format' => '',
                    'custom_field'   => false,
            );
            
            
            // Totals
            $total_data = array();
            $total = 0;
            $taxes = $this->cart->getTaxes();

            $this->load->model('extension/extension');

            $sort_order = array();

            $results = $this->model_extension_extension->getExtensions('total');

            foreach ($results as $key => $value) {
                    $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
            }

            array_multisort($sort_order, SORT_ASC, $results);

            foreach ($results as $result) {
                    if ($this->config->get($result['code'] . '_status')) {
                            $this->load->model('total/' . $result['code']);

                            $this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
                    }
            }

            // Payment Methods
            $method_data = array();

            $this->load->model('extension/extension');

            $results = $this->model_extension_extension->getExtensions('payment');

            $recurring = $this->cart->hasRecurringProducts();

            foreach ($results as $result) {
                    if ($this->config->get($result['code'] . '_status')) {
                            $this->load->model('payment/' . $result['code']);

                            $method = $this->{'model_payment_' . $result['code']}->getMethod($address_data, $total);

                            if ($method) {
                                    if ($recurring) {
                                            if (method_exists($this->{'model_payment_' . $result['code']}, 'recurringPayments') && $this->{'model_payment_' . $result['code']}->recurringPayments()) {
                                                    $method_data[$result['code']] = $method;
                                            }
                                    } else {
                                            $method_data[$result['code']] = $method;
                                    }
                            }
                    }
            }

            $sort_order = array();

            foreach ($method_data as $key => $value) {
                    $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $method_data);

            $this->session->data['payment_methods'] = $method_data;
        }


        public function createOrder() {
            
            $this->setShipping();
            $this->setPayment();
            $this->load->model('checkout/order');
                        
            
            $order_data = array();

            $order_data['totals'] = array();
            $total = 0;
            $taxes = $this->cart->getTaxes();

            $this->load->model('extension/extension');

            $sort_order = array();

            $results = $this->model_extension_extension->getExtensions('total');

            foreach ($results as $key => $value) {
                    $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
            }

            array_multisort($sort_order, SORT_ASC, $results);

            foreach ($results as $result) {
                    if ($this->config->get($result['code'] . '_status')) {
                            $this->load->model('total/' . $result['code']);

                            $this->{'model_total_' . $result['code']}->getTotal($order_data['totals'], $total, $taxes);
                    }
            }

            $sort_order = array();

            foreach ($order_data['totals'] as $key => $value) {
                    $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $order_data['totals']);

            $this->load->language('checkout/checkout');

            $order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
            $order_data['store_id'] = $this->config->get('config_store_id');
            $order_data['store_name'] = $this->config->get('config_name');

            if ($order_data['store_id']) {
                    $order_data['store_url'] = $this->config->get('config_url');
            } else {
                    $order_data['store_url'] = HTTP_SERVER;
            }

            
                    $order_data['customer_id'] = 0;
                    $order_data['customer_group_id'] = 0;
                    $order_data['firstname'] = $this->request->post['firstname'];
                    $order_data['lastname'] = $this->request->post['lastname'];
                    $order_data['email'] = $this->request->post['email'];
                    $order_data['telephone'] = $this->request->post['telephone'];
                    $order_data['fax'] = '';
                    $order_data['custom_field'] = NULL;
            

            $order_data['payment_firstname'] = $this->request->post['firstname'];
            $order_data['payment_lastname'] = $this->request->post['lastname'];
            $order_data['payment_company'] = 'не заполенно';
            $order_data['payment_address_1'] = 'не заполенно';
            $order_data['payment_address_2'] = 'не заполенно';
            $order_data['payment_city'] = 'не заполенно';
            $order_data['payment_postcode'] = 'не заполенно';
            $order_data['payment_zone'] = '50';
            $order_data['payment_zone_id'] = '50';
            $order_data['payment_country'] = 'не заполенно';
            $order_data['payment_country_id'] = '176';
            $order_data['payment_address_format'] = 'не заполенно';
            $order_data['payment_custom_field'] = (isset($this->session->data['payment_address']['custom_field']) ? $this->session->data['payment_address']['custom_field'] : array());
            
            $this->session->data['payment_method'] = $this->session->data['payment_methods'][$this->request->post['payMethod']];
            
            if (isset($this->session->data['payment_method']['title'])) {
                    $order_data['payment_method'] = $this->session->data['payment_method']['title'];
            } else {
                    $order_data['payment_method'] = '';
            }

            if (isset($this->session->data['payment_method']['code'])) {
                    $order_data['payment_code'] = $this->session->data['payment_method']['code'];
            } else {
                    $order_data['payment_code'] = '';
            }
            
            $order_data['shipping_firstname'] = $this->request->post['firstname'];
            $order_data['shipping_lastname'] = $this->request->post['lastname'];
            $order_data['shipping_company'] = 'не заполенно';
            $order_data['shipping_address_1'] = isset($this->request->post['address_1']) ? $this->request->post['address_1'] : 'не заполенно';
			$order_data['shipping_address_2'] = 'не заполенно';
			$order_data['shipping_city'] = isset($this->request->post['city']) ? $this->request->post['city'] : 'не заполенно';
			$order_data['shipping_postcode'] = 'не заполенно';
			$order_data['shipping_zone'] = '50';
			$order_data['shipping_zone_id'] = '50';
			$order_data['shipping_country'] = 'не заполенно';
			$order_data['shipping_country_id'] = '176';
			$order_data['shipping_address_format'] = 'не заполенно';
			$order_data['shipping_custom_field'] = (isset($this->session->data['shipping_address']['custom_field']) ? $this->session->data['shipping_address']['custom_field'] : array());
                    
			if(!isset($this->session->data['shipping_method']))
			{
				$this->session->data['shipping_method'] = $this->session->data['shipping_methods']['pickup']['quote']['pickup_msk'];
			}
            if (isset($this->session->data['shipping_method']['title'])) {
            	$order_data['shipping_method'] = $this->session->data['shipping_method']['address'];
            } else {
            	$order_data['shipping_method'] = '';
            }

            if (isset($this->session->data['shipping_method']['code'])) {
            	$order_data['shipping_code'] = $this->session->data['shipping_method']['code'];
            } else {
            	$order_data['shipping_code'] = '';
			}

            $order_data['products'] = array();

            foreach ($this->cart->getProducts() as $product) {
                    $option_data = array();

                    foreach ($product['option'] as $option) {
                            $option_data[] = array(
                                    'product_option_id'       => $option['product_option_id'],
                                    'product_option_value_id' => $option['product_option_value_id'],
                                    'option_id'               => $option['option_id'],
                                    'option_value_id'         => $option['option_value_id'],
                                    'name'                    => $option['name'],
                                    'value'                   => $option['value'],
                                    'type'                    => $option['type']
                            );
                    }

                    $order_data['products'][] = array(
                            'product_id' => $product['product_id'],
                            'name'       => $product['name'],
                            'model'      => $product['model'],
                            'option'     => $option_data,
                            'download'   => $product['download'],
                            'quantity'   => $product['quantity'],
                            'subtract'   => $product['subtract'],
                            'price'      => $product['price'],
                            'total'      => $product['total'],
                            'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']),
                            'reward'     => $product['reward'],
                            'sku'        => $product['sku']
                    );
            }

            // Gift Voucher
            $order_data['vouchers'] = array();

            if (!empty($this->session->data['vouchers'])) {
                    foreach ($this->session->data['vouchers'] as $voucher) {
                            $order_data['vouchers'][] = array(
                                    'description'      => $voucher['description'],
                                    'code'             => substr(md5(mt_rand()), 0, 10),
                                    'to_name'          => $voucher['to_name'],
                                    'to_email'         => $voucher['to_email'],
                                    'from_name'        => $voucher['from_name'],
                                    'from_email'       => $voucher['from_email'],
                                    'voucher_theme_id' => $voucher['voucher_theme_id'],
                                    'message'          => $voucher['message'],
                                    'amount'           => $voucher['amount']
                            );
                    }
            }
            
            $order_data['comment'] = strip_tags($this->request->post['comment']);
            
            $order_data['total'] = $total;

            if (isset($this->request->cookie['tracking'])) {
                    $order_data['tracking'] = $this->request->cookie['tracking'];

                    $subtotal = $this->cart->getSubTotal();

                    // Affiliate
                    $this->load->model('affiliate/affiliate');

                    $affiliate_info = $this->model_affiliate_affiliate->getAffiliateByCode($this->request->cookie['tracking']);

                    if ($affiliate_info) {
                            $order_data['affiliate_id'] = $affiliate_info['affiliate_id'];
                            $order_data['commission'] = ($subtotal / 100) * $affiliate_info['commission'];
                    } else {
                            $order_data['affiliate_id'] = 0;
                            $order_data['commission'] = 0;
                    }

                    // Marketing
                    $this->load->model('checkout/marketing');

                    $marketing_info = $this->model_checkout_marketing->getMarketingByCode($this->request->cookie['tracking']);

                    if ($marketing_info) {
                            $order_data['marketing_id'] = $marketing_info['marketing_id'];
                    } else {
                            $order_data['marketing_id'] = 0;
                    }
            } else {
                    $order_data['affiliate_id'] = 0;
                    $order_data['commission'] = 0;
                    $order_data['marketing_id'] = 0;
                    $order_data['tracking'] = '';
            }

            $order_data['language_id'] = $this->config->get('config_language_id');
            $order_data['currency_id'] = $this->currency->getId();
            $order_data['currency_code'] = $this->currency->getCode();
            $order_data['currency_value'] = $this->currency->getValue($this->currency->getCode());
            $order_data['ip'] = $this->request->server['REMOTE_ADDR'];

            if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
                    $order_data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
            } elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
                    $order_data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
            } else {
                    $order_data['forwarded_ip'] = '';
            }

            if (isset($this->request->server['HTTP_USER_AGENT'])) {
                    $order_data['user_agent'] = $this->request->server['HTTP_USER_AGENT'];
            } else {
                    $order_data['user_agent'] = '';
            }

            if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
                    $order_data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
            } else {
                    $order_data['accept_language'] = '';
            }

            $this->load->model('checkout/order');
            $this->session->data['order_id'] = $this->model_checkout_order->addOrder($order_data);
            
            try{
                if(
                    $order_data['shipping_code'] != 'delivery.vrn'
                    &&
                    $order_data['shipping_code'] != 'delivery.tula'
                    &&
                    $order_data['shipping_code'] != 'delivery.spb'
                    &&
                    $order_data['shipping_code'] != 'pickup.pickup_tula'
                    &&
                    $order_data['shipping_code'] != 'pickup.pickup_vrn'
                    &&
                    $order_data['shipping_code'] != 'pickup.pickup_spb_2'
                    &&
                    $order_data['shipping_code'] != 'pickup.pickup_spb'
                )
                {
                    $this->load->model('module/ms');
                    $this->model_module_ms->addOrder($order_data);
                }
            }
            catch(Exception $e){}
            
            $this->model_checkout_order->addOrderHistory($this->session->data['order_id'], 1, '', 1);
            
            if ($this->request->post['payMethod'] == 'unitpay') {
                $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        
		$data['unitpay_login'] = $this->config->get('unitpay_login');
                $data['unitpay_key']= $this->config->get('unitpay_key');

		// Номер заказа
		$data['inv_id'] = $this->session->data['order_id'];

		// Комментарий к заказу
		$data['inv_desc'] = 'Оплата заказа №'. $this->session->data['order_id'];

		// Сумма заказа
		$rur_code = 'RUB';
		$rur_order_total = $this->currency->convert($order_info['total'], $order_info['currency_code'], $rur_code);
		$data['out_summ'] = $this->currency->format($rur_order_total, $rur_code, $order_info['currency_value'], FALSE);
                $data['action']="https://unitpay.ru/pay/";
                $data['sign'] = md5($data['inv_id']."RUB".$data['inv_desc'].$data['out_summ'].$data['unitpay_key']);
		// Кодировка
		//$data['encoding'] = "utf-8";

		
		$data['merchant_url'] = $data['action'] .
				$data['unitpay_login'] .
				'?sum='			. $data['out_summ'] .
                                '&currency='		. $rur_code .
				'&account='		. $data['inv_id'].
				'&desc='		. $data['inv_desc'].
                                '&sign='                . $data['sign'];
			
                $this->response->redirect($data['merchant_url']);
            }
            if ($this->request->post['payMethod'] == 'robocassa') {
                
                $mrh_login = $this->config->get('robocassa_key1');
                $mrh_pass1 = $this->config->get('robocassa_key2');

                // номер заказа
                // number of order
                $inv_id = $this->session->data['order_id'];

                // описание заказа
                // order description
                $inv_desc = "ROBOKASSA Advanced User Guide";

                // сумма заказа
                // sum of order
                $out_summ = $order_data['total'];

                // тип товара$order_data['products']
                // code of goods
                $shp_item = "2";

                // предлагаемая валюта платежа
                // default payment e-currency
                $in_curr = "";

                // язык
                // language
                $culture = "ru";
                
                $url = 'https://merchant.roboxchange.com/Index.aspx';
                
                if ($this->config->get('robocassa_test')) {
                    $url = 'http://test.robokassa.ru/Index.aspx';
                }
                
                

                // формирование подписи
                // generate signature
                $crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item");
                print "<html>".
                    "<form id='myForm' action='$url' method=POST>".
                    "<input type=hidden name=MrchLogin value=$mrh_login>".
                    "<input type=hidden name=OutSum value=$out_summ>".
                    "<input type=hidden name=InvId value=$inv_id>".
                    "<input type=hidden name=Desc value='$inv_desc'>".
                    "<input type=hidden name=SignatureValue value=$crc>".
                    "<input type=hidden name=Shp_item value='$shp_item'>".
                    "<input type=hidden name=IncCurrLabel value=$in_curr>".
                    "<input type=hidden name=Culture value=$culture>".
                    "<input type=submit value='Pay'>".
                    "</form></html>".
                    "<script>window.onload = function() {   document.getElementById(\"myForm\").submit();}</script>";             
                
            } else {
                 $this->response->redirect($this->url->link('checkout/success'));
            }
            
           
            
        }

        public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function customfield() {
		$json = array();

		$this->load->model('account/custom_field');

		// Customer Group
		if (isset($this->request->get['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->get['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $this->request->get['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

		foreach ($custom_fields as $custom_field) {
			$json[] = array(
				'custom_field_id' => $custom_field['custom_field_id'],
				'required'        => $custom_field['required']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}