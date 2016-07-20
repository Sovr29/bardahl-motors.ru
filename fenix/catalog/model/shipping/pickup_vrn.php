<?php
class ModelShippingPickupVrn extends Model {
	function getQuote($address) {
		$this->load->language('shipping/pickup_vrn');

		$method_data = array();
		
		$quote_data = array();

		$quote_data['pickup_vrn'] = array(
			'code'         => 'pickup.pickup_vrn',
			'title'        => $this->language->get('text_description'),
			'cost'         => 0.00,
			'tax_class_id' => 0,
			'text'         => $this->currency->format(0.00),
                        'sort_order'   => $this->config->get('pickup_vrn_sort_order'),
			'address'      => $this->config->get('pickup_vrn_address')
		);

		$method_data = array(
			'code'       => 'pickup',
			'title'      => $this->language->get('text_title'),
			'quote'      => $quote_data,
			'sort_order' => $this->config->get('pickup_vrn_sort_order'),
			'error'      => false
		);

		return $method_data;
	}
}
