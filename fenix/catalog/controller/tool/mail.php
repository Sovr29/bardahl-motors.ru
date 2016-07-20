<?php
class ControllerToolMail extends Controller {
	public function callBackSend() {
                $json = array();
		$userName = $this->request->post['userName'];
                $phone = $this->request->post['phone'];
                $city = $this->request->post['city'];
                $selectedPhone = $this->request->post['selectedPhone'];
                if($userName && $phone && $city &&
                   strlen($phone) > 0 && strlen($userName) > 0 && strlen($city) > 0
                )
                {
                    $email = $this->config->get('config_email');
                    switch ($city) {
                        case 'spb':
                            $email = 'infospb@bardahl-motor.ru, spbsever@bardahl-motor.ru';
                            break;
                        case 'vrn':
                            $email = 'infovoronezh@bardahl-motor.ru';
                            break;
                        case 'tula':
                            $email = 'infotula@bardahl-motor.ru';
                            break;
                    }
                    $mail = new Mail();
                    $mail->protocol = $this->config->get('config_mail_protocol');
                    $mail->parameter = $this->config->get('config_mail_parameter');
                    $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
                    $mail->smtp_username = $this->config->get('config_mail_smtp_username');
                    $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
                    $mail->smtp_port = $this->config->get('config_mail_smtp_port');
                    $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

                    $mail->setTo($email);
                    $mail->setFrom($this->config->get('config_email'));
                    $mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
                    $mail->setSubject(html_entity_decode('Просьба перезвонить от '.$userName, ENT_QUOTES, 'UTF-8'));
                    $mail->setText($userName.' хочет, чтобы ему перезвонили на номер '.$phone.(($selectedPhone && strlen($selectedPhone) > 0) ? ' с номера '.$selectedPhone : ''));
                    $mail->send();
                }                
                $this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}