<?php
class ControllerCheckoutShippingMethod extends Controller {
	public function index() {
		$this->load->language('checkout/checkout');
				if(!isset($this->request->get['isAjax'])) {
					$isAjax = 0;
				}
				else{
					$isAjax = (int)$this->request->get['isAjax'];
				}
		// Shipping Methods
                $method_data = array();

                $this->load->model('extension/extension');

                $results = $this->model_extension_extension->getExtensions('shipping');

                foreach ($results as $result) {
                        if ($this->config->get($result['code'] . '_status')) {
                                $this->load->model('shipping/' . $result['code']);

                                $quote = $this->{'model_shipping_' . $result['code']}->getQuote(isset($this->session->data['shipping_address']) ? $this->session->data['shipping_address'] : '');

                                if ($quote) {
										$quote['sort_order'] = (isset($quote['sort_order']) ? $quote['sort_order'] : 999);
                                        if(!isset($method_data[$quote['code']]))
                                        {
                                                $method_data[$quote['code']] = array(
                                                                'title'      => $quote['title'],
                                                                'quote'      => $quote['quote'],
                                                                'sort_order' => $quote['sort_order'],
                                                                'error'      => $quote['error']
                                                );
                                        }
                                        else
                                        {
                                                $method_data[$quote['code']]['sort_order'] = ($method_data[$quote['code']]['sort_order'] < $quote['sort_order'] ? $method_data[$quote['code']]['sort_order'] : $quote['sort_order']);
                                                $method_data[$quote['code']]['quote'] = array_merge($method_data[$quote['code']]['quote'], $quote['quote']);
                                        }
                                }
                        }
                }

                $sort_order = array();

                if(isset($method_data['pickup']) && isset($method_data['pickup']['quote'])){
                        foreach ($method_data['pickup']['quote'] as $key => $value) {
                                $sort_order[$key] = isset($value['sort_order']) ? $value['sort_order'] : 999;
                        }
                        array_multisort($sort_order, SORT_ASC, $method_data['pickup']['quote']);
                }

                $sort_order = array();
                if(isset($method_data['delivery']) && isset($method_data['delivery']['quote'])){
                        foreach ($method_data['delivery']['quote'] as $key => $value) {
                                $sort_order[$key] = $value['sort_order'];
                        }
                        array_multisort($sort_order, SORT_ASC, $method_data['delivery']['quote']);
                }

                $data['shipping_methods'] = $method_data;
                $this->session->data['shipping_methods'] = $method_data;

				if(isset($this->session->data['shipping_method'])){
					$data['shipping_method_selected'] = $this->session->data['shipping_method'];
                }
				else {
					$data['shipping_method_selected'] = $method_data['pickup']['quote']['pickup_msk'];
					$this->session->data['shipping_method'] = $method_data['pickup']['quote']['pickup_msk'];
                }
                $view = '';
                $data['isAjax'] = $isAjax;
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/shipping_method.tpl')) {
                    $view = $this->load->view($this->config->get('config_template') . '/template/checkout/shipping_method.tpl', $data);
                } else {
                    $view = $this->load->view('default/template/checkout/shipping_method.tpl', $data);
                }
                if(isset($isAjax) && $isAjax > 0)
                {
                    return $this->response->setOutput($view);
                }
                else{
                    return $view;
                }
	}

	public function save() {
		$this->load->language('checkout/checkout');

		$json = array();

		// Validate if shipping is required. If not the customer should not have reached this page.
		if (!$this->cart->hasShipping()) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
		}

		// Validate if shipping address has been set.
		if (!isset($this->session->data['shipping_address'])) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
		}

		// Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$json['redirect'] = $this->url->link('checkout/cart');
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
				$json['redirect'] = $this->url->link('checkout/cart');

				break;
			}
		}

		if (!isset($this->request->post['shipping_method'])) {
			$json['error']['warning'] = $this->language->get('error_shipping');
		} else {
			$shipping = explode('.', $this->request->post['shipping_method']);

			if (!isset($shipping[0]) || !isset($shipping[1]) || !isset($this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]])) {
				$json['error']['warning'] = $this->language->get('error_shipping');
			}
		}

		if (!$json) {
			$this->session->data['shipping_method'] = $this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]];

			$this->session->data['comment'] = strip_tags($this->request->post['comment']);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}