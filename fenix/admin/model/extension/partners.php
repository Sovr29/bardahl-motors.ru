<?php
class ModelExtensionPartners extends Model {
	public function addPartner($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "partner SET image = '" . $this->db->escape($data['image']) . "', date_added = NOW(), status = '" . (int)$data['status'] . "', type = '" . (int)$data['type'] . "', href = '" . $this->db->escape($data['href']) . "', fb = '" . $this->db->escape($data['fb']) . "', vk = '" . $this->db->escape($data['vk']) . "', insta = '" . $this->db->escape($data['insta']) . "', sort_order = " . (int)$data['sort_order']);
		
		$partner_id = $this->db->getLastId();
		
		foreach ($data['partner'] as $key => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX ."partner_description SET partner_id = '" . (int)$partner_id . "', language_id = '" . (int)$key . "', title = '" . $this->db->escape($value['title']) . "', address = '" . $this->db->escape($value['address']) . "', phone = '" . $this->db->escape($value['phone']) . "'");
		}
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'partner_id=" . (int)$partner_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
	}
	
	public function editPartner($partner_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "partner SET image = '" . $this->db->escape($data['image']) . "', status = '" . (int)$data['status'] . "', type = '" . (int)$data['type'] . "', href = '" . $this->db->escape($data['href']) . "', fb = '" . $this->db->escape($data['fb']) . "', vk = '" . $this->db->escape($data['vk']) . "', insta = '" . $this->db->escape($data['insta']) . "', sort_order = " . (int)$data['sort_order']." WHERE partner_id = '" . (int)$partner_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "partner_description WHERE partner_id = '" . (int)$partner_id. "'");
		
		foreach ($data['partner'] as $key => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX ."partner_description SET partner_id = '" . (int)$partner_id . "', language_id = '" . (int)$key . "', title = '" . $this->db->escape($value['title']) . "', address = '" . $this->db->escape($value['address']) . "', phone = '" . $this->db->escape($value['phone']) . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'partner_id=" . (int)$partner_id. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'partner_id=" . (int)$partner_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
	}
	
	public function getPartner($partner_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'partner_id=" . (int)$partner_id . "') AS keyword FROM " . DB_PREFIX . "partner WHERE partner_id = '" . (int)$partner_id . "'"); 
 
		if ($query->num_rows) {
			return $query->row;
		} else {
			return false;
		}
	}
   
	public function getPartnerDescription($partner_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "partner_description WHERE partner_id = '" . (int)$partner_id . "'"); 
		
		foreach ($query->rows as $result) {
			$partner_description[$result['language_id']] = array(
				'title'       		=> $result['title'],
				'address'		=> $result['address'],
				'phone' 		=> $result['phone']
			);
		}
		
		return $partner_description;
	}
 
	public function getAllPartners($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "partner p LEFT JOIN " . DB_PREFIX . "partner_description pd ON p.partner_id = pd.partner_id WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY type, sort_order, date_added DESC";
		
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
   
	public function deletePartner($partner_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "partner WHERE partner_id = '" . (int)$partner_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "partner_description WHERE partner_id = '" . (int)$partner_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'partner_id=" . (int)$partner_id. "'");
	}
   
	public function getTotalPartners() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "partner");
	
		return $query->row['total'];
	}
}