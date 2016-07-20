<?php
class ControllerModulePromotions extends Controller {
	public function index() {
		$this->language->load('module/promotions');
		$this->load->model('extension/promotions');
		$this->load->model('tool/image');

		$this->document->addStyle('catalog/view/theme/bardahl_new/stylesheet/pages.css');

		$data['heading_title'] = $this->language->get('heading_title');

                $this->document->setName($this->language->get('heading_title'));
		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->setDescription($this->config->get('promotions_meta_description'));
		$this->document->setKeywords($this->config->get('promotions_meta_keywords'));

		$all_promotions = $this->model_extension_promotions->getAllPromotions();

		$data['apromotions'] = array();
		foreach ($all_promotions as $promotion) {
			$data['promotions'][] = array (
				'title' 	=> html_entity_decode($promotion['title'], ENT_QUOTES),
                                'description' 	=> strip_tags(html_entity_decode($promotion['short_description'], ENT_QUOTES)),
				'view' 		=> $this->url->link('information/promotions/promotion', 'promotion_id=' . $promotion['promotion_id']),
                                'image'         => $this->model_tool_image->resize($promotion['image'], 370, 125),
                                'date_begin' 	=> date($this->language->get('date_format_short'), strtotime($promotion['date_begin'])),
                                'date_end' 	=> date($this->language->get('date_format_short'), strtotime($promotion['date_end']))
			);
		}

		$data['promotions_description'] = html_entity_decode($this->config->get('promotions_description'), ENT_QUOTES);

                $data['content_bottom'] = $this->load->controller('common/content_bottom');
                $data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/promotions.tpl')) {
                    return $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/module/promotions.tpl', $data));
		} else {
                    return $this->response->setOutput($this->load->view('default/template/module/promotions.tpl', $data));
		}
	}
}