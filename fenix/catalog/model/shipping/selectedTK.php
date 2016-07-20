<?php
class ModelShippingSelectedTK extends Model {
	function getQuote($address) {
		$this->load->language('shipping/selectedTK');

		$method_data = array();
		$cost = 0;
		$total = $this->cart->getTotal();

		$rates = explode(',', $this->config->get('selectedTK_rate'));

		foreach ($rates as $rate) {
			$data = explode(':', $rate);

			if ($data[0] > $total) {
				if (isset($data[1])) {
					$cost = $data[1];
				}

				break;
			}
		}

		$quote_data = array();

		$quote_data['selectedTK'] = array(
			'code'         => 'delivery.selectedTK',
			'title'        => $this->language->get('text_title'),
			'address'      => $this->language->get('text_title_address'),
			'cost'         => $cost,
			'sort_order'   => $this->config->get('selectedTK_sort_order')
		);

		$method_data = array(
			'code'       => 'delivery',
			'title'      => $this->language->get('text_shipping'),
			'quote'      => $quote_data,
			'error'      => false
		);

		return $method_data;
	}
}