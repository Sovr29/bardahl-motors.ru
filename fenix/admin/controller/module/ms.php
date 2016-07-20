<?php
class ControllerModuleMs extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/ms');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
                
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                    $this->model_setting_setting->editSetting('ms', $this->request->post);

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

                $data['entry_login'] = $this->language->get('entry_login');
                $data['entry_pwd'] = $this->language->get('entry_pwd');
                $data['entry_company'] = $this->language->get('entry_company');
                $data['entry_order_status'] = $this->language->get('entry_order_status');
                $data['entry_warehouse'] = $this->language->get('entry_warehouse');
                $data['entry_project'] = $this->language->get('entry_project');
                $data['entry_source'] = $this->language->get('entry_source');
                $data['entry_deliveries'] = $this->language->get('entry_deliveries');
                $data['entry_coupon'] = $this->language->get('entry_coupon');
                
                $data['help_company'] = $this->language->get('help_company');
                
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
                    $data['error_warning'] = $this->error['warning'];
		} else {
                    $data['error_warning'] = '';
		}
                
                if (isset($this->error['login'])) {
			$data['error_login'] = $this->error['login'];
		} else {
			$data['error_login'] = '';
		}
                
                if (isset($this->error['pwd'])) {
			$data['error_pwd'] = $this->error['pwd'];
		} else {
			$data['error_pwd'] = '';
		}
                
                if (isset($this->error['company'])) {
			$data['error_company'] = $this->error['company'];
		} else {
			$data['error_company'] = '';
		}
                
                if (isset($this->error['order_status'])) {
			$data['error_order_status'] = $this->error['order_status'];
		} else {
			$data['error_order_status'] = '';
		}
                
                if (isset($this->error['warehouse'])) {
			$data['error_warehouse'] = $this->error['warehouse'];
		} else {
			$data['error_warehouse'] = '';
		}
                
                if (isset($this->error['project'])) {
			$data['error_project'] = $this->error['project'];
		} else {
			$data['error_project'] = '';
		}
                
                if (isset($this->error['source'])) {
			$data['error_source'] = $this->error['source'];
		} else {
			$data['error_source'] = '';
		}
                
                if (isset($this->error['coupon'])) {
			$data['error_coupon'] = $this->error['coupon'];
		} else {
			$data['error_coupon'] = '';
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
			'href' => $this->url->link('module/ms', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/ms', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

                if (isset($this->request->post['ms_login'])) {
			$data['ms_login'] = $this->request->post['ms_login'];
		} else {
			$data['ms_login'] = $this->config->get('ms_login');
		}
                
                if (isset($this->request->post['ms_pwd'])) {
			$data['ms_pwd'] = $this->request->post['ms_pwd'];
		} else {
			$data['ms_pwd'] = $this->config->get('ms_pwd');
		}
                
                if (isset($this->request->post['ms_company'])) {
			$data['ms_company'] = $this->request->post['ms_company'];
		} else {
			$data['ms_company'] = $this->config->get('ms_company');
		}
                
                if (isset($this->request->post['ms_order_status'])) {
			$data['ms_order_status'] = $this->request->post['ms_order_status'];
		} else {
			$data['ms_order_status'] = $this->config->get('ms_order_status');
		}
                
		if (isset($this->request->post['ms_warehouse'])) {
			$data['ms_warehouse'] = $this->request->post['ms_warehouse'];
		} else {
			$data['ms_warehouse'] = $this->config->get('ms_warehouse');
		}
                
                if (isset($this->request->post['ms_project'])) {
			$data['ms_project'] = $this->request->post['ms_project'];
		} else {
			$data['ms_project'] = $this->config->get('ms_project');
		}
                
                if (isset($this->request->post['ms_source'])) {
			$data['ms_source'] = $this->request->post['ms_source'];
		} else {
			$data['ms_source'] = $this->config->get('ms_source');
		}
                
                if (isset($this->request->post['ms_shipping_method'])) {
			$data['ms_shipping_method'] = $this->request->post['ms_shipping_method'];
		} else {
			$data['ms_shipping_method'] = $this->config->get('ms_shipping_method');
		}
                
                if (isset($this->request->post['ms_coupon'])) {
			$data['ms_coupon'] = $this->request->post['ms_coupon'];
		} else {
			$data['ms_coupon'] = $this->config->get('ms_coupon');
		}
                
                // API
                $this->load->model('user/api');
                $api_info = $this->model_user_api->getApi($this->config->get('config_api_id'));
                if ($api_info) {
                    $curl = curl_init();

                    // Set SSL if required
                    if (substr(HTTPS_CATALOG, 0, 5) == 'https') {
                        curl_setopt($curl, CURLOPT_PORT, 443);
                    }

                    curl_setopt($curl, CURLOPT_HEADER, false);
                    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
                    curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($curl, CURLOPT_POSTREDIR, 7);
                    curl_setopt($curl, CURLOPT_URL, HTTPS_CATALOG . 'index.php?route=api/login');
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($api_info));

                    $json_r = curl_exec($curl);

                    if (!$json_r) {
                        $json['error'] = sprintf($this->language->get('error_curl'), curl_error($curl), curl_errno($curl));
                    } else {
                        $response = json_decode($json_r, true);

                        if (isset($response['cookie'])) {
                                $this->session->data['cookie'] = $response['cookie'];
                        }

                        curl_close($curl);
                    }
                }
            
                $data['shipping_methods'] = $this->getShippingMethods();
                $data['shipping_methods_ms'] = $this->getShippingMethodsMs();
                $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/ms.tpl', $data));
	}

        public function getCompanies(){            
            $this->load->language('model/ms');
                
            $json = array();
            
            if (isset($this->session->data['cookie'])) {
                $curl = curl_init();

                // Set SSL if required
                if (substr(HTTPS_CATALOG, 0, 5) == 'https') {
                        curl_setopt($curl, CURLOPT_PORT, 443);
                }

                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLINFO_HEADER_OUT, true);
                curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_POSTREDIR, 7);
                curl_setopt($curl, CURLOPT_URL, HTTPS_CATALOG . 'index.php?route=api/ms/getCompanies');
                curl_setopt($curl, CURLOPT_COOKIE, session_name() . '=' . $this->session->data['cookie'] . ';');

                $json_r = curl_exec($curl);

                if (!$json_r) {
                    $this->error['warning'] = sprintf($this->language->get('error_curl'), curl_error($curl), curl_errno($curl));
                } else {
                    $response = json_decode($json_r, true);
                    curl_close($curl);
                    if (isset($response['error'])) {
                        $json['error'] = $response['error'];
                    }
                    $json['data'] = $response;
                }
            }
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
        }
        
        public function getStatuses(){            
            $this->load->language('model/ms');
                
            $json = array();
            
            if (isset($this->session->data['cookie'])) {
                $curl = curl_init();

                // Set SSL if required
                if (substr(HTTPS_CATALOG, 0, 5) == 'https') {
                        curl_setopt($curl, CURLOPT_PORT, 443);
                }

                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLINFO_HEADER_OUT, true);
                curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_POSTREDIR, 7);
                curl_setopt($curl, CURLOPT_URL, HTTPS_CATALOG . 'index.php?route=api/ms/getStatuses');
                curl_setopt($curl, CURLOPT_COOKIE, session_name() . '=' . $this->session->data['cookie'] . ';');

                $json_r = curl_exec($curl);

                if (!$json_r) {
                    $this->error['warning'] = sprintf($this->language->get('error_curl'), curl_error($curl), curl_errno($curl));
                } else {
                    $response = json_decode($json_r, true);
                    curl_close($curl);
                    if (isset($response['error'])) {
                        $json['error'] = $response['error'];
                    }
                    $json['data'] = $response;
                }
            }
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
        }
        
        public function getWarehouses(){            
            $this->load->language('model/ms');
                
            $json = array();
            
            if (isset($this->session->data['cookie'])) {
                $curl = curl_init();

                // Set SSL if required
                if (substr(HTTPS_CATALOG, 0, 5) == 'https') {
                        curl_setopt($curl, CURLOPT_PORT, 443);
                }

                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLINFO_HEADER_OUT, true);
                curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_POSTREDIR, 7);
                curl_setopt($curl, CURLOPT_URL, HTTPS_CATALOG . 'index.php?route=api/ms/getWarehouses');
                curl_setopt($curl, CURLOPT_COOKIE, session_name() . '=' . $this->session->data['cookie'] . ';');

                $json_r = curl_exec($curl);

                if (!$json_r) {
                    $this->error['warning'] = sprintf($this->language->get('error_curl'), curl_error($curl), curl_errno($curl));
                } else {
                    $response = json_decode($json_r, true);
                    curl_close($curl);
                    if (isset($response['error'])) {
                        $json['error'] = $response['error'];
                    }
                    $json['data'] = $response;
                }
            }
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
        }
        
        public function getProjects(){            
            $this->load->language('model/ms');
                
            $json = array();
            
            if (isset($this->session->data['cookie'])) {
                $curl = curl_init();

                // Set SSL if required
                if (substr(HTTPS_CATALOG, 0, 5) == 'https') {
                        curl_setopt($curl, CURLOPT_PORT, 443);
                }

                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLINFO_HEADER_OUT, true);
                curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_POSTREDIR, 7);
                curl_setopt($curl, CURLOPT_URL, HTTPS_CATALOG . 'index.php?route=api/ms/getProjects');
                curl_setopt($curl, CURLOPT_COOKIE, session_name() . '=' . $this->session->data['cookie'] . ';');

                $json_r = curl_exec($curl);

                if (!$json_r) {
                    $this->error['warning'] = sprintf($this->language->get('error_curl'), curl_error($curl), curl_errno($curl));
                } else {
                    $response = json_decode($json_r, true);
                    curl_close($curl);
                    if (isset($response['error'])) {
                        $json['error'] = $response['error'];
                    }
                    $json['data'] = $response;
                }
            }
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
        }
        
        public function getSources(){            
            $this->load->language('model/ms');
                
            $json = array();
            
            if (isset($this->session->data['cookie'])) {
                $curl = curl_init();

                // Set SSL if required
                if (substr(HTTPS_CATALOG, 0, 5) == 'https') {
                        curl_setopt($curl, CURLOPT_PORT, 443);
                }

                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLINFO_HEADER_OUT, true);
                curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_POSTREDIR, 7);
                curl_setopt($curl, CURLOPT_URL, HTTPS_CATALOG . 'index.php?route=api/ms/getSources');
                curl_setopt($curl, CURLOPT_COOKIE, session_name() . '=' . $this->session->data['cookie'] . ';');

                $json_r = curl_exec($curl);

                if (!$json_r) {
                    $this->error['warning'] = sprintf($this->language->get('error_curl'), curl_error($curl), curl_errno($curl));
                } else {
                    $response = json_decode($json_r, true);
                    curl_close($curl);
                    if (isset($response['error'])) {
                        $json['error'] = $response['error'];
                    }
                    $json['data'] = $response;
                }
            }
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
        }
        
        public function getCoupons(){            
            $this->load->language('model/ms');
                
            $json = array();
            
            if (isset($this->session->data['cookie'])) {
                $curl = curl_init();

                // Set SSL if required
                if (substr(HTTPS_CATALOG, 0, 5) == 'https') {
                        curl_setopt($curl, CURLOPT_PORT, 443);
                }

                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLINFO_HEADER_OUT, true);
                curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_POSTREDIR, 7);
                curl_setopt($curl, CURLOPT_URL, HTTPS_CATALOG . 'index.php?route=api/ms/getCoupons');
                curl_setopt($curl, CURLOPT_COOKIE, session_name() . '=' . $this->session->data['cookie'] . ';');

                $json_r = curl_exec($curl);

                if (!$json_r) {
                    $this->error['warning'] = sprintf($this->language->get('error_curl'), curl_error($curl), curl_errno($curl));
                } else {
                    $response = json_decode($json_r, true);
                    curl_close($curl);
                    if (isset($response['error'])) {
                        $json['error'] = $response['error'];
                    }
                    $json['data'] = $response;
                }
            }
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
        }
        
        protected function getShippingMethods(){            
            $this->load->language('model/ms');
            
            $shippingMethods = array();
            $this->load->model('extension/extension');
            $extensions = $this->model_extension_extension->getInstalled('shipping');
            $files = glob(DIR_APPLICATION . 'controller/shipping/*.php');
            if ($files) {
                foreach ($files as $file) {
                    $extension = basename($file, '.php');
                    $this->load->language('shipping/' . $extension);
                    if($this->config->get($extension . '_status') && strrpos($extension, 'pickup') === false)
                    {
                        $shippingMethods[] = array(
                            'code'      => $extension,
                            'name'       => $this->language->get('heading_title'),
                            'sort_order' => $this->config->get($extension . '_sort_order'),
                        );
                    }
                }
            }
            
            $sort_order = array();

            foreach ($shippingMethods as $key => $value) {
                    $sort_order[$key] = $value['sort_order'];
            }
                
            array_multisort($sort_order, SORT_ASC, $shippingMethods);
            return $shippingMethods;
        }
        
        public function getShippingMethodsMs(){            
            $this->load->language('model/ms');
            
            if (isset($this->session->data['cookie'])) {
                $curl = curl_init();

                // Set SSL if required
                if (substr(HTTPS_CATALOG, 0, 5) == 'https') {
                        curl_setopt($curl, CURLOPT_PORT, 443);
                }

                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLINFO_HEADER_OUT, true);
                curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_POSTREDIR, 7);
                curl_setopt($curl, CURLOPT_URL, HTTPS_CATALOG . 'index.php?route=api/ms/getShippingMethods');
                curl_setopt($curl, CURLOPT_COOKIE, session_name() . '=' . $this->session->data['cookie'] . ';');

                $json_r = curl_exec($curl);

                if (!$json_r) {
                    $this->error['warning'] = sprintf($this->language->get('error_curl'), curl_error($curl), curl_errno($curl));
                } else {
                    $response = json_decode($json_r, true);
                    curl_close($curl);
                    if (isset($response['error'])) {
                        $this->error['warning'] = $response['error'];
                    }
                    $shippingMethods = $response['shipping_methods'];
                    array_unshift($shippingMethods, array(
                        'id' => '',
                        'name' => 'Не указан'
                    ));
                }
            }
            return $shippingMethods;
        }
        
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/ms')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
                
                if (!$this->request->post['ms_login']) {
			$this->error['login'] = $this->language->get('error_login');
		}
                
                if (!$this->request->post['ms_pwd']) {
			$this->error['pwd'] = $this->language->get('error_pwd');
		}
                
                if($this->request->post['ms_company'])
                {
                    if (!$this->request->post['ms_company']) {
                            $this->error['company'] = $this->language->get('ms_company');
                    }

                    if (!$this->request->post['ms_order_status']) {
                            $this->error['order_status'] = $this->language->get('ms_order_status');
                    }

                    if (!$this->request->post['ms_warehouse']) {
                            $this->error['warehouse'] = $this->language->get('ms_warehouse');
                    }

                    if (!$this->request->post['ms_project']) {
                            $this->error['project'] = $this->language->get('ms_project');
                    }

                    if (!$this->request->post['ms_source']) {
                            $this->error['source'] = $this->language->get('ms_source');
                    }

                    if (!$this->request->post['ms_coupon']) {
                            $this->error['coupon'] = $this->language->get('ms_coupon');
                    }
                }
		return !$this->error;
	}
}