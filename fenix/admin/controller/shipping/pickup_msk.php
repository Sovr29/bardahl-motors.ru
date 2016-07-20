<?php
class ControllerShippingPickupMsk extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('shipping/pickup_msk');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('pickup_msk', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_none'] = $this->language->get('text_none');

		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_address'] = $this->language->get('entry_address');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_shipping'),
			'href' => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('shipping/pickup_msk', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('shipping/pickup_msk', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['pickup_msk_geo_zone_id'])) {
			$data['pickup_msk_geo_zone_id'] = $this->request->post['pickup_msk_geo_zone_id'];
		} else {
			$data['pickup_msk_geo_zone_id'] = $this->config->get('pickup_msk_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['pickup_msk_status'])) {
			$data['pickup_msk_status'] = $this->request->post['pickup_msk_status'];
		} else {
			$data['pickup_msk_status'] = $this->config->get('pickup_msk_status');
		}

		if (isset($this->request->post['pickup_msk_sort_order'])) {
			$data['pickup_msk_sort_order'] = $this->request->post['pickup_msk_sort_order'];
		} else {
			$data['pickup_msk_sort_order'] = $this->config->get('pickup_msk_sort_order');
		}
		
		if (isset($this->request->post['pickup_msk_address'])) {
			$data['pickup_msk_address'] = $this->request->post['pickup_msk_address'];
		} else {
			$data['pickup_msk_address'] = $this->config->get('pickup_msk_address');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('shipping/pickup_msk.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'shipping/pickup_msk')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}