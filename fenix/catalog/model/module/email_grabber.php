<?php
class ModelModuleEmailGrabber extends Model {
	public function saveData($data) {
            $this->db->query("INSERT INTO `" . DB_PREFIX . "email_grabber` SET name = '" . $this->db->escape($data['name']) . "', email = '" . $this->db->escape($data['email']) . "', phone = '" . $this->db->escape($data['phone']) . "', request_body='" . $this->db->escape($data['request_body']) . "', error='" . $this->db->escape($data['error']) . "', date_added = NOW()");
	}
        
        public function addCoupon($data) {
		$this->event->trigger('pre.admin.coupon.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "coupon SET name = '" . $this->db->escape($data['name']) . "', code = '" . $this->db->escape($data['code']) . "', discount = '" . (float)$data['discount'] . "', type = '" . $this->db->escape($data['type']) . "', total = '" . (float)$data['total'] . "', logged = '" . (int)$data['logged'] . "', shipping = '" . (int)$data['shipping'] . "', date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "', uses_total = '" . (int)$data['uses_total'] . "', uses_customer = '" . (int)$data['uses_customer'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		$coupon_id = $this->db->getLastId();

		return $coupon_id;
	}
}