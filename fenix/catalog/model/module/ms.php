<?php
class ModelModuleMs extends Model {
    private $ms_url = "https://online.moysklad.ru/exchange/rest/ms/xml/";
    private $ms_socket = "ssl://online.moysklad.ru";

    public function getContact($data) {
            //ищем нужного нам гаврика
            $url = $this->ms_url."Company/list?filter=";
            if(strlen($data['phone']) > 0)
            {
                    $url = $url . "contact.phones%3D" . urlencode($data['phone']);
            }
            else{
                    $url = $url . "contact.email%3D" . urlencode($data['email']);
            }
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($curl, CURLOPT_USERPWD, $this->config->get('ms_login') . ":" . $this->config->get('ms_pwd'));

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

            $result = curl_exec($curl);
            $contact='';
            if(isset($result) && strlen($result) > 0)
            {
                    $contact = simplexml_load_string($result) ;
                    if(!$contact){
                            throw new Exception("Ошибка при приведении ответа от сервера к xml. Result: " . $result);
                    }
            }
            else{
                    throw new Exception(curl_error($curl));
            }
            curl_close($curl);
            return $contact;
    }

    public function updateContact($contact)
    {
        $sock = fsockopen($this->ms_socket, 443, $errno, $errstr, 30);
        if (!$sock) {
            throw new Exception('Ошибка при соединении с моим складом!' .$errstr($errno));
        }

        fputs($sock, "PUT /exchange/rest/ms/xml/Company HTTP/1.1\r\n");
        fputs($sock, "Host: online.moysklad.ru\r\n");
        fputs($sock, "Authorization: Basic " . base64_encode($this->config->get('ms_login') . ":" . $this->config->get('ms_pwd')) . "\r\n");
        fputs($sock, "Content-Type: application/xml \r\n");
        fputs($sock, "Accept: */*\r\n");
        fputs($sock, "Content-Length: ".strlen($contact)."\r\n");
        fputs($sock, "Connection: close\r\n\r\n");
        fputs($sock, "$contact");

        while ($str = trim(fgets($sock, 4096)));

        $body = "";

        while (!feof($sock))
        {
            $body.= fgets($sock, 4096);
        }
        fclose($sock);

        return $body;
    }

    public function getCompanies() {
            $url = $this->ms_url."MyCompany/list";
            
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($curl, CURLOPT_USERPWD, $this->config->get('ms_login') . ":" . $this->config->get('ms_pwd'));

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

            $result = curl_exec($curl);
            $companies='';
            if(isset($result) && strlen($result) > 0)
            {
                    $companies = simplexml_load_string($result) ;
                    if(!$companies){
                            throw new Exception("Ошибка при приведении ответа от сервера к xml. Result: " . $result);
                    }
            }
            else{
                    throw new Exception(curl_error($curl));
            }
            curl_close($curl);
            return $companies;
    }
    
