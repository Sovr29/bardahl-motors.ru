<?php  
class ControllerModuleEmailGrabber extends Controller {
        
    public function index() {
        
        $this->document->addScript('catalog/view/javascript/emailGrabber.js');
        $this->document->addScript('catalog/view/javascript/jquery/maskedinput/jquery.maskedinput.min.js');
        
        $data['form'] = $this->load->controller('module/email_grabber/getForm');
        
        $data['button_text'] = html_entity_decode($this->config->get('email_grabber_button_text'), ENT_QUOTES);;
        
        $this->document->addScriptText('
            $(\'#emailGrabberModal\').emailGrabber({
                time: ' . intval($this->config->get('email_grabber_time'), 10) . ',
                text_success: \'' . html_entity_decode($this->config->get('email_grabber_success_text'), ENT_QUOTES) . '\'
            });');
        
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/email_grabber.tpl')) {
            $view = $this->load->view($this->config->get('config_template') . '/template/module/email_grabber.tpl', $data);
        } else {
            $view = $this->load->view('default/template/module/email_grabber.tpl', $data);
        }
        return $view;
    }
    public function getForm(){        
        $this->language->load('module/email_grabber');
        
        $data['action'] = $this->url->link('module/email_grabber/saveData');
        
        $data['error_name'] = $this->language->get('error_name');
        $data['error_email'] = $this->language->get('error_email');
        
        $data['body'] = html_entity_decode($this->config->get('email_grabber_text'), ENT_QUOTES);   
        
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/email_grabber_form.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/module/email_grabber_form.tpl', $data);
        } else {
                return $this->load->view('default/template/module/email_grabber_form.tpl', $data);
        }
    }
    
    public function showForm() {
        $this->language->load('module/email_grabber');
        
        $this->document->setName($this->language->get('heading_title'));
        $this->document->setTitle($this->language->get('heading_title'));
                
        $this->document->addScript('catalog/view/javascript/jquery/maskedinput/jquery.maskedinput.min.js');
        
        $data['form'] = $this->load->controller('module/email_grabber/getForm');
        $data['button_text'] = html_entity_decode($this->config->get('email_grabber_button_text'), ENT_QUOTES);;
        
        $this->document->addScriptText('$.cookie("EmailGrabberShown", true, { expires: 5 * 365 });'
                . '$(\'.grabberForm\').emailGrabber({
                        isStatic: true,
                        time: ' . intval($this->config->get('email_grabber_time'), 10) . ',
                        text_success: \'' . html_entity_decode($this->config->get('email_grabber_success_text'), ENT_QUOTES) . '\'
                    });');
        
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/email_grabber_show_form.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/module/email_grabber_show_form.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/module/email_grabber_show_form.tpl', $data));
        }
    }
    
    public function saveData(){
		
				
        $this->language->load('module/email_grabber');
        $this->load->model('module/email_grabber');
        $this->load->model('module/ms');
        
        $data['error'] = '';
        $json = array();
        
        if (isset($this->request->post['email_grabber_name'])) {
            $data['name'] = $this->request->post['email_grabber_name'];
        } else {
            $data['error'] = $this->language->get('error_name');
        }
        if (isset($this->request->post['email_grabber_email'])) {
            $data['email'] = $this->request->post['email_grabber_email'];
        } else {
            $data['error'] = $this->language->get('error_email');
        }
        if (isset($this->request->post['email_grabber_phone'])) {
            $data['phone'] = $this->request->post['email_grabber_phone'];
        } else {
            $data['phone'] = '';
        }
        if(strlen($data['phone']) > 0)
        {
						
            if(!preg_match("/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{2}[\s.-]?\d{2}$/", $data['phone'])) {
                $data['error'] = $this->language->get('error_phone');
            }
			
			
			
        }
        if($data['error'] === '')
        {
            try {                
                $contact = $this->model_module_ms->getContact($data);
                
                $coupon_given_text = "Выписан купон";
                $coupon_code = "";
                //формируем купон
                if($this->config->get('email_grabber_create_coupon'))
                {
                    if(($contact->company && !strpos($contact->company->description."", $coupon_given_text)) || !$contact->company)
                    {
                        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $coupon_code = "";
                        for ($i = 0; $i < 10; $i++) {
                            $coupon_code .= $chars[mt_rand(0, strlen($chars)-1)];
                        }
                        $coupon = array();
                        $coupon['name'] = 'Купон для клиента ' . $data['name'];
                        $coupon['code'] = $coupon_code;
                        $coupon['discount'] = $this->config->get('email_grabber_coupon_discount');
                        $coupon['type'] = $this->config->get('email_grabber_coupon_type');
                        $coupon['total'] = $this->config->get('email_grabber_coupon_discount_summ');
                        $coupon['logged'] = 0;
                        $coupon['shipping'] = 0;
                        $coupon['date_start'] = date("Y-m-d");
                        $coupon['date_end'] = date("Y-m-d", strtotime('+2 weeks'));
                        $coupon['uses_total'] = 1;
                        $coupon['uses_customer'] = 1;
                        $coupon['status'] = 1;
                        
                        $coupon['id'] = $this->model_module_email_grabber->addCoupon($coupon);
                    }
                    if($contact->company && strpos($contact->company->description."", $coupon_given_text)){
                        throw new Exception("Купон уже был выдан ранее");
                    }
                }
                
                if($contact->company)
                {
                    $email = $contact->company->contact->attributes()->email[0];
                    if(strlen($email) > 0 && $email != $data['email'] && !strpos($contact->company->description."",$data['email']))
                    {
                        $contact->company->description .= ' ' . $data['email'];
                    }
                    else if(strlen($email) == 0)
                    {
                        $contact->company->contact->attributes()->email = $data['email'];
                    }
                    $contact->company->tags->tag[] = "загружен из OpenCart";
                }
                else{
                    $contact=simplexml_load_string("<collection><company payerVat=\"true\" companyType=\"URLI\" discountCardNumber=\"\" archived=\"false\" name=\"" . $data['name'] . "\"><contact address=\"\" phones=\"" . $data['phone'] . "\" faxes=\"\" mobiles=\"\" email=\"" . $data['email'] . "\"/><tags><tag>загружен из OpenCart</tag></tags><description/></company></collection>");
                }

                if($this->config->get('email_grabber_create_coupon') && $coupon_code && strlen($coupon_code) > 0)
                {
                    $contact->company->description .= ' ' . $coupon_given_text . ' ' . $coupon_code;
                }

                $attr = $contact->company->addChild('attribute');
                $attr->addAttribute('metadataUuid', '979d8a20-bf47-11e5-7a69-8f550003261e');
                $d = new DateTime();
                $attr->addAttribute('timeValue', str_replace(' ', 'T', $d->format('Y-m-d H:i:sP')));
                $data['request_body'] = $this->model_module_ms->updateContact($contact->company->asXML());
            
                $message  = sprintf($this->language->get('text_greeting'), html_entity_decode($data['name'], ENT_QUOTES, 'UTF-8')) . "\n\n";
                $message .= "Пользователь оставил свои данные\n\n";
                $message .= "data keys:".implode("\n", array_keys($data));
                $message .= "data keys:".implode("\n", $data);
                $message .= "\ncoupon:".$coupon_code;

                $this->model_module_email_grabber->saveData($data);

                if(strlen($coupon_code) > 0)
                {
                    $data['store_url'] = $this->config->get('config_url');
                    $data['store_name'] = $this->config->get('config_name');
                    $data['logo'] = $this->config->get('config_url') . 'image/' . $this->config->get('config_logo');
                    $data['text_greeting'] = 'Здравствуйте, ' . $data['name'];
                    $data['coupon_code'] = $coupon_code;
                    $data['coupon_discount'] = $coupon['discount'] .($coupon['type'] == 'P' ? '%' : 'р.');
                    $data['coupon_min_price'] = $coupon['total'];
                    $data['coupon_date_end'] = date('d.m.Y', strtotime($coupon['date_end']));
                    $data['coupon_img'] = $this->config->get('config_url') . 'image/flyer.jpg';
                    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/mail/coupon.tpl')) {
                        $html = $this->load->view($this->config->get('config_template') . '/template/mail/coupon.tpl', $data);
                    } else {
                        $html = $this->load->view('default/template/mail/coupon.tpl', $data);
                    }

                    $mail = new Mail();
                    $mail->protocol = $this->config->get('config_mail_protocol');
                    $mail->parameter = $this->config->get('config_mail_parameter');
                    $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
                    $mail->smtp_username = $this->config->get('config_mail_smtp_username');
                    $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
                    $mail->smtp_port = $this->config->get('config_mail_smtp_port');
                    $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

                    $mail->setTo($data['email']);
                    $mail->setFrom($this->config->get('config_email'));
                    $mail->setSender('Bardahl Motor');
                    $mail->setSubject(html_entity_decode("Купон на скидку", ENT_QUOTES, 'UTF-8'));
                    $mail->setHtml($html);
                    $mail->send();
                }
            }
            catch (Exception $e) {
                $json['error'] = 'Ошибка!' .strip_tags($e->getMessage());
            }
        }
        else{
            $json['error'] = $data['error'];
        }
        
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}