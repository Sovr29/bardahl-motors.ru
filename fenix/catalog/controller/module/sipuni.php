<?php
class ControllerModuleSipuni extends Controller {
	public function getCallerInfo() {
            $json = array(
                'choice' => 1
            );
            $ip = $this->getClientIp();
      		$file = 'sipuni.log';
            $current = file_get_contents($file);
      		$current .= date("Y-m-d H:i:s")." ";
            $current .= $ip."\n";
            if($ip == "212.193.100.28")
            {
                $phone = $this->request->get['fromnum'];
              $current .= $phone."\n";
                if($phone == '84996478898')
                {
                  $json['name'] = 'Sipuni';
                }
              	else if(isset($phone) && ! empty($phone))
                {
                    try{
                        $this->load->model('module/ms');
                        $contact = $this->model_module_ms->getContact(array(
                            'phone' => $this->model_module_ms->formatPhone($phone)
                        ));
                        if($contact->company)
                        {
                            $json['name'] = $contact->company->attributes()->name.'';
                        }
                    }
                    catch(Exception $e){}
                }
            }
      		$current .= json_encode($json)."\n";
      		file_put_contents($file, $current);
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
        }
        
        // Function to get the client IP address
        private function getClientIp() {
            $ipaddress = '';
            if (isset($this->request->server['HTTP_CLIENT_IP'])){
                $ipaddress = $this->request->server['HTTP_CLIENT_IP'];
            }
            else if(isset($this->request->server['HTTP_X_FORWARDED_FOR'])){
                $ipaddress = $this->request->server['HTTP_X_FORWARDED_FOR'];            
            }            
            else if(isset($this->request->server['HTTP_X_FORWARDED'])){
                $ipaddress = $this->request->server['HTTP_X_FORWARDED'];
            }
            else if(isset($this->request->server['HTTP_FORWARDED_FOR'])){
                $ipaddress = $this->request->server['HTTP_FORWARDED_FOR'];
            }
            else if(isset($this->request->server['HTTP_FORWARDED'])){
                $ipaddress = $this->request->server['HTTP_FORWARDED'];
            }
            else if(isset($this->request->server['REMOTE_ADDR'])){
                $ipaddress = $this->request->server['REMOTE_ADDR'];
            }
            else{
                $ipaddress = 'UNKNOWN';
            }
            return $ipaddress;
        }
		
		private function rus2translit($string) {
			$converter = array(
				'а' => 'a',   'б' => 'b',   'в' => 'v',
				'г' => 'g',   'д' => 'd',   'е' => 'e',
				'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
				'и' => 'i',   'й' => 'y',   'к' => 'k',
				'л' => 'l',   'м' => 'm',   'н' => 'n',
				'о' => 'o',   'п' => 'p',   'р' => 'r',
				'с' => 's',   'т' => 't',   'у' => 'u',
				'ф' => 'f',   'х' => 'h',   'ц' => 'c',
				'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
				'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
				'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
				
				'А' => 'A',   'Б' => 'B',   'В' => 'V',
				'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
				'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
				'И' => 'I',   'Й' => 'Y',   'К' => 'K',
				'Л' => 'L',   'М' => 'M',   'Н' => 'N',
				'О' => 'O',   'П' => 'P',   'Р' => 'R',
				'С' => 'S',   'Т' => 'T',   'У' => 'U',
				'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
				'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
				'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
				'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
			);
			return strtr($string, $converter);
		}
}
