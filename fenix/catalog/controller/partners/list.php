<?php  
class ControllerPartnersList extends Controller {
	public function index() {
		$this->language->load('partners/list');
		$this->load->model('partners/list');
		$this->load->model('tool/image');
	
                $this->document->setName($this->language->get('heading_title'));
                $this->document->setTitle($this->language->get('heading_title'));
                $this->document->setDescription($this->config->get('partners_description'));
                $this->document->setKeywords($this->config->get('partners_keywords'));
                
		$all_partners = $this->model_partners_list->getAllPartners();
	 
		$data['all_partners'] = array();
		foreach ($all_partners as $partner) {
			$data['all_partners'][$partner['type']][] = array (
				'title' 	=> html_entity_decode($partner['title'], ENT_QUOTES),
				'address' 	=> strip_tags(html_entity_decode($partner['address'], ENT_QUOTES)),
                                'phone' 	=> strip_tags(html_entity_decode($partner['phone'], ENT_QUOTES)),
				'date_added' 	=> date($this->language->get('date_format_short'), strtotime($partner['date_added'])),
                                'image'         => $this->model_tool_image->resize($partner['image'], 300, 205),
                                'href'          => $partner['href'],
                                'fb' 		=> $partner['fb'],
                                'vk' 		=> $partner['vk'],
                                'insta' 	=> $partner['insta'],
                                'type'          => $partner['type'],
                                'href'          => $partner['href']
			);
		}
                
                $data['column_left'] = $this->load->controller('common/column_left');
                $data['column_right'] = $this->load->controller('common/column_right');
                $data['content_top'] = $this->load->controller('common/content_top');
                $data['content_bottom'] = $this->load->controller('common/content_bottom');
                $data['footer'] = $this->load->controller('common/footer');
                $data['header'] = $this->load->controller('common/header');
                $data['type_services'] = $this->language->get('text_type_services');
                $data['type_shops'] = $this->language->get('text_type_shops');
                $data['type_friends'] = $this->language->get('text_type_friends');
                
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/partners/list.tpl')) {
                    $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/partners/list.tpl', $data));
		} else {
                    $this->response->setOutput($this->load->view('default/template/partners/list.tpl', $data));
		}
	}
}