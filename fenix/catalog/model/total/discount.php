<?php
class ModelTotalDiscount extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {

		$discount_customer_group_id = (int)$this->config->get('discount_customer_group_id');

		//$auth = $this->customer->isLogged() && ($discount_customer_group_id != (int)$this->customer->getCustomerGroupId());

                $auth = "";
                
		$notAuth = !$this->customer->isLogged() && ($discount_customer_group_id != (int)$this->config->get('config_customer_group_id'));

		
		if($discount_customer_group_id !== 0 && ($auth || $notAuth)) {
			return;
		}

		$this->load->language('total/discount');

	 
		$sub_total = $this->cart->getSubTotal();

		$perc = 0;
                $next_perc = 0;
                $break = false;
                $show_possible_discount = false;
		foreach(explode(',', $this->config->get('discount_totals')) as $data) {
			$data = explode(':', $data);
                        if($break)
                        {
                            if (isset($data[1])) {
                                $next_perc = $data[1];
                            }
                            break;
                        }
			if ($data[0] > $sub_total) {
				if (isset($data[1])) {
                                    $perc = $data[1];
				}
                                if (isset($data[2]) && $data[2] > 0) {
                                    $possible_discount = $data[0] - $sub_total;
                                    $show_possible_discount = ($sub_total >= $data[2]);
				}
                            $break = true;
			}
		}
                if($show_possible_discount)
                {
                    $total_data[] = array(
                        'show_possible_discount'    => true,
                        'code'                      => 'discount',
                        'title'                     => sprintf($this->language->get('text_possible_discount'), $next_perc),
                        'text'                      => 'здесь могла бы быть ваша скидка',
                        'value'                     => $possible_discount,
                        'sort_order'                => $this->config->get('discount_sort_order')
                    );
                }
		if ($perc == 0) {
			return;
		}
		$discount =  - $sub_total/100 * $perc;
		$total += $discount;
		$total_data[] = array(
			'code'       => 'discount',
			'title'      => sprintf($this->language->get('text_discount'), $perc),
			'text'       => $this->currency->format($discount),
			'value'      => $discount,
                        'discount'   => $perc,
			'sort_order' => $this->config->get('discount_sort_order')
		);
	}
}
?>