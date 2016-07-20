<?php
class ControllerModuleArticles extends Controller {
	public function index() {
		$this->load->language('module/articles');

		$this->document->setName($this->language->get('heading_title'));
                $this->document->setTitle($this->language->get('heading_title'));
                $this->document->setDescription($this->config->get('articles_meta_description'));
                $this->document->setKeywords($this->config->get('articles_meta_keywords'));

                $this->load->model('catalog/information');

				$articles = $this->model_catalog_information->getInformations();
                
				$sort_order = array();
                
				foreach ($articles as $key => $value) {
					$sort_order[$key] = $value['sort_order'];
				}
				
				array_multisort($sort_order, SORT_DESC, $articles);
				
				foreach ($articles as $key => $article) {
                        if(!in_array($article['information_id'], $this->config->get('articles_exclude')))
                        {
							$sort_order[$key] = $article['information_id'];
                            $data['articles'][] = array (
									'id'			=> $article['information_id'],
                                    'title'         => html_entity_decode($article['title'], ENT_QUOTES),
                                    'description'   => utf8_substr(strip_tags(html_entity_decode($article['description'], ENT_QUOTES)), 0, 450).'...',
                                    'href'          => $this->url->link('information/information', 'information_id=' . $article['information_id']),
                            );
                        }
				}
				
                $data['column_left'] = $this->load->controller('common/column_left');
                $data['column_right'] = $this->load->controller('common/column_right');
                $data['content_top'] = $this->load->controller('common/content_top');
                $data['content_bottom'] = $this->load->controller('common/content_bottom');
                $data['footer'] = $this->load->controller('common/footer');
                $data['header'] = $this->load->controller('common/header');

                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/articles.tpl')) {
                    $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/module/articles.tpl', $data));
		} else {
                    $this->response->setOutput($this->load->view('default/template/module/articles.tpl', $data));
		}
	}
}