<?php
class ControllerModuleArticles extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/articles');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
                
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('articles', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

                $data['token'] = $this->session->data['token'];
                
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
                
                $data['entry_status'] = $this->language->get('entry_status');
                $data['entry_meta_description'] = $this->language->get('entry_meta_description');
                $data['entry_meta_keywords'] = $this->language->get('entry_meta_keywords');
                $data['entry_exclude'] = $this->language->get('entry_exclude');
                
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
			'href' => $this->url->link('module/articles', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/articles', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

                if (isset($this->request->post['articles_status'])) {
			$data['articles_status'] = $this->request->post['articles_status'];
		} else {
			$data['articles_status'] = $this->config->get('articles_status');
		}
                
                if (isset($this->request->post['articles_meta_description'])) {
			$data['articles_meta_description'] = $this->request->post['articles_meta_description'];
		} else {
			$data['articles_meta_description'] = $this->config->get('articles_meta_description');
		}
                
                if (isset($this->request->post['articles_meta_keywords'])) {
			$data['articles_meta_keywords'] = $this->request->post['articles_meta_keywords'];
		} else {
			$data['articles_meta_keywords'] = $this->config->get('articles_meta_keywords');
		}
                
                $this->load->model('catalog/information');
                
                if (isset($this->request->post['articles_exclude'])) {
			$data['articles_exclude'] = $this->request->post['articles_exclude'];
		} else {
			$data['articles_exclude'] = $this->config->get('articles_exclude');
		}
                
                if(isset($data['articles_exclude'])){
                    foreach ($data['articles_exclude'] as $article_id) {
                            $article_info = $this->model_catalog_information->getInformationDescriptions($article_id)[1];

                            if ($article_info) {
                                    $data['articles'][] = array(
                                            'article_id' => $article_id,
                                            'name'       => $article_info['title']
                                    );
                            }
                    }
                }
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/articles.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/articles')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
                
		return !$this->error;
	}
}