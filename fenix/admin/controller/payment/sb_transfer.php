<?php
class ControllerPaymentSbTransfer extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/sb_transfer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('sb_transfer', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');

		$data['entry_payable'] = $this->language->get('entry_payable');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['help_total'] = $this->language->get('help_total');

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
			'href' => $this->url->link('payment/sb_transfer', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('payment/sb_transfer', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['sb_transfer_payable'])) {
			$data['sb_transfer_payable'] = $this->request->post['sb_transfer_payable'];
		} else {
			$data['sb_transfer_payable'] = $this->config->get('sb_transfer_payable');
		}

		if (isset($this->request->post['sb_transfer_total'])) {
			$data['sb_transfer_total'] = $this->request->post['sb_transfer_total'];
		} else {
			$data['sb_transfer_total'] = $this->config->get('sb_transfer_total');
		}

		if (isset($this->request->post['sb_transfer_order_status_id'])) {
			$data['sb_transfer_order_status_id'] = $this->request->post['sb_transfer_order_status_id'];
		} else {
			$data['sb_transfer_order_status_id'] = $this->config->get('sb_transfer_order_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['sb_transfer_geo_zone_id'])) {
			$data['sb_transfer_geo_zone_id'] = $this->request->post['sb_transfer_geo_zone_id'];
		} else {
			$data['sb_transfer_geo_zone_id'] = $this->config->get('sb_transfer_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['sb_transfer_status'])) {
			$data['sb_transfer_status'] = $this->request->post['sb_transfer_status'];
		} else {
			$data['sb_transfer_status'] = $this->config->get('sb_transfer_status');
		}

		if (isset($this->request->post['sb_transfer_sort_order'])) {
			$data['sb_transfer_sort_order'] = $this->request->post['sb_transfer_sort_order'];
		} else {
			$data['sb_transfer_sort_order'] = $this->config->get('sb_transfer_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/sb_transfer.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/sb_transfer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['sb_transfer_payable']) {
			$this->error['payable'] = $this->language->get('error_payable');
		}

		return !$this->error;
	}
}