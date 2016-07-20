<?php
class ModelShippingPickupMsk extends Model {
	function getQuote($address) {
		$this->load->language('shipping/pickup_msk');

		$method_data = array();

		$quote_data = array();

		$quote_data['pickup_msk'] = array(
			'code'         => 'pickup.pickup_msk',
			'title'        => $this->language->get('text_description'),
			'cost'         => 0.00,
			'tax_class_id' => 0,
			'text'         => $this->currency->format(0.00),
			'address'      => $this->config->get('pickup_msk_address'),
                        'sort_order' => $this->config->get('pickup_msk_sort_order')
		);

		$method_data = array(
			'code'       => 'pickup',
			'title'      => $this->language->get('text_title'),
			'quote'      => $quote_data,
			'sort_order' => $this->config->get('pickup_msk_sort_order'),
			'error'      => false
		);

		return $method_data;
	}
}
