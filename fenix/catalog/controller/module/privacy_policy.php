<?php
class ControllerModulePrivacyPolicy extends Controller {
	public function index() {
		$this->load->language('module/privacy_policy');
                
                if(!($this->config->get('privacy_policy_status') == 1))
                {
                    $this->response->redirect('/');
                }
                $this->document->setName($this->language->get('heading_title'));
                $this->document->setTitle($this->language->get('heading_title'));
                
                $data['text'] = html_entity_decode($this->config->get('privacy_policy_text'), ENT_QUOTES);
                
                $data['column_left'] = $this->load->controller('common/column_left');
                $data['column_right'] = $this->load->controller('common/column_right');
                $data['content_top'] = $this->load->controller('common/content_top');
                $data['content_bottom'] = $this->load->controller('common/content_bottom');
                $data['footer'] = $this->load->controller('common/footer');
                $data['header'] = $this->load->controller('common/header');
                        
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/privacy_policy.tpl')) {
                    $view = $this->load->view($this->config->get('config_template') . '/template/module/privacy_policy.tpl', $data);
                } else {
                    $view = $this->load->view('default/template/module/privacy_policy.tpl', $data);
                }
                return $this->response->setOutput($view);
	}
}