<?php

class ModelModuleSpecialBanner extends Model{
    
    /**
     * get id of special banner
     * @return int
     */
    public function selectSpecialBannerId(){
        $result = $this->db->query("SELECT banner_id FROM " . DB_PREFIX . "banner "
                . "WHERE name = 'specialBanner'");
        if($result->num_rows){
            return (int)$result->row['banner_id'];
        } else return 0;
    }
    
    /**
     * select the special products id numbers from db
     * @return array
     */
    public function selectSpecialProductsIds(){
        $result = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_special WHERE (`date_start` <= NOW()) AND (`date_end` >= NOW())");
        $num_rows = $result->num_rows;
        if($num_rows > 0){
            return $result->rows;
        } else return array();
    }
    
    /**
     * 
     * @param int $product_id
     * @return array
     */
    public function selectProductInfo($product_id){
        $result = $this->db->query("SELECT model, image, sort_order, price, product_id FROM " . DB_PREFIX ."product WHERE product_id = '" . (int)$product_id . "'");
        
        if($result->num_rows){
            return $result->row;
        } else return array();
    }
    
    public function generateBanner($banner_id, $product_id, $data){
        
        $this->db->query("INSERT INTO " . DB_PREFIX . "banner_image (banner_image_id,"
                                                                . "banner_id,"
                                                                . "link,"
                                                                . "image,"
                                                                . "sort_order) VALUES (NULL,"
                                                                                    . $banner_id . ","
                                                                                    . "'?route=product/product&product_id=" . (int)$product_id . "',"
                                                                                    . "'" . $data['image'] . "',"
                                                                                    . (int)$data['sort_order'] . ")");
        
        $banner_image_id = $this->db->getLastId();
        
        
        
        
        
        $this->db->query("INSERT INTO " . DB_PREFIX . "banner_image_description (banner_image_id, language_id, banner_id, title, price, product_id) VALUES (" . (int)$banner_image_id . ", 1, " . (int)$banner_id . ", '" . $this->db->escape($data['model']) . "', '" . $data['price'] . "', " . (int)$data['product_id'] . ")");
        
                                                                                        
        
    }
    
    public function deleteProductsFromBanner($banner_id){
        $this->db->query("DELETE FROM " . DB_PREFIX . "banner_image WHERE banner_id = " . $banner_id);
        $this->db->query("DELETE FROM " . DB_PREFIX . "banner_image_description WHERE banner_id = " . $banner_id);
    }
}