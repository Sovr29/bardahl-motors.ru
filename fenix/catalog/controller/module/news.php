<?php  
class ControllerModuleNews extends Controller {
	public function index() {
		$this->language->load('module/news');
		$this->load->model('extension/news');
		$this->load->model('tool/image');
                
		$isAjax = 0;
		$page = 0;
		if (isset($this->request->get['isAjax'])) {
			$isAjax = (int)$this->request->get['isAjax'];
			if (isset($this->request->get['page'])) {
				$page = (int)$this->request->get['page'];
			}
		}
		$data['isAjax'] = $isAjax;
		$filter_data = array(
			'limit' => 6,
			'start' => $page*6
		);
	 
		$data['heading_title'] = $this->language->get('heading_title');
	 
		$all_news = $this->model_extension_news->getAllNews($filter_data);
	 
		$data['all_news'] = array();
		foreach ($all_news as $news) {
			$data['all_news'][] = array (
				'title' 	=> html_entity_decode($news['title'], ENT_QUOTES),
				'description' 	=> strip_tags(html_entity_decode($news['short_description'], ENT_QUOTES)),
				'view' 		=> $this->url->link('information/news/news', 'news_id=' . $news['news_id']),
				'date_added' 	=> date($this->language->get('date_format_short'), strtotime($news['date_added'])),
                                'image'         => $this->model_tool_image->resize($news['image'], 370, 125),
                                'youtube' 	=> $news['youtube'],
                                'fb' 		=> $news['fb'],
                                'vk' 		=> $news['vk'],
                                'insta' 	=> $news['insta']
			);
		}
	 
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/news.tpl')) {
                    $view = $this->load->view($this->config->get('config_template') . '/template/module/news.tpl', $data);
		} else {
                    $view = $this->load->view('default/template/module/news.tpl', $data);
		}
                if($isAjax){
                    $this->response->setOutput($view);
                }
                else{
                    return $view;
                }
	}
}