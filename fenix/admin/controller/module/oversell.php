<?php
class ControllerModuleOverSell extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/oversell');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                    $this->model_setting_setting->editSetting('oversell', $this->request->post);
                    $this->session->data['success'] = $this->language->get('text_success');
                    $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_product'] = $this->language->get('entry_product');
                $data['entry_text'] = $this->language->get('entry_text');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_status'] = $this->language->get('entry_status');
                
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
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

                $data['breadcrumbs'][] = array(
                        'text' => $this->language->get('heading_title'),
                        'href' => $this->url->link('module/oversell', 'token=' . $this->session->data['token'], 'SSL')
                );

                $data['action'] = $this->url->link('module/oversell', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];

		$this->load->model('catalog/product');

		$data['products'] = array();

		if (isset($this->request->post['oversell_products'])) {
			$products = $this->request->post['oversell_products'];
		} else {
			$products = $this->config->get('oversell_products');
		}

		foreach ($products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);

			if ($product_info) {
				$data['products'][] = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name']
				);
			}
		}

                if (isset($this->request->post['oversell_text'])) {
			$data['oversell_text'] = $this->request->post['oversell_text'];
		} else {
			$data['oversell_text'] = $this->config->get('oversell_text');
		}
                
		if (isset($this->request->post['oversell_limit'])) {
			$data['limit'] = $this->request->post['oversell_limit'];
		} else {
			$data['limit'] = $this->config->get('oversell_limit');
		}
                
		if (isset($this->request->post['oversell_status'])) {
			$data['status'] = $this->request->post['oversell_status'];
		} else {
			$data['status'] = $this->config->get('oversell_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/oversell.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/oversell')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;
	}
}