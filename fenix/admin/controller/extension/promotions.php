<?php
class ControllerExtensionPromotions extends Controller {
	private $error = array();
	
	public function index() {
		$this->language->load('extension/promotions');
		
		$this->load->model('extension/promotions');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$url = '';
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/promotions', 'token=' . $this->session->data['token'] . $url, 'SSL')
   		);
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->error['warning'])) {
			$data['error'] = $this->error['warning'];
		
			unset($this->error['warning']);
		} else {
			$data['error'] = '';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else { 
			$page = 1;
		}
		
		$url = '';
		
		$filter_data = array(
			'page' => $page,
			'limit' => $this->config->get('config_limit_admin'),
			'start' => $this->config->get('config_limit_admin') * ($page - 1),
		);
		
		$total = $this->model_extension_promotions->getTotalPromotions();
		
		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($total - $this->config->get('config_limit_admin'))) ? $total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $total, ceil($total / $this->config->get('config_limit_admin')));

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_title'] = $this->language->get('text_title');
		$data['text_short_description'] = $this->language->get('text_short_description');
		$data['text_date'] = $this->language->get('text_date');
		$data['text_action'] = $this->language->get('text_action');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
                $data['text_dates'] = $this->language->get('text_dates');
		$data['text_show_on_main_page'] = $this->language->get('text_show_on_main_page');
                $data['text_yes'] = $this->language->get('text_yes');
                $data['text_no'] = $this->language->get('text_no');
                
		$data['button_add'] = $this->language->get('button_add');
		$data['button_delete'] = $this->language->get('button_delete');
		
		$url = '';
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['add'] = $this->url->link('extension/promotions/insert', '&token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('extension/promotions/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		$data['all_promotions'] = array();
		
		$all_promotions = $this->model_extension_promotions->getAllPromotions($filter_data);
		
		foreach ($all_promotions as $promotion) {
			$data['all_promotions'][] = array (
				'promotion_id' 			=> $promotion['promotion_id'],
				'title' 			=> $promotion['title'],
				'short_description'	=> $promotion['short_description'],
                                'show_on_main_page'	=> $promotion['show_on_main_page'],
				'date_added' 		=> date($this->language->get('date_format_short'), strtotime($promotion['date_added'])),
				'edit' 				=> $this->url->link('extension/promotions/edit', 'promotion_id=' . $promotion['promotion_id'] . '&token=' . $this->session->data['token'] . $url, 'SSL')
			);
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/promotions_list.tpl', $data));	
	}
	
	public function edit() {
		$this->language->load('extension/promotions');
		
		$this->load->model('extension/promotions');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_extension_promotions->editPromotion($this->request->get['promotion_id'], $this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/promotions', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->form();
	}
	
	public function insert() {
		$this->language->load('extension/promotions');
		
		$this->load->model('extension/promotions');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_extension_promotions->addPromotion($this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/promotions', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->form();
	}
	
	protected function form() {
		$this->language->load('extension/promotions');
		
		$this->load->model('extension/promotions');
		
		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/promotions', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		if (isset($this->request->get['promotion_id'])) {
			$data['action'] = $this->url->link('extension/promotions/edit', '&promotion_id=' . $this->request->get['promotion_id'] . '&token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('extension/promotions/insert', '&token=' . $this->session->data['token'], 'SSL');
		}
		
		$data['cancel'] = $this->url->link('extension/promotions', '&token=' . $this->session->data['token'], 'SSL');
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_image'] = $this->language->get('text_image');
		$data['text_title'] = $this->language->get('text_title');
		$data['text_description'] = $this->language->get('text_description');
		$data['text_short_description'] = $this->language->get('text_short_description');
		$data['text_status'] = $this->language->get('text_status');
                $data['text_meta_description'] = $this->language->get('text_meta_description');
                $data['text_meta_keyword'] = $this->language->get('text_meta_keyword');
                $data['text_keyword'] = $this->language->get('text_keyword');
		$data['text_keyword'] = $this->language->get('text_keyword');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_browse'] = $this->language->get('text_browse');
		$data['text_clear'] = $this->language->get('text_clear');
		$data['text_image_manager'] = $this->language->get('text_image_manager');
		$data['text_dates'] = $this->language->get('text_dates');
                $data['text_date_begin'] = $this->language->get('text_date_begin');
                $data['text_date_end'] = $this->language->get('text_date_end');
                $data['button_date_add'] = $this->language->get('button_date_add');
                $data['text_show_on_main_page'] = $this->language->get('text_show_on_main_page');
                $data['text_yes'] = $this->language->get('text_yes');
                $data['text_no'] = $this->language->get('text_no');
                
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->error['warning'])) {
			$data['error'] = $this->error['warning'];
		} else {
			$data['error'] = '';
		}
		
		if (isset($this->request->get['promotion_id'])) {
			$promotion = $this->model_extension_promotions->getPromotions($this->request->get['promotion_id']);
		} else {
			$promotion = array();
		}
		
		if (isset($this->request->post['promotion'])) {
			$data['promotion'] = $this->request->post['promotion'];
		} elseif (!empty($promotion)) {
			$data['promotion'] = $this->model_extension_promotions->getPromotionDescription($this->request->get['promotion_id']);
		} else {
			$data['promotion'] = '';
		}
		
                if (isset($this->request->post['promotion_periods'])) {
			$data['promotion_periods'] = $this->request->post['promotion_periods'];
		} elseif (!empty($promotion)) {
			$data['promotion_periods'] = $this->model_extension_promotions->getPromotionPeriods($this->request->get['promotion_id']);
		} else {
			$data['promotion_periods'] = '';
		}
                
		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($promotion)) {
			$data['image'] = $promotion['image'];
		} else {
			$data['image'] = '';
		}
		
		$this->load->model('tool/image');
		
		if (isset($this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($promotion)) {
			$data['thumb'] = $this->model_tool_image->resize($promotion['image'] ? $promotion['image'] : 'no_image.png', 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);;
		}
		
		$data['no_image'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($promotion)) {
			$data['keyword'] = $promotion['keyword'];
		} else {
			$data['keyword'] = '';
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($promotion)) {
			$data['status'] = $promotion['status'];
		} else {
			$data['status'] = '';
		}
                
                if (isset($this->request->post['show_on_main_page'])) {
			$data['show_on_main_page'] = $this->request->post['show_on_main_page'];
		} elseif (!empty($promotion)) {
			$data['show_on_main_page'] = $promotion['show_on_main_page'];
		} else {
			$data['show_on_main_page'] = '';
		}
                $data['date_begin'] = date("Y-m-d");
                $data['date_end'] = date("Y-m-d");
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/promotion_form.tpl', $data));
	}
	
	public function delete() {
		$this->language->load('extension/promotions');
		
		$this->load->model('extension/promotions');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $promotion_id) {
				$this->model_extension_promotions->deletePromotion($promotion_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');
		}
		
		$this->response->redirect($this->url->link('extension/promotions', 'token=' . $this->session->data['token'], 'SSL'));
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'extension/promotions')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if (!$this->error) {
			return true; 
		} else {
			return false;
		}
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/promotions')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}