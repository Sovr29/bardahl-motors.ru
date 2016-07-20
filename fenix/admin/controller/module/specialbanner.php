<?php

class ControllermoduleSpecialBanner extends Controller{
    protected $title;
    
    public function index(){
        
        $this->load->model("module/specialbanner");
        $this->load->language("module/specialbanner");
        
        $this->title = $this->language->get('heading_title');
        
        $this->document->setTitle($this->title);

        $data['action'] = "";
        $data['heading_title'] = $this->title;
        $data['button'] = $this->language->get('text_button');
        $data['text_specialbanner'] = $this->language->get('text_module');

        
        if(($this->request->server['REQUEST_METHOD'] == 'POST')){
            $spec_ban_id = $this->model_module_specialbanner->selectSpecialBannerId();
            if(isset($spec_ban_id) && $spec_ban_id != 0){
                $products_id = $this->model_module_specialbanner->selectSpecialProductsIds();

                $count_ids = count($products_id);
                
                
                $this->model_module_specialbanner->deleteProductsFromBanner($spec_ban_id); // не правильно, т.к. далее может не быть новых продуктов или выпасть ошибка
                
                for($i = 0; $i < $count_ids; $i++){             
                    
                    $prod_id = $products_id[$i]['product_id'];
                    
                    $prod_info = $this->model_module_specialbanner->selectProductInfo($prod_id); 
                    
                    $this->model_module_specialbanner->generateBanner($spec_ban_id, $prod_id, $prod_info);
                }


            } else{
                $data['message'] = $this->language->get('create_special_banner');
            }
        }


        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $this->response->setOutput($this->load->view('module/specialbanner.tpl', $data));
    }
}

