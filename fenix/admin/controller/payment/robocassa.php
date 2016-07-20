<?php
class ControllerPaymentRobocassa extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/robocassa');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('robocassa', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_payable'] = $this->language->get('entry_payable');
		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
                $data['entry_key1'] = $this->language->get('entry_key1');
                $data['entry_key2'] = $this->language->get('entry_key2');
                $data['entry_key3'] = $this->language->get('entry_key3');
                $data['entry_test'] = $this->language->get('entry_test');


		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['payable'])) {
			$data['error_payable'] = $this->error['payable'];
		} else {
			$data['error_payable'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_payment'),
			'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('payment/robocassa', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('payment/robocassa', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

	
		

		if (isset($this->request->post['robocassa_order_status_id'])) {
			$data['robocassa_order_status_id'] = $this->request->post['robocassa_order_status_id'];
		} else {
			$data['robocassa_order_status_id'] = $this->config->get('robocassa_order_status_id');
		}
                
                if (isset($this->request->post['robocassa_key1'])) {
			$data['robocassa_key1'] = $this->request->post['robocassa_key1'];
		} else {
			$data['robocassa_key1'] = $this->config->get('robocassa_key1');
		}
                
                if (isset($this->request->post['robocassa_key2'])) {
			$data['robocassa_key2'] = $this->request->post['robocassa_key2'];
		} else {
			$data['robocassa_key2'] = $this->config->get('robocassa_key2');
		}
                
                if (isset($this->request->post['robocassa_key3'])) {
			$data['robocassa_key3'] = $this->request->post['robocassa_key3'];
		} else {
			$data['robocassa_key3'] = $this->config->get('robocassa_key3');
		}
                
                if (isset($this->request->post['robocassa_test'])) {
			$data['robocassa_test'] = $this->request->post['robocassa_test'];
		} else {
			$data['robocassa_test'] = $this->config->get('robocassa_test');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		
		if (isset($this->request->post['robocassa_status'])) {
			$data['robocassa_status'] = $this->request->post['robocassa_status'];
		} else {
			$data['robocassa_status'] = $this->config->get('robocassa_status');
		}

		if (isset($this->request->post['robocassa_sort_order'])) {
			$data['robocassa_sort_order'] = $this->request->post['robocassa_sort_order'];
		} else {
			$data['robocassa_sort_order'] = $this->config->get('robocassa_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/robocassa.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/robocassa')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		

		return !$this->error;
	}
}