<?php
class ControllerModuleBmClub extends Controller {
	private $error = array();

	public function index() {
            $this->load->language('module/bm_club');

            $this->document->setTitle($this->language->get('heading_title'));

            $this->load->model('setting/setting');

            if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                $this->model_setting_setting->editSetting('bm_club', $this->request->post);

                $this->session->data['success'] = $this->language->get('text_success');

                $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
            }

            $data['token'] = $this->session->data['token'];

            $data['heading_title'] = $this->language->get('heading_title');

            $data['text_edit'] = $this->language->get('text_edit');
            $data['text_enabled'] = $this->language->get('text_enabled');
            $data['text_disabled'] = $this->language->get('text_disabled');

            $data['entry_category'] = $this->language->get('entry_category');
            $data['entry_status'] = $this->language->get('entry_status');

            $data['button_save'] = $this->language->get('button_save');
            $data['button_cancel'] = $this->language->get('button_cancel');

            if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
            } else {
                $data['error_warning'] = '';
            }

            if (isset($this->error['category'])) {
                $data['error_category'] = $this->error['category'];
            } else {
                $data['error_category'] = '';
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
                    'href' => $this->url->link('module/bm_club', 'token=' . $this->session->data['token'], 'SSL')
            );

            $data['action'] = $this->url->link('module/bm_club', 'token=' . $this->session->data['token'], 'SSL');

            $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

            if (isset($this->request->post['bm_club_category'])) {
                    $data['bm_club_category'] = $this->request->post['bm_club_category'];
            } else {
                    $data['bm_club_category'] = $this->config->get('bm_club_category');
            }
            
            if (isset($this->request->post['bm_club_status'])) {
                $data['bm_club_status'] = $this->request->post['bm_club_status'];
            } else {
                $data['bm_club_status'] = $this->config->get('bm_club_status');
            }

            $this->load->model('catalog/category');
            
            $filter_data = array(
                'filter_status'  => 0,
            );
            
            $data['categories'] = $this->model_catalog_category->getCategories($filter_data);
            
            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('module/bm_club.tpl', $data));
	}

	protected function validate() {
            if (!$this->user->hasPermission('modify', 'module/bm_club')) {
                    $this->error['warning'] = $this->language->get('error_permission');
            }
            
            if (!$this->request->post['bm_club_category']) {
                $this->error['category'] = $this->language->get('error_category');
            }
                
            return !$this->error;
	}
}