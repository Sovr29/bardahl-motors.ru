<?php
class ControllerCheckout2Coupon extends Controller {
	public function index() {
		if ($this->config->get('coupon_status')) {
			$this->load->language('checkout2/coupon');

			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_loading'] = $this->language->get('text_loading');

			$data['entry_coupon'] = $this->language->get('entry_coupon');

			$data['button_coupon'] = $this->language->get('button_coupon');

			if (isset($this->session->data['coupon'])) {
				$data['coupon'] = $this->session->data['coupon'];
			} else {
				$data['coupon'] = '';
			}

			if (isset($this->request->get['redirect']) && !empty($this->request->get['redirect'])) {
				$data['redirect'] = $this->request->get['redirect'];
			} else {
				$data['redirect'] = $this->url->link('checkout2/cart');
			}
                        
                        /*
                        $this->document->addScriptText("
                        $('#button-coupon').on('click', function() {
                                $.ajax({
                                        url: 'index.php?route=checkout2/coupon/coupon',
                                        type: 'post',
                                        data: 'coupon=' + encodeURIComponent($('input[name=\'coupon\']').val()),
                                        dataType: 'json',
                                        beforeSend: function() {
                                                $('#button-coupon').button('loading');
                                        },
                                        complete: function() {
                                                $('#button-coupon').button('reset');
                                        },
                                        success: function(json) {
                                                $('.alert').remove();

                                                if (json['error']) {
                                                        $('#createOrder').before('<div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error'] + '<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');

                                                        $('html, body').animate({ scrollTop: 0 }, 'slow');
                                                }

                                                if (json['redirect']) {
                                                        location = json['redirect'];
                                                }
                                        }
                                });
                        });");
                        */
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout2/coupon.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/checkout2/coupon.tpl', $data);
			} else {
				return $this->load->view('default/template/checkout2/coupon.tpl', $data);
			}
		}
	}

	public function coupon() {
		$this->load->language('checkout2/coupon');

		$json = array();

		$this->load->model('checkout2/coupon');

		if (isset($this->request->get['coupon'])) {
			$coupon = $this->request->get['coupon'];
		} else {
			$coupon = '';
		}

		$coupon_info = $this->model_checkout2_coupon->getCoupon($coupon);

		if (empty($this->request->get['coupon'])) {
			$json['error'] = $this->language->get('error_empty');
			
			unset($this->session->data['coupon']);
		} elseif ($coupon_info) {
			$this->session->data['coupon'] = $this->request->get['coupon'];

			$this->session->data['success'] = $this->language->get('text_success');

			$json['redirect'] = $this->url->link('checkout2/checkout2');
		} else {
			$json['error'] = $this->language->get('error_coupon');
		}
                
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
