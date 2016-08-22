<?php
class ModelCatalogProductType extends Model {

        public function add($type) {

            $this->db->query("INSERT INTO " . DB_PREFIX . "product_type SET name = '".$this->db->escape($type['name'])."' ,  description='".$this->db->escape($type['description'])."'");
        }


        public function update($type, $type_id) {
            $this->db->query("UPDATE " . DB_PREFIX . "product_type SET name = '".$this->db->escape($type['name'])."' ,  description='".$this->db->escape($type['description'])."' WHERE type_id = '".(int)$type_id."' LIMIT 1");
        }

        public function delete($type_id) {
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_type WHERE type_id = '" . (int)$type_id . "'");
        }

        public function getType($type_id) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_type WHERE type_id = '".(int)$type_id."' LIMIT 1 ");
            if ($query->row) {
                return $query->row;
            } else {
                return array(
                    'name'=>'',
                    'description'=>'',
                    'type_id'=>0
                );
            }

        }

        public function getTypes() {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_type");
            return $query->rows;
        }

        public function getTypesFiltred($category_id){
        	$sql = "SELECT distinct d.name as 'cat_name', t.name as 'type_name', p.type_id FROM " . DB_PREFIX . "category m
        		left join " . DB_PREFIX . "category_description d on m.category_id = d.category_id
				left join " . DB_PREFIX . "product_to_category c on d.category_id = c.category_id
				left join " . DB_PREFIX . "product p on c.product_id = p.product_id
				left join " . DB_PREFIX . "product_type t on p.type_id = t.type_id
       			WHERE m.parent_id  = ".(int)$category_id;

        	$query = $this->db->query($sql);

        	if ($query->rows) {
        		return $query->rows;
        	} else {
        		return array(
        				'cat_name'=>'',
        				'type_name'=>'',
        				'type_id'=>0
        		);
        	}
        }

        public function getTotalTypes() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_type");

		return $query->row['total'];
	}

}
