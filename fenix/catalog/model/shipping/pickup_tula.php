<?php
class ModelShippingPickupTula extends Model {
	function getQuote($address) {
		$this->load->language('shipping/pickup_tula');

		$method_data = array();
		
		$quote_data = array();

		$quote_data['pickup_tula'] = array(
			'code'         => 'pickup.pickup_tula',
			'title'        => $this->language->get('text_description'),
			'cost'         => 0.00,
			'tax_class_id' => 0,
			'text'         => $this->currency->format(0.00),
                        'sort_order'   => $this->config->get('pickup_tula_sort_order'),
			'address'      => $this->config->get('pickup_tula_address')
		);

		$method_data = array(
			'code'       => 'pickup',
			'title'      => $this->language->get('text_title'),
			'quote'      => $quote_data,
			'sort_order' => $this->config->get('pickup_tula_sort_order'),
			'error'      => false
		);

		return $method_data;
	}
}
