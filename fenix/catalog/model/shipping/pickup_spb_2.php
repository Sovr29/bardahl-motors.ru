<?php
class ModelShippingPickupSpb2 extends Model {
	function getQuote($address) {
		$this->load->language('shipping/pickup_spb_2');

		$method_data = array();
		
		$quote_data = array();

		$quote_data['pickup_spb_2'] = array(
			'code'         => 'pickup.pickup_spb_2',
			'title'        => $this->language->get('text_description'),
			'cost'         => 0.00,
			'tax_class_id' => 0,
			'text'         => $this->currency->format(0.00),
                        'sort_order'   => $this->config->get('pickup_spb_2_sort_order'),
			'address'      => $this->config->get('pickup_spb_2_address')
		);

		$method_data = array(
			'code'       => 'pickup',
			'title'      => $this->language->get('text_title'),
			'quote'      => $quote_data,
			'sort_order' => $this->config->get('pickup_spb_2_sort_order'),
			'error'      => false
		);

		return $method_data;
	}
}
