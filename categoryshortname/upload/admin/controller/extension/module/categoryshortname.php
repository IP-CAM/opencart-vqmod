<?php


 class ControllerExtensionModuleCategoryShortName extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('extension/module/categoryshortname');
        $this->document->setTitle($this->language->get('heading_title1'));
        $this->load->model('setting/setting');
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('categoryshortname', $this->request->post);
			
			if(isset($this->request->post['categoryshortname']['status'])){
				$status = $this->request->post['categoryshortname']['status'];
			}else{
                $status = "0";
			}
			$store_id = isset($this->request->get['store_id']) ? $this->request->get['store_id'] : 0 ;
		    $this->model_setting_setting->editSetting('module_', array('module_categoryshortname_status' => $status), $store_id);
			
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
        }

        $data['heading_title'] = $this->language->get('heading_title1');


        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['text_form'] = $this->language->get('text_form');

        $data['entry_option_show'] = $this->language->get('entry_option_show');
        $data['text_status'] = $this->language->get('text_status');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['tab_support'] = $this->language->get('tab_support');
        $data['tab_setting'] = $this->language->get('tab_setting');

        $data['entry_setting'] = $this->language->get('entry_setting');
        $data['entry_value'] = $this->language->get('entry_value');


        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $data['categoryshortname'] = $this->request->post['categoryshortname'];
        } else {
            $data['categoryshortname'] = $this->config->get('categoryshortname');
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }


        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title1'),
            'href' => $this->url->link('extension/module/categoryshortname', 'user_token=' . $this->session->data['user_token'], 'SSL')
        );

        $data['action'] = $this->url->link('extension/module/categoryshortname', 'user_token=' . $this->session->data['user_token'], 'SSL');

        $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', 'SSL');

        $data['user_token'] = $this->session->data['user_token'];



        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/categoryshortname', $data));
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/categoryshortname')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function uninstall() {
       
            $this->load->model('extension/module/categoryshortname');
            $this->model_extension_module_categoryshortname->uninstall();
            $this->load->model('setting/setting');
            $this->model_setting_setting->deleteSetting('categoryshortname');


    }

    public function install() {
 
            $this->load->model('extension/module/categoryshortname');
            $this->model_extension_module_categoryshortname->install();

            // initial variable
            $initial = array();
            $initial['categoryshortname'] = array(
                'status' => 0,
            );

        $this->load->model('setting/setting');

        $this->model_setting_setting->editSetting('categoryshortname', $initial);
        
    }
    

}

?>