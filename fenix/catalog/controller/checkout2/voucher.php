<?php
class ControllerCheckout2Voucher extends Controller {
	public function index() {
		if ($this->config->get('voucher_status')) {
			$this->load->language('checkout2/voucher');

			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_loading'] = $this->language->get('text_loading');

			$data['entry_voucher'] = $this->language->get('entry_voucher');

			$data['button_voucher'] = $this->language->get('button_voucher');

			if (isset($this->session->data['voucher'])) {
				$data['voucher'] = $this->session->data['voucher'];
			} else {
				$data['voucher'] = '';
			}

			if (isset($this->request->get['redirect']) && !empty($this->request->get['redirect'])) {
				$data['redirect'] = $this->request->get['redirect'];
			} else {
				$data['redirect'] = $this->url->link('checkout2/cart');
			}

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout2/voucher.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/checkout2/voucher.tpl', $data);
			} else {
				return $this->load->view('default/template/checkout2/voucher.tpl', $data);
			}
		}
	}

	public function voucher() {
		$this->load->language('checkout2/voucher');

		$json = array();

		$this->load->model('checkout2/voucher');

		if (isset($this->request->post['voucher'])) {
			$voucher = $this->request->post['voucher'];
		} else {
			$voucher = '';
		}

		$voucher_info = $this->model_checkout2_voucher->getVoucher($voucher);

		if (empty($this->request->post['voucher'])) {
			$json['error'] = $this->language->get('error_empty');
		} elseif ($voucher_info) {
			$this->session->data['voucher'] = $this->request->post['voucher'];

			$this->session->data['success'] = $this->language->get('text_success');

			$json['redirect'] = $this->url->link('checkout2/cart');
		} else {
			$json['error'] = $this->language->get('error_voucher');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}