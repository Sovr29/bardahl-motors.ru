<?php
class ControllerCommonFooter extends Controller {
	public function index() {
		$this->load->language('common/footer');

                $data['page_title'] = $this->document->getName();
		$data['comment'] = (html_entity_decode($this->config->get('config_comment')));

		$data['text_information'] = $this->language->get('text_information');
		$data['text_service'] = $this->language->get('text_service');
		$data['text_extra'] = $this->language->get('text_extra');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_sitemap'] = $this->language->get('text_sitemap');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_voucher'] = $this->language->get('text_voucher');
		$data['text_affiliate'] = $this->language->get('text_affiliate');
		$data['text_special'] = $this->language->get('text_special');
		$data['text_account'] = $this->language->get('text_account');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_wishlist'] = $this->language->get('text_wishlist');
		$data['text_newsletter'] = $this->language->get('text_newsletter');

		$this->load->model('catalog/information');

		$data['informations'] = array();
                $data['informations'][] = array(
                        'title' => $this->language->get('text_home'),
                        'href'  => $this->url->link('common/home'),
                        'information_id' => 'home'
                );

                $data['information_id'] = false;

                if(isset($this->request->get['information_id'])) {
                    $data['information_id'] = $this->request->get['information_id'];
                }

                if(!isset($this->request->get['route']) || $this->request->get['route'] == 'common/home') {
                    $data['information_id'] = 'home';
                }

                if(isset($this->request->get['route']) && $this->request->get['route'] == 'information/contact') {
                    $data['information_id'] = 'contact';
                }

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {

				$data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id']),
                                        'information_id' => $result['information_id']
				);


			}
		}

                $data['informations'][] = array(
                        'title' => 'Контакты',
                        'href'  => $this->url->link('information/contact'),
                        'information_id' => 'contact'
                );


		$data['contact'] = $this->url->link('information/contact');
		$data['return'] = $this->url->link('account/return/add', '', 'SSL');
		$data['sitemap'] = $this->url->link('information/sitemap');
		$data['manufacturer'] = $this->url->link('product/manufacturer');
		$data['voucher'] = $this->url->link('account/voucher', '', 'SSL');
		$data['affiliate'] = $this->url->link('affiliate/account', '', 'SSL');
		$data['special'] = $this->url->link('product/special');
		$data['account'] = $this->url->link('account/account', '', 'SSL');
		$data['order'] = $this->url->link('account/order', '', 'SSL');
		$data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$data['newsletter'] = $this->url->link('account/newsletter', '', 'SSL');
                $data['privacy_policy'] = $this->config->get('privacy_policy_status');
                $data['privacy_policy_href'] = $this->url->link('module/privacy_policy', '', 'SSL');

		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));

                $data['scripts'] = $this->document->getScripts();
                $data['scriptTexts'] = $this->document->getScriptTexts();


		$cities = array();
		$cities["msk"] = array(
				'email'    => array("info@bardahl-motor.ru"),
				'phone'    => array("" => "+7 (499) 647-77-99"),
				'name'     => "Москва",
				'code'     => "msk"
		);
		$cities["spb"] = array(
				'email'    => array(/*"infospb@bardahl-motor.ru",*/ "spbsever@bardahl-motor.ru"),
				'phone'    => array(
						//"Восток" => "+7 (812) 441-29-85",
						array("Север" => "+7 (812) 988-87-97"), // before 14.05.16 was "" => "+7 (812) 988-87-97" (without array)
						array("Юг" => "+7 (812) 988-87-96") // before 14.05.16 was "" => "+7 (812) 988-87-96" (without array)
				),
				'name'     => "Санкт-Петербург",
				'code'     => "spb"
		);
		$cities["vrn"] = array(
				'email'    => array("infovoronezh@bardahl-motor.ru"),
				'phone'    => array("" => "+7 (920) 225-30-81"),
				'name'     => "Воронеж",
				'code'     => "vrn"
		);
		$cities["tula"] = array(
				'email'    => array("infotula@bardahl-motor.ru"),
				'phone'    => array("" => "+7 (910) 582-72-22"),
				'name'     => "Тула",
				'code'     => "tula"
		);
		$data['city'] = $cities['msk'];

		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			//if ($category['top']) {
			// Level 2
			$children_data = array();

			$children = $this->model_catalog_category->getCategories($category['category_id']);

			foreach ($children as $child) {
				$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
				);

				if ($child['image']) {
					$image = $this->model_tool_image->resize($child['image'], 49, 49);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', 49, 49);
				}
				$children_data[] = array(
						'category_id'  => $child['category_id'],
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']),
						'image'=> $image
				);
			}

			// Level 1
			$data['categories'][] = array(
					'category_id'     => $category['category_id'],
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
			);
			//}
		}

		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');

			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];
			} else {
				$ip = '';
			}

			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = 'http://' . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];
			} else {
				$url = '';
			}

			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];
			} else {
				$referer = '';
			}

			$this->model_tool_online->whosonline($ip, $this->customer->getId(), $url, $referer);
		}


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/footer.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/footer.tpl', $data);
		} else {
			return $this->load->view('default/template/common/footer.tpl', $data);
		}
	}
}