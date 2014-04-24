<?php
class ControllerModuleStorelocation extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/storelocation');
		$this->load->model('storelocation/storelocation');

		$this->model_storelocation_storelocation->checkStoreLocation();

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('storelocation', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getModule();
	}

	public function insert() {
		$this->load->language('module/storelocation');
		$this->load->model('storelocation/storelocation');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateForm())) {
			$this->model_storelocation_storelocation->addStoreLocation($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('module/storelocation/listing', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$this->getForm();
	}

	public function update() {
		$this->load->language('module/storelocation');
		$this->load->model('storelocation/storelocation');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validateForm())) {
			$this->model_storelocation_storelocation->editStoreLocation($this->request->get['storelocation_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('module/storelocation/listing', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('module/storelocation');
		$this->load->model('storelocation/storelocation');

		$this->document->setTitle($this->language->get('heading_title'));

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $storelocation_id) {
				$this->model_storelocation_storelocation->deleteStorelocation($storelocation_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('module/storelocation/listing', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getList();
	}

	public function listing() {
		$this->load->language('module/storelocation');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->getList();
	}

	private function getModule() {
		$this->load->language('module/storelocation');
		$this->load->model('storelocation/storelocation');

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');

		$this->data['entry_limit'] = $this->language->get('entry_limit');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_headline'] = $this->language->get('entry_headline');
		$this->data['entry_image'] = $this->language->get('entry_setting_image');
		$this->data['entry_description'] = $this->language->get('entry_setting_description');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_search_show'] = $this->language->get('entry_search_show');
		$this->data['entry_per_page'] = $this->language->get('entry_per_page');
		$this->data['entry_storelocationpage_thumb'] = $this->language->get('entry_storelocationpage_thumb');
		$this->data['entry_feature_storelocationpage_thumb'] = $this->language->get('entry_feature_storelocationpage_thumb');		

		$this->data['button_storelocation'] = $this->language->get('button_storelocation');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['storelocationpage_thumb'])) {
			$this->data['error_storelocationpage_thumb'] = $this->error['storelocationpage_thumb'];
		} else {
			$this->data['error_storelocationpage_thumb'] = '';
		}
		
		if (isset($this->error['storelocationpage_feature_thumb'])) {
			$this->data['error_feature_storelocationpage_thumb'] = $this->error['storelocationpage_feature_thumb'];
		} else {
			$this->data['error_feature_storelocationpage_thumb'] = '';
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'text'      => $this->language->get('text_home'),
			'separator' => FALSE
		);

		$this->data['breadcrumbs'][] = array(
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'text'      => $this->language->get('text_module'),
			'separator' => ' <i class="fa fa-angle-right"></i> '
		);

		$this->data['breadcrumbs'][] = array(
			'href'      => $this->url->link('module/storelocation', 'token=' . $this->session->data['token'], 'SSL'),
			'text'      => $this->language->get('heading_title'),
			'separator' => ' <i class="fa fa-angle-right"></i> '
		);

		$this->data['storelocation'] = $this->url->link('module/storelocation/listing', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['action'] = $this->url->link('module/storelocation', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['storelocation_search_show'])) {
			$this->data['storelocation_search_show'] = $this->request->post['storelocation_search_show'];
		} else {
			$this->data['storelocation_search_show'] = $this->config->get('storelocation_search_show');
		}
		
		if (isset($this->request->post['storelocation_per_page'])) {
			$this->data['storelocation_per_page'] = $this->request->post['storelocation_per_page'];
		} else {
			$this->data['storelocation_per_page'] = $this->config->get('storelocation_per_page');
		}
		
		if (isset($this->request->post['storelocation_thumb_width'])) {
			$this->data['storelocation_thumb_width'] = $this->request->post['storelocation_thumb_width'];
		} else {
			$this->data['storelocation_thumb_width'] = $this->config->get('storelocation_thumb_width');
		}

		if (isset($this->request->post['storelocation_thumb_height'])) {
			$this->data['storelocation_thumb_height'] = $this->request->post['storelocation_thumb_height'];
		} else {
			$this->data['storelocation_thumb_height'] = $this->config->get('storelocation_thumb_height');
		}

		if (isset($this->request->post['storelocation_feature_thumb_width'])) {
			$this->data['storelocation_feature_thumb_width'] = $this->request->post['storelocation_feature_thumb_width'];
		} else {
			$this->data['storelocation_feature_thumb_width'] = $this->config->get('storelocation_feature_thumb_width');
		}

		if (isset($this->request->post['storelocation_feature_thumb_height'])) {
			$this->data['storelocation_feature_thumb_height'] = $this->request->post['storelocation_feature_thumb_height'];
		} else {
			$this->data['storelocation_feature_thumb_height'] = $this->config->get('storelocation_feature_thumb_height');
		}
		
		$this->data['modules'] = array();
		
		if (isset($this->request->post['storelocation_module'])) {
			$this->data['modules'] = $this->request->post['storelocation_module'];
		} elseif ($this->config->get('storelocation_module')) { 
			$this->data['modules'] = $this->config->get('storelocation_module');
		}				
				
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/storelocation.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	private function getList() {
		$this->load->language('module/storelocation');
		$this->load->model('storelocation/storelocation');

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_title'] = $this->language->get('column_title');
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_feature'] = $this->language->get('column_feature');
		$this->data['column_action'] = $this->language->get('column_action');		

		$this->data['button_module'] = $this->language->get('button_module');
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'text'      => $this->language->get('text_home'),
			'separator' => FALSE
		);

		$this->data['breadcrumbs'][] = array(
			'href'      => $this->url->link('module/storelocation/listing', 'token=' . $this->session->data['token'], 'SSL'),
			'text'      => $this->language->get('heading_title'),
			'separator' => ' <i class="fa fa-angle-right"></i> '
		);

		$this->data['module'] = $this->url->link('module/storelocation', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['insert'] = $this->url->link('module/storelocation/insert', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['delete'] = $this->url->link('module/storelocation/delete', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['storelocation'] = array();

		$storelocation_total = $this->model_storelocation_storelocation->getTotalStorelocation();

		$results = $this->model_storelocation_storelocation->getStorelocation();

    	foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('module/storelocation/update', 'token=' . $this->session->data['token'] . '&storelocation_id=' . $result['storelocation_id'], 'SSL')
			);

			$this->data['storelocation'][] = array(
				'storelocation_id'     => $result['storelocation_id'],
				'title'       => $result['title'],
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'status'      => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'feature_flag'      => ($result['feature_flag'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'    => isset($this->request->post['selected']) && in_array($result['storelocation_id'], $this->request->post['selected']),
				'action'      => $action
			);
		}

		$this->template = 'module/storelocation/list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	private function getForm() {
		$this->load->language('module/storelocation');
		$this->load->model('storelocation/storelocation');

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');

		$this->data['entry_title'] = $this->language->get('entry_title');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
		$this->data['entry_address'] = $this->language->get('entry_address');
		$this->data['entry_timing'] = $this->language->get('entry_timing');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_phone'] = $this->language->get('entry_phone');
		$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_map'] = $this->language->get('entry_map');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_feature'] = $this->language->get('entry_feature');
		$this->data['entry_image'] = $this->language->get('entry_image');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_data'] = $this->language->get('tab_data');
		
		$this->data['text_category'] = $this->language->get('text_category');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['title'])) {
			$this->data['error_title'] = $this->error['title'];
		} else {
			$this->data['error_title'] = '';
		}

		if (isset($this->error['description'])) {
			$this->data['error_description'] = $this->error['description'];
		} else {
			$this->data['error_description'] = '';
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'text'      => $this->language->get('text_home'),
			'separator' => FALSE
		);

		$this->data['breadcrumbs'][] = array(
			'href'      => $this->url->link('module/storelocation/listing', 'token=' . $this->session->data['token'], 'SSL'),
			'text'      => $this->language->get('heading_title'),
			'separator' => ' <i class="fa fa-angle-right"></i> '
		);

		if (!isset($this->request->get['storelocation_id'])) {
			$this->data['action'] = $this->url->link('module/storelocation/insert', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$this->data['action'] = $this->url->link('module/storelocation/update', 'token=' . $this->session->data['token'] . '&storelocation_id=' . $this->request->get['storelocation_id'], 'SSL');
		}

		$this->data['cancel'] = $this->url->link('module/storelocation/listing', 'token=' . $this->session->data['token'], 'SSL');

		if ((isset($this->request->get['storelocation_id'])) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$storelocation_info = $this->model_storelocation_storelocation->getStorelocationStory($this->request->get['storelocation_id']);
		}

		$this->load->model('localisation/language');

		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['storelocation_description'])) {
			$this->data['storelocation_description'] = $this->request->post['storelocation_description'];
		} elseif (isset($this->request->get['storelocation_id'])) {
			$this->data['storelocation_description'] = $this->model_storelocation_storelocation->getStorelocationDescriptions($this->request->get['storelocation_id']);
		} else {
			$this->data['storelocation_description'] = array();
		}

		$this->load->model('setting/store');

		$this->data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['storelocation_store'])) {
			$this->data['storelocation_store'] = $this->request->post['storelocation_store'];
		} elseif (isset($storelocation_info)) {
			$this->data['storelocation_store'] = $this->model_storelocation_storelocation->getStorelocationStores($this->request->get['storelocation_id']);
		} else {
			$this->data['storelocation_store'] = array(0);
		}			

		if (isset($this->request->post['keyword'])) {
			$this->data['keyword'] = $this->request->post['keyword'];
		} elseif (isset($storelocation_info)) {
			$this->data['keyword'] = $storelocation_info['keyword'];
		} else {
			$this->data['keyword'] = '';
		}

		if (isset($this->request->post['feature_flag'])) {
			$this->data['feature_flag'] = $this->request->post['feature_flag'];
		} elseif (isset($storelocation_info)) {
			$this->data['feature_flag'] = $storelocation_info['feature_flag'];
		} else {
			$this->data['feature_flag'] = '';
		}
		
		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (isset($storelocation_info)) {
			$this->data['status'] = $storelocation_info['status'];
		} else {
			$this->data['status'] = '';
		}
		
		if (isset($this->request->post['latitude'])) {
			$this->data['latitude'] = $this->request->post['latitude'];
		} elseif (isset($storelocation_info)) {
			$this->data['latitude'] = $storelocation_info['latitude'];
		} else {
			$this->data['latitude'] = '';
		}
		
		if (isset($this->request->post['longitude'])) {
			$this->data['longitude'] = $this->request->post['longitude'];
		} elseif (isset($storelocation_info)) {
			$this->data['longitude'] = $storelocation_info['longitude'];
		} else {
			$this->data['longitude'] = '';
		}
		
		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} elseif (isset($storelocation_info)) {
			$this->data['email'] = $storelocation_info['email'];
		} else {
			$this->data['email'] = '';
		}
		
		if (isset($this->request->post['phone'])) {
			$this->data['phone'] = $this->request->post['phone'];
		} elseif (isset($storelocation_info)) {
			$this->data['phone'] = $storelocation_info['phone'];
		} else {
			$this->data['phone'] = '';
		}

		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (isset($news_info)) {
			$this->data['image'] = $news_info['image'];
		} else {
			$this->data['image'] = '';
		}

		$this->load->model('tool/image');

		if (!empty($storelocation_info) && $storelocation_info['image'] && file_exists(DIR_IMAGE . $storelocation_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($storelocation_info['image'], 100, 100);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}

		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

		$this->template = 'module/storelocation/form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/storelocation')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['storelocation_thumb_width'] || !$this->request->post['storelocation_thumb_height']) {
			$this->error['storelocationpage_thumb'] = $this->language->get('error_storelocationpage_thumb');
		}
		
		if (!$this->request->post['storelocation_feature_thumb_width'] || !$this->request->post['storelocation_feature_thumb_height']) {
			$this->error['storelocationpage_feature_thumb'] = $this->language->get('error_feature_storelocationpage_thumb');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'module/storelocation')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['storelocation_description'] as $language_id => $value) {
			if ((strlen($value['title']) < 3) || (strlen($value['title']) > 1000)) {
				$this->error['title'][$language_id] = $this->language->get('error_title');
			}

			if (strlen($value['description']) < 3) {
				$this->error['description'][$language_id] = $this->language->get('error_description');
			}
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	private function validateDelete() {
		if (!$this->user->hasPermission('modify', 'module/storelocation')) {
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
