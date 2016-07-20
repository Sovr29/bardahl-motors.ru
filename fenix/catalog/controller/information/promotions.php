<?php
class ControllerInformationPromotions extends Controller {
	public function promotion() {
		$this->load->model('extension/promotions');

		$this->language->load('information/promotions');

		if (isset($this->request->get['promotion_id']) && !empty($this->request->get['promotion_id'])) {
			$promotion_id = $this->request->get['promotion_id'];
		} else {
			$promotion_id = 0;
		}

		$promotion = $this->model_extension_promotions->getPromotion($promotion_id);

		if ($promotion) {

			$this->document->setTitle($promotion['title']);
			$this->document->setName($promotion['title']);

			$this->load->model('tool/image');

                        $this->document->setDescription(html_entity_decode($promotion['meta_description'], ENT_QUOTES));
                        $this->document->setKeywords(html_entity_decode($promotion['meta_keyword'], ENT_QUOTES));

			$data['image'] = $this->model_tool_image->resize($promotion['image'], 1200, 400);

			$data['heading_title'] = html_entity_decode($promotion['title'], ENT_QUOTES);
			$data['description'] = html_entity_decode($promotion['description'], ENT_QUOTES);
                        $data['date_begin'] = date($this->language->get('date_format_short'), strtotime($promotion['date_begin']));
                        $data['date_end'] = date($this->language->get('date_format_short'), strtotime($promotion['date_end']));

                        $data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/promotion.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/promotion.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/information/promotion.tpl', $data));
			}
		} else {

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');
			$data['text_error'] = $this->language->get('text_error');
			$data['button_continue'] = $this->language->get('button_continue');
			$data['continue'] = $this->url->link('common/home');

			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}
}