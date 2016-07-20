<?php
class ControllerShippingSelectedTK extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('shipping/selectedTK');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('selectedTK', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_none'] = $this->language->get('text_none');

		$data['entry_rate'] = $this->language->get('entry_rate');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
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
			'href' => $this->url->link('shipping/selectedTK', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('shipping/selectedTK', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['selectedTK_rate'])) {
			$data['selectedTK_rate'] = $this->request->post['selectedTK_rate'];
		} elseif ($this->config->get('selectedTK_rate')) {
			$data['selectedTK_rate'] = $this->config->get('selectedTK_rate');
		} else {
			$data['selectedTK_rate'] = '8000:500';
		}

		if (isset($this->request->post['selectedTK_geo_zone_id'])) {
			$data['selectedTK_geo_zone_id'] = $this->request->post['selectedTK_geo_zone_id'];
		} else {
			$data['selectedTK_geo_zone_id'] = $this->config->get('selectedTK_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['selectedTK_status'])) {
			$data['selectedTK_status'] = $this->request->post['selectedTK_status'];
		} else {
			$data['selectedTK_status'] = $this->config->get('selectedTK_status');
		}

		if (isset($this->request->post['selectedTK_sort_order'])) {
			$data['selectedTK_sort_order'] = $this->request->post['selectedTK_sort_order'];
		} else {
			$data['selectedTK_sort_order'] = $this->config->get('selectedTK_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('shipping/selectedTK.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'shipping/selectedTK')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}