<?php
/**
* Joomla! 1.5 component JHShop
*
* @version $Id: config.php 2010-03-08 02:50:09 svn $
* @author JHShop
* @package Joomla
* @subpackage JHShop
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see license.txt
*
* JHShop - eCommerce Solution for Joomla
*/
class ControllerPaymentWebPay extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('payment/webpay');

		//$this->document->title = $this->language->get('heading_title');
        $this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
        	
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('webpay', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');


		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');

		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		
		$this->data['entry_merchant'] = $this->language->get('entry_merchant');
		$this->data['entry_security'] = $this->language->get('entry_security');
		$this->data['entry_callback'] = $this->language->get('entry_callback');

		$this->data['entry_order_status'] = $this->language->get('entry_order_status');		
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/webpay', 'token=' . $this->session->data['token'], 'SSL'),      		
      		'separator' => ' :: '
   		);
				
		$this->data['action'] = $this->url->link('payment/webpay', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        		
		$this->data['callback'] = HTTP_CATALOG . 'index.php?route=payment/webpay/callback';

        
		if (isset($this->request->post['webpay_order_status_id'])) {
			$this->data['webpay_order_status_id'] = $this->request->post['webpay_order_status_id'];
		} else {
			$this->data['webpay_order_status_id'] = $this->config->get('webpay_order_status_id'); 
		} 
		
		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['webpay_status'])) {
			$this->data['webpay_status'] = $this->request->post['webpay_status'];
		} else {
			$this->data['webpay_status'] = $this->config->get('webpay_status');
		}
		
		if (isset($this->request->post['webpay_sort_order'])) {
			$this->data['webpay_sort_order'] = $this->request->post['webpay_sort_order'];
		} else {
			$this->data['webpay_sort_order'] = $this->config->get('webpay_sort_order');
		}
		
		$this->template = 'payment/webpay.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		//$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
        $this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/webpay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>
