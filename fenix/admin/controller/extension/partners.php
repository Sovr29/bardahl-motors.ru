<?php

class ControllerExtensionPartners extends Controller {

    private $error = array();

    public function index() {
        $this->language->load('extension/partners');

        $this->load->model('extension/partners');

        $this->document->setTitle($this->language->get('heading_title'));

        $url = '';

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/partners', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->error['warning'])) {
            $data['error'] = $this->error['warning'];

            unset($this->error['warning']);
        } else {
            $data['error'] = '';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        $filter_data = array(
            'page' => $page,
            'limit' => $this->config->get('config_limit_admin'),
            'start' => $this->config->get('config_limit_admin') * ($page - 1),
        );

        $total = $this->model_extension_partners->getTotalPartners();

        $pagination = new Pagination();
        $pagination->total = $total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($total - $this->config->get('config_limit_admin'))) ? $total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $total, ceil($total / $this->config->get('config_limit_admin')));

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_title'] = $this->language->get('text_title');
        $data['text_sort_order'] = $this->language->get('text_sort_order');
        $data['text_type'] = $this->language->get('text_type');
        $data['text_type_service'] = $this->language->get('text_type_service');
        $data['text_type_shop'] = $this->language->get('text_type_shop');
        $data['text_type_friends'] = $this->language->get('text_type_friends');
        $data['text_date'] = $this->language->get('text_date');
        $data['text_action'] = $this->language->get('text_action');
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['button_add'] = $this->language->get('button_add');
        $data['button_delete'] = $this->language->get('button_delete');

        $url = '';

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['add'] = $this->url->link('extension/partners/insert', '&token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('extension/partners/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $data['all_partners'] = array();

        $all_partners = $this->model_extension_partners->getAllPartners($filter_data);

        foreach ($all_partners as $partner) {
            $data['all_partners'][] = array(
                'partner_id' => $partner['partner_id'],
                'title' => $partner['title'],
                'type' => $partner['type'],
                'sort_order' => $partner['sort_order'],
                'date_added' => date($this->language->get('date_format_short'), strtotime($partner['date_added'])),
                'edit' => $this->url->link('extension/partners/edit', 'partner_id=' . $partner['partner_id'] . '&token=' . $this->session->data['token'] . $url, 'SSL')
            );
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/partners_list.tpl', $data));
    }

    public function edit() {
        $this->language->load('extension/partners');

        $this->load->model('extension/partners');

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_extension_partners->editPartner($this->request->get['partner_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/partners', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->form();
    }

    public function insert() {
        $this->language->load('extension/partners');

        $this->load->model('extension/partners');

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_extension_partners->addPartner($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/partners', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->form();
    }

    protected function form() {
        $this->language->load('extension/partners');

        $this->load->model('extension/partners');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/partners', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        if (isset($this->request->get['partner_id'])) {
            $data['action'] = $this->url->link('extension/partners/edit', '&partner_id=' . $this->request->get['partner_id'] . '&token=' . $this->session->data['token'], 'SSL');
        } else {
            $data['action'] = $this->url->link('extension/partners/insert', '&token=' . $this->session->data['token'], 'SSL');
        }

        $data['cancel'] = $this->url->link('extension/partners', '&token=' . $this->session->data['token'], 'SSL');

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_image'] = $this->language->get('text_image');
        $data['text_title'] = $this->language->get('text_title');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_short_description'] = $this->language->get('text_short_description');
        $data['text_status'] = $this->language->get('text_status');
        $data['text_sort_order'] = $this->language->get('text_sort_order');
        $data['text_type'] = $this->language->get('text_type');
        $data['text_type_service'] = $this->language->get('text_type_service');
        $data['text_type_shop'] = $this->language->get('text_type_shop');
        $data['text_type_friends'] = $this->language->get('text_type_friends');
        $data['text_address'] = $this->language->get('text_address');
        $data['text_phone'] = $this->language->get('text_phone');
        $data['text_keyword'] = $this->language->get('text_keyword');
        $data['text_href'] = $this->language->get('text_href');
        $data['text_fb'] = $this->language->get('text_fb');
        $data['text_vk'] = $this->language->get('text_vk');
        $data['text_insta'] = $this->language->get('text_insta');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_browse'] = $this->language->get('text_browse');
        $data['text_clear'] = $this->language->get('text_clear');
        $data['text_image_manager'] = $this->language->get('text_image_manager');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['token'] = $this->session->data['token'];

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->error['warning'])) {
            $data['error'] = $this->error['warning'];
        } else {
            $data['error'] = '';
        }

        if (isset($this->request->get['partner_id'])) {
            $partner = $this->model_extension_partners->getPartner($this->request->get['partner_id']);
        } else {
            $partner = array();
        }

        if (isset($this->request->post['partner'])) {
            $data['partner'] = $this->request->post['partner'];
        } elseif (!empty($partner)) {
            $data['partner'] = $this->model_extension_partners->getPartnerDescription($this->request->get['partner_id']);
        } else {
            $data['partner'] = '';
        }

        if (isset($this->request->post['image'])) {
            $data['image'] = $this->request->post['image'];
        } elseif (!empty($partner)) {
            $data['image'] = $partner['image'];
        } else {
            $data['image'] = '';
        }

        $this->load->model('tool/image');

        if (isset($this->request->post['image'])) {
            $data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
        } elseif (!empty($partner)) {
            $data['thumb'] = $this->model_tool_image->resize($partner['image'] ? $partner['image'] : 'no_image.png', 100, 100);
        } else {
            $data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
            ;
        }

        $data['no_image'] = $this->model_tool_image->resize('no_image.png', 100, 100);

        if (isset($this->request->post['href'])) {
            $data['href'] = $this->request->post['href'];
        } elseif (!empty($partner)) {
            $data['href'] = $partner['href'];
        } else {
            $data['href'] = '';
        }
        
        if (isset($this->request->post['keyword'])) {
            $data['keyword'] = $this->request->post['keyword'];
        } elseif (!empty($partner)) {
            $data['keyword'] = $partner['keyword'];
        } else {
            $data['keyword'] = '';
        }
        
        if (isset($this->request->post['fb'])) {
            $data['fb'] = $this->request->post['fb'];
        } elseif (!empty($partner)) {
            $data['fb'] = $partner['fb'];
        } else {
            $data['fb'] = '';
        }
        
        if (isset($this->request->post['vk'])) {
            $data['vk'] = $this->request->post['vk'];
        } elseif (!empty($partner)) {
            $data['vk'] = $partner['vk'];
        } else {
            $data['vk'] = '';
        }

        if (isset($this->request->post['insta'])) {
            $data['insta'] = $this->request->post['insta'];
        } elseif (!empty($partner)) {
            $data['insta'] = $partner['insta'];
        } else {
            $data['insta'] = '';
        }
        
        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($partner)) {
            $data['status'] = $partner['status'];
        } else {
            $data['status'] = '';
        }
        
        if (isset($this->request->post['type'])) {
            $data['type'] = $this->request->post['type'];
        } elseif (!empty($partner)) {
            $data['type'] = $partner['type'];
        } else {
            $data['type'] = '';
        }
        
        if (isset($this->request->post['sort_order'])) {
            $data['sort_order'] = $this->request->post['sort_order'];
        } elseif (!empty($partner)) {
            $data['sort_order'] = $partner['sort_order'];
        } else {
            $data['sort_order'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/partner_form.tpl', $data));
    }

    public function delete() {
        $this->language->load('extension/partners');

        $this->load->model('extension/partners');

        $this->document->setTitle($this->language->get('heading_title'));

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $partner_id) {
                $this->model_extension_partner->deletePartner($partner_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');
        }

        $this->response->redirect($this->url->link('extension/partners', 'token=' . $this->session->data['token'], 'SSL'));
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'extension/partners')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/partners')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

}