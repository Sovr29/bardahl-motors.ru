<?php
class ControllerApiMs extends Controller {

    public function getCompanies() {
            $this->load->language('api/ms');

            $json = array();

            if (!isset($this->session->data['api_id'])) {
                    $json['error'] = $this->language->get('error_permission');
            } else {
                $this->load->model('module/ms');
                $companies = $this->model_module_ms->getCompanies();
                $json['companies'] = array();
                foreach ($companies as $company)
                {
                    $json['companies'][] = array(
                      'id'      => $company->uuid.'',
                      'name'    => $company->attributes()->name.''
                    );
                }
            }

            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
    }
    
    public function getStatuses() {
        $this->load->language('api/ms');

        $json = array();

        try{
            if (!isset($this->session->data['api_id'])) {
                    $json['error'] = $this->language->get('error_permission');
            } else {
                $this->load->model('module/ms');
                $statuses = $this->model_module_ms->getStatuses();
                $json['statuses'] = array();
                foreach ($statuses->workflow->state as $status)
                {
                    $json['statuses'][] = array(
                      'id'      => $status->uuid.'',
                      'name'    => $status->attributes()->name.''
                    );
                }
            }
        }
        catch (Exception $e) {
            $json['error'] = 'Ошибка!' .strip_tags($e->getMessage());
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    
    public function getWarehouses() {
        $this->load->language('api/ms');

        $json = array();

        try{
            if (!isset($this->session->data['api_id'])) {
                    $json['error'] = $this->language->get('error_permission');
            } else {
                $this->load->model('module/ms');
                $warehouses = $this->model_module_ms->getWarehouses();
                $json['warehouses'] = array();
                foreach ($warehouses as $status)
                {
                    $json['warehouses'][] = array(
                      'id'      => $status->uuid.'',
                      'name'    => $status->attributes()->name.''
                    );
                }
            }
        }
        catch (Exception $e) {
            $json['error'] = 'Ошибка!' .strip_tags($e->getMessage());
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));    
    }
    
    public function getProjects() {
        $this->load->language('api/ms');

        $json = array();

        try{
            if (!isset($this->session->data['api_id'])) {
                    $json['error'] = $this->language->get('error_permission');
            } else {
                $this->load->model('module/ms');
                $projects = $this->model_module_ms->getProjects();
                $json['projects'] = array();
                foreach ($projects as $project)
                {
                    $json['projects'][] = array(
                      'id'      => $project->uuid.'',
                      'name'    => $project->attributes()->name.''
                    );
                }
            }
        }
        catch (Exception $e) {
            $json['error'] = 'Ошибка!' .strip_tags($e->getMessage());
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));    
    }
    
    public function getSources() {
        $this->load->language('api/ms');

        $json = array();

        try{
            if (!isset($this->session->data['api_id'])) {
                    $json['error'] = $this->language->get('error_permission');
            } else {
                $this->load->model('module/ms');
                $sources = $this->model_module_ms->getSources();
                $json['sources'] = array();
                foreach ($sources as $source)
                {
                    $json['sources'][] = array(
                      'id'      => $source->uuid.'',
                      'name'    => $source->attributes()->name.''
                    );
                }
            }
        }
        catch (Exception $e) {
            $json['error'] = 'Ошибка!' .strip_tags($e->getMessage());
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));    
    }
    
    public function getCoupons() {
        $this->load->language('api/ms');

        $json = array();

        try{
            if (!isset($this->session->data['api_id'])) {
                    $json['error'] = $this->language->get('error_permission');
            } else {
                $this->load->model('module/ms');
                $coupons = $this->model_module_ms->getCoupons();
                $json['coupons'] = array();
                foreach ($coupons as $coupon)
                {
                    $json['coupons'][] = array(
                      'id'      => $coupon->uuid.'',
                      'name'    => $coupon->attributes()->name.''
                    );
                }
            }
        }
        catch (Exception $e) {
            $json['error'] = 'Ошибка!' .strip_tags($e->getMessage());
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));    
    }
    
    public function getShippingMethods() {
        $this->load->language('api/ms');

        $json = array();

        try{
            if (!isset($this->session->data['api_id'])) {
                    $json['error'] = $this->language->get('error_permission');
            } else {
                $this->load->model('module/ms');
                $shipping_methods = $this->model_module_ms->getShippingMethods();
                $json['shipping_methods'] = array();
                foreach ($shipping_methods as $shipping_method)
                {
                    $json['shipping_methods'][] = array(
                      'id'      => $shipping_method->uuid.'',
                      'name'    => $shipping_method->attributes()->name.''
                    );
                }
            }
        }
        catch (Exception $e) {
            $json['error'] = 'Ошибка!' .strip_tags($e->getMessage());
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));    
    }
}