<?php
class ModelPartnersList extends Model {	
 
	public function getAllPartners() {
		$sql = "SELECT * FROM " . DB_PREFIX . "partner p LEFT JOIN " . DB_PREFIX . "partner_description pd ON p.partner_id = pd.partner_id WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' ORDER BY type, sort_order, date_added DESC";
		
		if (isset($data['start']) && isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}
			
			if ($data['limit'] < 1) {
				$data['limit'] = 10;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}	
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
}