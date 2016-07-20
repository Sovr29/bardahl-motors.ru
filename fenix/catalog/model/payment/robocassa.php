<?php

class ModelPaymentRobocassa extends Model {
    public function getMethod($address, $total) {
		

		
                $method_data = array(
				'title' => 'Робокасса',
                                'code' => 'robocassa',
				'terms'      => '',
				'sort_order' => $this->config->get('robocassa_sort_order')
			);
		

		return $method_data;
	}
}

