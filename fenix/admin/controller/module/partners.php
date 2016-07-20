<?php
class ControllerModulePartners extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/partners');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('partners', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['entry_status'] = $this->language->get('entry_status');

                $data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keywords'] = $this->language->get('entry_meta_keyword');
                
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
			'href' => $this->url->link('module/partners', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/partners', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['partners_status'])) {
			$data['partners_status'] = $this->request->post['partners_status'];
		} else {
			$data['partners_status'] = $this->config->get('partners_status');
		}
		
                if (isset($this->request->post['partners_description'])) {
			$data['partners_description'] = $this->request->post['partners_description'];
		} else {
			$data['partners_description'] = $this->config->get('partners_description');
		}
                
                if (isset($this->request->post['partners_keywords'])) {
			$data['partners_keywords'] = $this->request->post['partners_keywords'];
		} else {
			$data['partners_keywords'] = $this->config->get('partners_keywords');
		}
                
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/partners.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/partners')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "partner` (
		  `partner_id` int(11) NOT NULL AUTO_INCREMENT,
		  `image` varchar(255) NOT NULL,
		  `date_added` datetime NOT NULL,
		  `status` tinyint(1) NOT NULL,
                  `type` int NOT NULL,
                  `href` varchar(255) NULL,
                  `fb` varchar(255) NULL,
                  `vk` varchar(255) NULL,
                  `insta` varchar(255) NULL,
                  `sort_order` int NULL,
		  PRIMARY KEY (`partner_id`)
		)");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "partner_description` (
		  `partner_description_id` int(11) NOT NULL AUTO_INCREMENT,
		  `partner_id` int(11) NOT NULL,
		  `language_id` int(11) NOT NULL,
		  `title` varchar(255) COLLATE utf8_bin NOT NULL,
		  `address` varchar(255) COLLATE utf8_bin NOT NULL,
		  `phone` varchar(255) COLLATE utf8_bin NOT NULL,
		  PRIMARY KEY (`partner_description_id`)
		)");
		
		$this->load->model('user/user_group');

		$this->model_user_user_group->addPermission($this->user->getId(), 'access', 'extension/news');
		$this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'extension/news');
	}
	
	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "partner`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "partner_description`");
	}
}