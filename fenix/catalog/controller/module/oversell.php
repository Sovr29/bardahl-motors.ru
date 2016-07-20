<?php  
class ControllerModuleOverSell extends Controller {
        
    public function index() {
        $settings_products = $this->config->get('oversell_products');
        if(isset($settings_products) && is_array($settings_products) && $this->cart->hasProducts() && $this->config->get('oversell_limit') > 0)
        {
            $products = $this->cart->getProducts();
            foreach ($products as $product) {
                if(($key = array_search($product['product_id'], $settings_products)) !== false) {
                    unset($settings_products[$key]);
                }
            }
            if(count($settings_products) > 0)
            {
                $this->document->addScript('catalog/view/theme/bardahl/js/oversell.js');

                $this->document->addScriptText("
                            function addCallback(){
                                if($('.modal-body .catalog-premium .alert-success').length === 0)
                                {
                                    $('.modal-body .catalog-premium').prepend($('<div class=\"alert alert-success\"><i class=\"fa fa-check-circle\"></i> Корзина покупок изменена!<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button></div>'));
                                }
                            };
                            $('#checkout_submit_btn').oversell()");
                
                $this->load->model('catalog/product');
                $this->load->model('tool/image');
                $this->load->language('module/oversell');
                
                $data['products'] = array();
                foreach (array_slice($settings_products, 0, $this->config->get('oversell_limit'), true) as $product_id) {
			$p = $this->model_catalog_product->getProduct($product_id);
                        if ($p['image']) {
                            $image = $this->model_tool_image->resize($p['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                        } else {
                            $image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                        }
                        
                        if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                            $price = $this->currency->format($this->tax->calculate($p['price'], $p['tax_class_id'], $this->config->get('config_tax')));
                        } else {
                            $price = false;
                        }
                        
                        $data['products'][] = array(
                                'product_id'  => $p['product_id'],
                                'quantity'  => $p['quantity'],
                                'thumb'       => $image,
                                'type'       =>  $typetmp,
                                'name'        => $p['name'],
                                'description' => utf8_substr(strip_tags(html_entity_decode($p['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
                                'short_description' => strip_tags(html_entity_decode($p['short_description'], ENT_QUOTES, 'UTF-8'), 0),
                                'price'       => $price,
                                'special'     => $special,
                                'tax'         => $tax,
                                'minimum'     => $p['minimum'] > 0 ? $p['minimum'] : 1,
                                'rating'      => $p['rating'],
                                'href'        => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $p['product_id'])
                        );
		}
                $data['text'] = html_entity_decode($this->config->get('oversell_text'), ENT_QUOTES);   
                $data['button_text'] = $this->language->get('text_button');
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/oversell.tpl')) {
                    $view = $this->load->view($this->config->get('config_template') . '/template/module/oversell.tpl', $data);
                } else {
                    $view = $this->load->view('default/template/module/oversell.tpl', $data);
                }
                return $view;
            }
        }
    }
}