<?php
class ModelExtensionPromotions extends Model {	
	
	public function getAllPromotions() {
		$sql = "SELECT * FROM " . DB_PREFIX . "promotions p INNER JOIN " . DB_PREFIX . "promotions_periods pp ON pp.promotion_id = p.promotion_id LEFT OUTER JOIN " . DB_PREFIX . "promotions_description pd ON pd.promotion_id = p.promotion_id WHERE p.status = 1 order by pp.date_begin desc, pp.date_end desc";	
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
        
        public function getPromotion($promotion_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "promotions p INNER JOIN " . DB_PREFIX . "promotions_periods pp ON pp.promotion_id = p.promotion_id LEFT OUTER JOIN " . DB_PREFIX . "promotions_description pd ON pd.promotion_id = p.promotion_id WHERE p.status = 1 and p.promotion_id=".$promotion_id;
		
		$query = $this->db->query($sql);
		
		return $query->row;
	}
}