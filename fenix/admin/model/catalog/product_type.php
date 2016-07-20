<?php
class ModelCatalogProductType extends Model {
        
        public function add($type) {

            $this->db->query("INSERT INTO " . DB_PREFIX . "product_type SET name = '".$this->db->escape($type['name'])."' ,  description='".$this->db->escape($type['description'])."',  sort_order=".$this->db->escape($type['sort_order']));
        }
        
        
        public function update($type, $type_id) {
            $this->db->query("UPDATE " . DB_PREFIX . "product_type SET name = '".$this->db->escape($type['name'])."' ,  description='".$this->db->escape($type['description'])."',  sort_order=".$this->db->escape($type['sort_order'])." WHERE type_id = '".(int)$type_id."' LIMIT 1");
        }
        
        public function delete($type_id) {
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_type WHERE type_id = '" . (int)$type_id . "'");
        }

        public function getType($type_id) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_type WHERE type_id = '".(int)$type_id."' LIMIT 1 ");
            return $query->row;
        }
        
        public function getTypes() {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_type order by sort_order");
            return $query->rows;
        }

        public function getTotalTypes() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_type");

		return $query->row['total'];
	}	
	
}
