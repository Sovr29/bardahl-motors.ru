<?php
class ControllerCommonHeader extends Controller {

	public function index() {
		$data['title'] = $this->document->getTitle();
        $this->document->setName($this->language->get('text_home'));

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

        $this->load->model('catalog/information');

		$data['informations'] = array();

		$data['information_id'] = false;

		if(isset($this->request->get['information_id'])) {
			$data['information_id'] = $this->request->get['information_id'];
		}

		if(!isset($this->request->get['route']) || $this->request->get['route'] == 'common/home') {
			$data['information_id'] = 'home';
		}

		if(isset($this->request->get['route']) && $this->request->get['route'] == 'partners/list') {
			$data['information_id'] = 'partners';
		}

		if(isset($this->request->get['route']) && $this->request->get['route'] == 'module/promotions') {
			$data['information_id'] = 'promotions';
		}

                if(isset($this->request->get['route']) && $this->request->get['route'] == 'product/category') {
			$data['information_id'] = 'products';
		}
		/*
                $partners = array(
				'title' => 'Нам доверяют',
				'href'  => $this->url->link('partners/list'),
				'information_id' => 'partners'
		);
		/*
		$data['informations'][] = $partners;


		$data['informations'][] = array(
				'title' => 'Оплата и доставка',
				'href'  => $this->url->link('information/information', 'information_id=6'),
				'information_id' => '6'
		);
		*/
                $data['informations'][] = array(
				'title' => 'О нас',
				'href'  => $this->url->link('information/information', 'information_id=4'),
				'information_id' => '4'
		);
		/*
                $data['informations'][] = array(
				'title' => 'Статьи',
				'href'  => $this->url->link('module/articles'),
				'information_id' => 'articles'
		);
		*/
        $data['informations'][] = array(
            	'title' => 'Купить Онлайн',
               	'href'  => 'products',
               	'information_id' => 'products'
        );

		$data['informations'][] = array(
				'title' => 'Акции',
				'href'  => $this->url->link('module/promotions'),
				'information_id' => 'promotions'
		);

		$data['informations'][] = array(
				'title' => 'Контакты',
				'href'  => $this->url->link('information/information', 'information_id=11'),
				'information_id' => '11'
		);
		if ($this->config->get('config_google_analytics_status')) {
			$data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		} else {
			$data['google_analytics'] = '';
		}

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$data['icon'] = '';
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');

		$data['text_home'] = $this->language->get('text_home');
		$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));

		$data['text_account'] = $this->language->get('text_account');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_all'] = $this->language->get('text_all');

		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', 'SSL');
		$data['register'] = $this->url->link('account/register', '', 'SSL');
		$data['login'] = $this->url->link('account/login', '', 'SSL');
		$data['order'] = $this->url->link('account/order', '', 'SSL');
		$data['transaction'] = $this->url->link('account/transaction', '', 'SSL');
		$data['download'] = $this->url->link('account/download', '', 'SSL');
		$data['logout'] = $this->url->link('account/logout', '', 'SSL');
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');
                $data['shipping_method'] = $this->load->controller('checkout/shipping_method');



		$data['open'] = (html_entity_decode($this->config->get('config_open')));

		$status = true;

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", str_replace(array("\r\n", "\r"), "\n", trim($this->config->get('config_robots'))));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}

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

		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');

		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'common-home';
		}
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
                //играемся с геолокацией
                /*
                $geo_db = new \IP2Location\Database('./system/helper/databases/IP2LOCATION-LITE-DB5.BIN', \IP2Location\Database::FILE_IO);
                if($geo_db)
                {
                    $ipaddress = '';
                    if (getenv('HTTP_CLIENT_IP'))
                    {
                        $ipaddress = getenv('HTTP_CLIENT_IP');
                    }
                    else if(getenv('HTTP_X_FORWARDED_FOR')){
                        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
                    }
                    else if(getenv('HTTP_X_FORWARDED')){
                        $ipaddress = getenv('HTTP_X_FORWARDED');
                    }
                    else if(getenv('HTTP_FORWARDED_FOR')){
                        $ipaddress = getenv('HTTP_FORWARDED_FOR');
                    }
                    else if(getenv('HTTP_FORWARDED')){
                       $ipaddress = getenv('HTTP_FORWARDED');
                    }
                    else if(getenv('REMOTE_ADDR')){
                        $ipaddress = getenv('REMOTE_ADDR');
                    }
                    else
                    {
                        $ipaddress = 'UNKNOWN';
                    }
                    $records = $geo_db->lookup($ipaddress, \IP2Location\Database::ALL);
                    if($records['cityName'] == 'Saint Petersburg' || $records['regionName'] == 'Saint Petersburg City')
                    {
                        $data['city'] = $cities['spb'];
                    }
                    elseif ($records['cityName'] == 'Voronezh' || $records['regionName'] == 'Voronezh City')
                    {
                        $data['city'] = $cities['vrn'];
                    }
                    elseif ($records['cityName'] == 'Tula' || $records['regionName'] == 'Tula'){
                        $data['city'] = $cities['tula'];
                    }
                }
                */

                // Подключаем SxGeo.php класс
                include("Geo/SxGeo.php");
                $SxGeo = new SxGeo('Geo/SxGeoCity.dat');
                $ip = $_SERVER['REMOTE_ADDR'];
                $geoData = $SxGeo->getCity($ip);
                $city = $geoData["city"]["name_ru"];

				switch ($city){
					case 'Санкт-Петербург':
						$data['city'] = $cities['spb'];
						break;
					case 'Воронеж':
						$data['city'] = $cities['vrn'];
						break;
					case 'Тула':
						$data['city'] = $cities['tula'];
						break;
					default:
						$data['city'] = $cities['msk'];
						break;
				}

                $keys = array_keys($data['city']['phone']);
                shuffle($keys);

                foreach($keys as $key) {
                    $new[$key] = $data['city']['phone'][$key];
                }

                $data['city']['phone'] = $new;
				//$data['city'] = $cities['tula']; // тест
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/header.tpl', $data);
		} else {
			return $this->load->view('default/template/common/header.tpl', $data);
		}
	}
}