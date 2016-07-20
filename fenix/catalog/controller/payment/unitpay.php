<?php

class ControllerPaymentUnitpay extends Controller {

    public function callback() {

        echo $this->getResult();
    }

    public function getResult() {
        if (empty($this->request->get['method']) || empty($this->request->get['params']) || !is_array($this->request->get['params'])
        ) {
            return $this->getResponseError('Не верный запрос');
        }

        $method = $this->request->get['method'];
        $params = $this->request->get['params'];

        $this->load->model('checkout/order');
        $arOrder = $this->model_checkout_order->getOrder($params['account']);

        $total_price = round($arOrder['total'] * $arOrder['currency_value'], 2);

        if ($params['sign'] != $this->getMd5Sign($params, $this->config->get('unitpay_key'))) {
            return $this->getResponseError('Не верная цифровая подпись');
        }


        if ($method == 'check') {

            if (!$arOrder) {
                return $this->getResponseError('Не удалось подтвертить платеж');
            }
            $itemsCount = floor($params['sum'] / $total_price);

            if ($itemsCount <= 0) {
                return $this->getResponseError('Суммы ' . $params['sum'] . ' руб. не достаточно для оплаты товара ' .
                                'стоимостью ' . $total_price . ' руб.');
            }



            $checkResult = $this->check($params);
            if ($checkResult !== true) {
                return $this->getResponseError($checkResult);
            }

            return $this->getResponseSuccess('Проверка прошла успешно');
        }

        if ($method == 'pay') {


            if ($arOrder && $arOrder['order_status_id'] === $this->config->get('unitpay_order_status_id')) {
                return $this->getResponseSuccess('Платеж уже совершен');
            }

            if (!$arOrder) {
                return $this->getResponseError('Не удалось подтвертить платеж');
            }

            $this->pay($arOrder);

            return $this->getResponseSuccess('Платеж успешно совершен');
        }

        return $this->getResponseError($method . ' не поддерживается');
    }

    public function Success(){
        
        $this->language->load('payment/unitpay');
        $this->document->setTitle($this->language->get('success_heading_title'));
        
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        
        $account = $this->request->get['account'];
        
        $data['account_id'] = $account;
                
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/unitpay_success.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/payment/unitpay_success.tpl', $data));
        } else {
                $this->response->setOutput($this->load->view('default/template/payment/unitpay_success.tpl', $data));
        }
    }
    
    public function Error(){
        $this->language->load('payment/unitpay');
        $this->document->setTitle($this->language->get('error_heading_title'));
        
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $account = $this->request->get['account'];
        
        $data['account_id'] = $account;
        
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/unitpay_error.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/payment/unitpay_error.tpl', $data));
        } else {
                $this->response->setOutput($this->load->view('default/template/payment/unitpay_error.tpl', $data));
        }
    }
    private function getResponseSuccess($message) {
        return json_encode(array(
            "jsonrpc" => "2.0",
            "result" => array(
                "message" => $message
            ),
            'id' => 1,
        ));
    }

    private function getResponseError($message) {
        return json_encode(array(
            "jsonrpc" => "2.0",
            "error" => array(
                "code" => -32000,
                "message" => $message
            ),
            'id' => 1
        ));
    }

    private function getMd5Sign($params, $secretKey) {
        ksort($params);
        unset($params['sign']);
        return md5(join(null, $params) . $secretKey);
    }

    private function check($params) {

        if ($this->model_checkout_order->getOrder($params['account'])) {
            return true;
        }
        return 'Заказ не найден';
    }

    private function pay($params) {
        $new_order_status_id = $this->config->get('unitpay_order_status_id');
        $this->model_checkout_order->updateUnitPayOrderStatus($params['order_id'], $new_order_status_id);
    }

}

?>