    public function getStatuses() {
        $url = $this->ms_url."Workflow/list?filter=name%3DCustomerOrder";

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_USERPWD, $this->config->get('ms_login') . ":" . $this->config->get('ms_pwd'));

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $result = curl_exec($curl);
        $statuses='';
        if(isset($result) && strlen($result) > 0)
        {
                $statuses = simplexml_load_string($result) ;
                if(!$statuses){
                        throw new Exception("Ошибка при приведении ответа от сервера к xml. Result: " . $result);
                }
        }
        else{
                throw new Exception(curl_error($curl));
        }
        curl_close($curl);
        return $statuses;
    }
    
    public function getWarehouses() {
        $url = $this->ms_url."Warehouse/list";

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_USERPWD, $this->config->get('ms_login') . ":" . $this->config->get('ms_pwd'));

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $result = curl_exec($curl);
        $warehouses='';
        if(isset($result) && strlen($result) > 0)
        {
                $warehouses = simplexml_load_string($result) ;
                if(!$warehouses){
                        throw new Exception("Ошибка при приведении ответа от сервера к xml. Result: " . $result);
                }
        }
        else{
                throw new Exception(curl_error($curl));
        }
        curl_close($curl);
        return $warehouses;
    }
    
    public function getProjects() {
        $url = $this->ms_url."Project/list";

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_USERPWD, $this->config->get('ms_login') . ":" . $this->config->get('ms_pwd'));

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $result = curl_exec($curl);
        $projects='';
        if(isset($result) && strlen($result) > 0)
        {
                $projects = simplexml_load_string($result) ;
                if(!$projects){
                        throw new Exception("Ошибка при приведении ответа от сервера к xml. Result: " . $result);
                }
        }
        else{
                throw new Exception(curl_error($curl));
        }
        curl_close($curl);
        return $projects;
    }
    
    public function getSources() {
        $url = $this->ms_url."CustomEntity/list";

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_USERPWD, $this->config->get('ms_login') . ":" . $this->config->get('ms_pwd'));

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $result = curl_exec($curl);
        $sources='';
        if(isset($result) && strlen($result) > 0)
        {
                $sources = simplexml_load_string($result) ;
                if(!$sources){
                        throw new Exception("Ошибка при приведении ответа от сервера к xml. Result: " . $result);
                }
        }
        else{
                throw new Exception(curl_error($curl));
        }
        curl_close($curl);
        return $sources;
    }
    
    public function getShippingMethods() {
        $url = $this->ms_url."Service/list?filter=parentUuid%3D21ed4f6d-72b8-11e5-90a2-8ecb0062de9d";

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_USERPWD, $this->config->get('ms_login') . ":" . $this->config->get('ms_pwd'));

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $result = curl_exec($curl);
        $sources='';
        if(isset($result) && strlen($result) > 0)
        {
                $sources = simplexml_load_string($result) ;
                if(!$sources){
                        throw new Exception("Ошибка при приведении ответа от сервера к xml. Result: " . $result);
                }
        }
        else{
                throw new Exception(curl_error($curl));
        }
        curl_close($curl);
        return $sources;
    }
    
    public function getCoupons() {
        $url = $this->ms_url."Service/list";

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_USERPWD, $this->config->get('ms_login') . ":" . $this->config->get('ms_pwd'));

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $result = curl_exec($curl);
        $sources='';
        if(isset($result) && strlen($result) > 0)
        {
                $sources = simplexml_load_string($result);
                if(!$sources){
                        throw new Exception("Ошибка при приведении ответа от сервера к xml. Result: " . $result);
                }
        }
        else{
                throw new Exception(curl_error($curl));
        }
        curl_close($curl);
        return $sources->xpath('//service[not(@parentUuid)]');
    }
    
    public function addOrder($data)
    {
        $order_id = $this->session->data['order_id'];
        // Products
        if (isset($data['products'])) {
            $filter = '';
            $error_products = '';
            foreach ($data['products'] as $product) {
                if(isset($product['sku']) && !empty($product['sku']))
                {
                    $sku = preg_replace('/\s+/', '', $product['sku']);
				    //$filter .= 'productCode%3D'.$sku. ';'; //01.06.2016
					
					// anatoliy.iwanov@yandex.ru 01.06.2016
					// trying to fix bug in order creation on Moy Sklad
					// ver 0.1
					if(strpos($sku, "/")){
						$sku = preg_replace("#\/#", "", $sku);
					}
					$filter .= 'productCode%3D'.$sku. ';';
                }
            }
            $filter = substr($filter, 0, strlen($filter) - 1);
            $ms_products = $this->getProducts($filter);
            $pc=count($data['products']);
            for ($i = 0; $i < $pc; $i++)
            {
                $sku = preg_replace('/\s+/', '', $data['products'][$i]['sku']);
                $p = $ms_products->xpath("//good[@productCode='". $sku ."']");
                $data['products'][$i]['ms_id'] = $p ? $p[0]->uuid.'' : '';
                if(empty($data['products'][$i]['ms_id']))
                {
                    $error_products .= $sku." : ".$data['products'][$i]['name'] . "\n";
                }
            }
            if(empty($error_products))
            {
				$log = "Контрагент\n";
                $phone = $this->formatPhone($this->db->escape($data['telephone']));
				$log .= "Телефон: ".$phone."\n";
				$log .= "Email: ".$this->db->escape($data['email'])."\n";
                //формируем контрагента
                $customer = $this->getContact(array(
                    'phone' => $phone,
                    'email' => $this->db->escape($data['email'])
                ));
                if(!$customer->company)
                {
					$log .= "Не нашли контрагента в базе\n";
                    $customer=simplexml_load_string("<company payerVat=\"true\" companyType=\"URLI\" discountCardNumber=\"\" archived=\"false\" name=\"" . ($this->db->escape($data['firstname']) . ' ' . $this->db->escape($data['lastname'])) . "\"><contact address=\"\" phones=\"" . $phone . "\" faxes=\"\" mobiles=\"\" email=\"" . $this->db->escape($data['email']) . "\"/><tags><tag>загружен из OpenCart при создании заказа</tag></tags><description/></company>");
					$log .= "Добавляем дату последней загрузки\n";
                    $attr = $customer->addChild('attribute');
                    $attr->addAttribute('metadataUuid', '979d8a20-bf47-11e5-7a69-8f550003261e');
                    $d = new DateTime();
                    $attr->addAttribute('timeValue', str_replace(' ', 'T', $d->format('Y-m-d H:i:sP')));
                    
					$log .= "Сохраняем контрагента: " . $customer->asXML() . "\n";
                    $customer_xml = $this->updateContact($customer->asXML());
					$log .= "Сохранили контрагента: " . $customer_xml . "\n";
					$customer = simplexml_load_string($customer_xml);
                }
                else{
                    $customer = $customer->company;
					$log .= "Нашли контрагента в базе\n";
                }
                $cu = $customer->uuid.'';
				$log .= "ID контрагента: " . $cu . "\n";
                if($customer && isset($customer->uuid) && !empty($cu))
                {
                    $hasTag = false;
                    if($customer->tags && $customer->tags->tag)
                    {
                        foreach ($customer->tags->tag as $tag) {
                            if($tag == "розничный покупатель")
                            {
                                $hasTag = true;
                                break;
                            }
                        }
                    }
                    if(!$hasTag)
                    {
						$log .= "Добавляем тег\n";
                        $customer->tags->tag[] = "розничный покупатель";
                        $this->updateContact($customer->asXML());
                    }
                    $d = new DateTime();
                    $ms_order = '<?xml version="1.0" encoding="UTF-8"?>
                        <customerOrder
                            vatIncluded="true"
                            applicable="false"
                            sourceStoreUuid="'. $this->config->get('ms_warehouse') .'" 
                            payerVat="true"
                            currencyUuid="897bedf1-d0ff-11e4-90a2-8ecb000bdaa7"
                            sourceAgentUuid="' . $customer->uuid.'' . '" 
                            targetAgentUuid="'. $this->config->get('ms_company') .'"
                            stateUuid="'. $this->config->get('ms_order_status') .'"
                            projectUuid="'. $this->config->get('ms_project') .'"
                            deliveryPlannedMoment="'. str_replace(' ', 'T', $d->format('Y-m-d H:i:sP')) .'"
                            >
                            <description>{{descr}}</description>
                            <sum sum="' . ceil((float)$data['total']) . '00.0" sumInCurrency="' . ceil((float)$data['total']) . '00.0"/>
                            <attribute metadataUuid="67ff1c97-c3c3-11e5-7a69-971100008dc6" entityValueUuid="'. $this->config->get('ms_source') .'"></attribute>';
                    $discount = 0;
                    $description = "Номер заказа " . $this->session->data['order_id'] . ";";
                    if(isset($data['comment']) && !empty($data['comment']))
                    {
                       $description .= "\nКомментарий клиента: " . $data['comment'] . ";";
                    }
                    // Display prices
                    if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
			$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);

					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}

			$sort_order = array();

			foreach ($total_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $total_data);
                        
                        foreach ($total_data as $total) {
                            if($total['code'] == 'discount')
                            {
                                $discount = $total['discount'];
                            }
                            if($total['code'] == 'shipping')
                            {
                                $sc = explode('.', $data['shipping_code'])[1];
                                if($this->config->get('ms_shipping_method') && isset($this->config->get('ms_shipping_method')[$sc]) && !empty($this->config->get('ms_shipping_method')[$sc]))
                                {
                                    $ms_order .= '<customerOrderPosition
                                            goodUuid="' . $this->config->get('ms_shipping_method')[$sc] . '"
                                            quantity="1"
                                            discount="0.0">
                                            <basePrice
                                                sumInCurrency="' . $total['value'] . '00.0"
                                                sum="' . $total['value'] . '00.0"/>
                                        </customerOrderPosition>';
                                }
                                else{
                                    $quote = $this->{'model_shipping_' . $sc}->getQuote('');
                                    foreach ($quote['quote'] as $val)
                                    {
                                        $description .= "\nТип доставки: " . $val['address']. ";";
                                        break;
                                    }
                                    if($total['value'] > 0)
                                    {
                                      $description .= "\nСтоимость доставки: " . $total['value']. ";";  
                                    }
                                }
                                if(isset($data['shipping_address_1']) && !empty($data['shipping_address_1']) && $data['shipping_address_1'] != 'не заполенно')
                                {
                                    $description .= "\nАдрес доставки: " . $this->db->escape($data['shipping_address_1']) . ";";
                                }
                                if(isset($data['shipping_city']) && !empty($data['shipping_city']) && $data['shipping_city'] != 'не заполенно')
                                {
                                    $description .= "\nГород доставки: " . $this->db->escape($data['shipping_city']) . ";";
                                }
                            }
                            if($total['code'] == 'coupon')
                            {
                                $coupon = $this->config->get('ms_coupon');
                                if($this->config->get('ms_coupon') && !empty($coupon))
                                {
                                    $ms_order .= '<customerOrderPosition
                                            goodUuid="' . $coupon . '"
                                            quantity="1"
                                            discount="0.0">
                                            <basePrice
                                                sumInCurrency="' . $total['value'] . '00.0"
                                                sum="' . $total['value'] . '00.0"/>
                                        </customerOrderPosition>';
                                }
                            }
                        }
                    }
                    $products = '';
                    foreach ($data['products'] as $product)
                    {
                        $products .= '<customerOrderPosition
                                goodUuid="' . $product['ms_id'] . '"
                                quantity="' . $product['quantity'] . '"
                                discount="' . ceil($discount) . '.0">

                             <basePrice
                                    sumInCurrency="' . ceil((float)$product['price']) . '00.0"
                                    sum="' . ceil((float)$product['price']) . '00.0"/>

                                <reserve>0.0</reserve>
                            </customerOrderPosition>';
                    }
                    $ms_order .= $products;
                    $ms_order .= '</customerOrder>';
                    
                    $ms_order = str_replace('{{descr}}', $description, $ms_order);
                            
                    try{
                        $response = $this->createMsOrder($ms_order);
                    } catch (Exception $ex) {
                        $message  = "Привет!";
                        $message .= "Я очень старался создать заказ " . $this->session->data['order_id'] . ", но что-то пошло не так:( \n\n";
                        $message .= "Ошибка следующая:" . $ex->message();

                        $mail = new Mail();
                        $mail->protocol = $this->config->get('config_mail_protocol');
                        $mail->parameter = $this->config->get('config_mail_parameter');
                        $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
                        $mail->smtp_username = $this->config->get('config_mail_smtp_username');
                        $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
                        $mail->smtp_port = $this->config->get('config_mail_smtp_port');
                        $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

                        $mail->setTo('info@bardahl-motor.ru');
                        $mail->setFrom($this->config->get('config_email'));
                        $mail->setSender('OpenCart');
                        $mail->setSubject('Ошибка при создании заказа');
                        $mail->setText($message);
                        $mail->send();
                    }
                }
                else{
                    $message  = "Привет!";
                    $message .= "Я очень старался создать заказ " . $this->session->data['order_id'] . ", но не смог ничего сделать с контрагентом \n\n";
                    $message .= "Данные:" . $customer;

                    $mail = new Mail();
                    $mail->protocol = $this->config->get('config_mail_protocol');
                    $mail->parameter = $this->config->get('config_mail_parameter');
                    $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
                    $mail->smtp_username = $this->config->get('config_mail_smtp_username');
                    $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
                    $mail->smtp_port = $this->config->get('config_mail_smtp_port');
                    $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

                    $mail->setTo('info@bardahl-motor.ru');
                    $mail->setFrom($this->config->get('config_email'));
                    $mail->setSender('OpenCart');
                    $mail->setSubject('Ошибка при создании заказа');
                    $mail->setText($message);
                    $mail->send();

                    $mail = new Mail();
                    $mail->protocol = $this->config->get('config_mail_protocol');
                    $mail->parameter = $this->config->get('config_mail_parameter');
                    $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
                    $mail->smtp_username = $this->config->get('config_mail_smtp_username');
                    $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
                    $mail->smtp_port = $this->config->get('config_mail_smtp_port');
                    $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

                }
            }
            else{
                $message  = "Привет!";
                $message .= "Я очень старался создать заказ " . $this->session->data['order_id'] . ", но не смог найти следующие продукты: \n\n";
                $message .= $error_products;

                $mail = new Mail();
                $mail->protocol = $this->config->get('config_mail_protocol');
                $mail->parameter = $this->config->get('config_mail_parameter');
                $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
                $mail->smtp_username = $this->config->get('config_mail_smtp_username');
                $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
                $mail->smtp_port = $this->config->get('config_mail_smtp_port');
                $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

                $mail->setTo('info@bardahl-motor.ru');
                $mail->setFrom($this->config->get('config_email'));
                $mail->setSender('OpenCart');
                $mail->setSubject('Ошибка при создании заказа');
                $mail->setText($message);
                $mail->send();
            }
        }
    }
    
    public function getProducts($filter) {
        $url = $this->ms_url."Good/list?filter=".$filter;

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_USERPWD, $this->config->get('ms_login') . ":" . $this->config->get('ms_pwd'));

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $result = curl_exec($curl);
        $products='';
        if(isset($result) && strlen($result) > 0)
        {
            $products = simplexml_load_string($result);
            if(!$products){
                throw new Exception("Ошибка при приведении ответа от сервера к xml. Result: " . $result);
            }
        }
        else{
            throw new Exception(curl_error($curl));
        }
        curl_close($curl);
        return $products;
    }
    
    public function formatPhone($phone)
    {
        $phone = (string)$phone;
        $result = '';
        if(isset($phone) && !empty($phone))
        {
            $phone = preg_replace("/[^0-9]/", "", $phone);
            if(strlen($phone) == 11)
            {
                $result = '+7 (' . substr($phone, 1, 3) . ') ' . substr($phone, 4, 3) . '-' . substr($phone, 7, 2) . '-'. substr($phone, 9, 2);
            }
            else{
                $result = $phone;
            }
        }
        return $result;
    }
    
    protected function createMsOrder($xml){
        $sock = fsockopen($this->ms_socket, 443, $errno, $errstr, 30);
        if (!$sock) {
            throw new Exception('Ошибка при соединении с моим складом!' .$errstr($errno));
        }

        fputs($sock, "PUT /exchange/rest/ms/xml/CustomerOrder HTTP/1.1\r\n");
        fputs($sock, "Host: online.moysklad.ru\r\n");
        fputs($sock, "Authorization: Basic " . base64_encode($this->config->get('ms_login') . ":" . $this->config->get('ms_pwd')) . "\r\n");
        fputs($sock, "Content-Type: application/xml \r\n");
        fputs($sock, "Accept: */*\r\n");
        fputs($sock, "Content-Length: ".strlen($xml)."\r\n");
        fputs($sock, "Connection: close\r\n\r\n");
        fputs($sock, "$xml");

        while ($str = trim(fgets($sock, 4096)));

        $body = "";

        while (!feof($sock))
        {
            $body.= fgets($sock, 4096);
        }
        fclose($sock);

        return $body;
    }
}