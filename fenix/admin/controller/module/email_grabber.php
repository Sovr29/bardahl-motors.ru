<?php
class ControllerModuleEmailGrabber extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/email_grabber');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
                
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('email_grabber', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

                $data['token'] = $this->session->data['token'];
                
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
                $data['text_percent'] = $this->language->get('text_percent');
                $data['text_amount'] = $this->language->get('text_amount');

                $data['entry_text'] = $this->language->get('entry_text');
                $data['entry_success_text'] = $this->language->get('entry_success_text');
                $data['entry_button_text'] = $this->language->get('entry_button_text');
                $data['entry_time'] = $this->language->get('entry_time');
		$data['entry_status'] = $this->language->get('entry_status');
                $data['entry_create_coupon'] = $this->language->get('entry_create_coupon');
                $data['entry_coupon_type'] = $this->language->get('entry_coupon_type');
                $data['entry_coupon_discount'] = $this->language->get('entry_coupon_discount');
                $data['entry_coupon_discount_summ'] = $this->language->get('entry_coupon_discount_summ');
                
                $data['help_time'] = $this->language->get('help_time');
                $data['help_coupon_discount_summ'] = $this->language->get('help_coupon_discount_summ');
                
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
                
                if (isset($this->error['text'])) {
			$data['error_text'] = $this->error['text'];
		} else {
			$data['error_text'] = '';
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
			'href' => $this->url->link('module/email_grabber', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/email_grabber', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
                
                if (isset($this->request->post['email_grabber_status'])) {
			$data['email_grabber_status'] = $this->request->post['email_grabber_status'];
		} else {
			$data['email_grabber_status'] = $this->config->get('email_grabber_status');
		}

                if (isset($this->request->post['email_grabber_text'])) {
			$data['email_grabber_text'] = $this->request->post['email_grabber_text'];
		} else {
			$data['email_grabber_text'] = $this->config->get('email_grabber_text');
		}
                
                if (isset($this->request->post['email_grabber_success_text'])) {
			$data['email_grabber_success_text'] = $this->request->post['email_grabber_success_text'];
		} else {
			$data['email_grabber_success_text'] = $this->config->get('email_grabber_success_text');
		}
                
                if (isset($this->request->post['email_grabber_button_text'])) {
			$data['email_grabber_button_text'] = $this->request->post['email_grabber_button_text'];
		} else {
			$data['email_grabber_button_text'] = $this->config->get('email_grabber_button_text');
		}
                
                if (isset($this->request->post['email_grabber_time'])) {
			$data['email_grabber_time'] = intval($this->request->post['email_grabber_time'], 10);
		} else {
			$data['email_grabber_time'] = $this->config->get('email_grabber_time');
		}
                
                if (isset($this->request->post['email_grabber_create_coupon'])) {
			$data['email_grabber_create_coupon'] = $this->request->post['email_grabber_create_coupon'];
		} else {
			$data['email_grabber_create_coupon'] = $this->config->get('email_grabber_create_coupon');
		}
                
                if (isset($this->request->post['email_grabber_coupon_type'])) {
			$data['email_grabber_coupon_type'] = $this->request->post['email_grabber_coupon_type'];
		} else {
			$data['email_grabber_coupon_type'] = $this->config->get('email_grabber_coupon_type');
		}
                
                if (isset($this->request->post['email_grabber_coupon_discount'])) {
			$data['email_grabber_coupon_discount'] = $this->request->post['email_grabber_coupon_discount'];
		} else {
			$data['email_grabber_coupon_discount'] = $this->config->get('email_grabber_coupon_discount');
		}
                
                if (isset($this->request->post['email_grabber_coupon_discount_summ'])) {
			$data['email_grabber_coupon_discount_summ'] = $this->request->post['email_grabber_coupon_discount_summ'];
		} else {
			$data['email_grabber_coupon_discount_summ'] = $this->config->get('email_grabber_coupon_discount_summ');
		}
                
                if($data['email_grabber_time'] <=0)
                {
                    $data['email_grabber_time'] = 40;
                }
                
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/email_grabber.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/email_grabber')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
                
                if (!$this->request->post['email_grabber_text']) {
			$this->error['text'] = $this->language->get('error_text');
		}
                
		return !$this->error;
	}
}