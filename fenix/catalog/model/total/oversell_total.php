<?php
class ModelTotalOverSellTotal extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
            foreach ($this->cart->getProducts() as $product) {
                if (isset($product['isOversell']) && $product['isOversell'] === 1)
                {
                    $sub_total = $this->cart->getSubTotal();
                    $discount = $sub_total / 100 * $this->config->get('oversell_total_discount');
                    $total_data[] = array(
					'code'       => 'oversell_total',
					'title'      => 'Дополнительная скидка (' . $this->config->get('oversell_total_discount') . '%)',
                                        'value'      => -$discount,
					'sort_order' => $this->config->get('oversell_total_sort_order')
				);
                    $total -= $discount;
                    break;
                }
            }	
	}
}