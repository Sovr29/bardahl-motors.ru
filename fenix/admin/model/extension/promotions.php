<?php
class ModelExtensionPromotions extends Model {
	public function addPromotion($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "promotions SET image = '" . $this->db->escape($data['image']) . "', date_added = NOW(), status = '" . (int)$data['status'] . "', show_on_main_page = " . (int)$data['show_on_main_page'] . "");
		
		$promotion_id = $this->db->getLastId();
		
		foreach ($data['promotion'] as $key => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX ."promotions_description SET promotion_id = '" . (int)$promotion_id . "', language_id = '" . (int)$key . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "', meta_keyword='" . $this->db->escape($value['meta_keyword']) . "', meta_description='" . $this->db->escape($value['meta_description']) . "'");
		}
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'promotion_id=" . (int)$promotion_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
	}
	
	public function editPromotion($promotion_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "promotions SET image = '" . $this->db->escape($data['image']) . "', status = '" . (int)$data['status'] . "', show_on_main_page = " . (int)$data['show_on_main_page'] . " WHERE promotion_id = '" . (int)$promotion_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "promotions_description WHERE promotion_id = '" . (int)$promotion_id. "'");
		
		foreach ($data['promotion'] as $key => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX ."promotions_description SET promotion_id = '" . (int)$promotion_id . "', language_id = '" . (int)$key . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "', meta_keyword='" . $this->db->escape($value['meta_keyword']) . "', meta_description='" . $this->db->escape($value['meta_description']) . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'promotion_id=" . (int)$promotion_id. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'promotion_id=" . (int)$promotion_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
                
                $this->db->query("DELETE FROM " . DB_PREFIX . "promotions_periods WHERE promotion_id=" . (int)$promotion_id);
                if($data['date_periods'])
                {
                    foreach ($data['date_periods'] as $period)
                    {                        
                        list($dateBegin, $dateEnd) = split('#', $period);
                        $this->db->query("INSERT INTO " . DB_PREFIX ."promotions_periods SET promotion_id = '" . (int)$promotion_id . "', date_begin = '" . $dateBegin . "', date_end = '" . $dateEnd . "'");
                    }
                }
	}
	
	public function getPromotions($promotion_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'promotion_id=" . (int)$promotion_id . "') AS keyword FROM " . DB_PREFIX . "promotions WHERE promotion_id = '" . (int)$promotion_id . "'"); 
 
		if ($query->num_rows) {
			return $query->row;
		} else {
			return false;
		}
	}
   
	public function getPromotionDescription($promotion_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "promotions_description WHERE promotion_id = '" . (int)$promotion_id . "'"); 
		
		foreach ($query->rows as $result) {
			$promotion_description[$result['language_id']] = array(
				'title'       			=> $result['title'],
				'short_description'		=> $result['short_description'],
				'description' 			=> $result['description'],
                                'meta_keyword' 			=> $result['meta_keyword'],
                                'meta_description' 		=> $result['meta_description']
			);
		}
		
		return $promotion_description;
	}
 
        public function getPromotionPeriods($promotion_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "promotions_periods WHERE promotion_id = '" . (int)$promotion_id . "'"); 
		
		foreach ($query->rows as $result) {
			$promotion_periods[$result['promotion_period_id']] = array(
				'date_begin'		=> date_format(date_create($result['date_begin']), 'Y-m-d'),
				'date_end'              => date_format(date_create($result['date_end']), 'Y-m-d')
			);
		}
		
		return $promotion_periods;
	}
        
	public function getAllPromotions($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "promotions n LEFT JOIN " . DB_PREFIX . "promotions_description nd ON n.promotion_id = nd.promotion_id WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY date_added DESC";
		
		if (isset($data['start']) && isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}
			
			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}	
		
		$query = $this->db->query($sql);
 
		return $query->rows;
	}
   
	public function deletePromotion($promotion_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "promotions WHERE promotion_id = '" . (int)$promotion_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "promotions_description WHERE promotion_id = '" . (int)$promotion_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'promotion_id=" . (int)$promotion_id. "'");
	}
   
	public function getTotalPromotions() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "promotions");
	
		return $query->row['total'];
	}
}