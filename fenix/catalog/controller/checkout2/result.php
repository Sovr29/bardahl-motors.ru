<?php

class ControllerCheckout2Result extends Controller {
    public function index() {
        $mrh_pass2  = $this->config->get('robocassa_key3');       
        

        if (isset($_REQUEST["OutSum"])) {
            // чтение параметров
            // read parameters
            $out_summ = $_REQUEST["OutSum"];
            $inv_id = $_REQUEST["InvId"];
            $crc = $_REQUEST["SignatureValue"];
            $Shp_item = $_REQUEST["Shp_item"];

            // HTTP parameters: $out_summ, $inv_id, $crc
            $crc = strtoupper($crc);   // force uppercase

            // build own CRC
            $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2:Shp_item=$Shp_item"));
            
            

            if (strtoupper($my_crc) != strtoupper($crc))
            {
              echo "bad sign\n";
              exit();
            }

            $this->load->model('checkout2/order');	
            $this->model_checkout2_order->addOrderHistory($inv_id, $this->config->get('robocassa_order_status_id'));
        }
    }
}
