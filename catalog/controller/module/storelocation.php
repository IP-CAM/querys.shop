<?php
class ControllerModuleStorelocation extends Controller {
	protected function index($setting) {
		$this->load->language('module/storelocation');
		$this->load->model('storelocation/storelocation');
		$this->load->model('tool/image');

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_read_more'] = $this->language->get('text_read_more');
		$this->data['text_date_added'] = $this->language->get('text_date_added');

		$this->data['show_headline'] = $setting['headline'];
		$this->data['show_image'] = $setting['image'];
		$this->data['show_description'] = $setting['description'];

		$data = array(
			'key' => '',
			'category_id' => 0, 
		);

		$this->data['storelocation'] = array();

		$results = $this->model_storelocation_storelocation->getStorelocationShorts($setting['limit']);

		foreach ($results as $result) {
			$this->data['storelocation'][] = array(
				'title'        => $result['title'],
				'address'  => html_entity_decode($result['address']),
				'href'         => $this->url->link('information/storelocation', 'storelocation_id=' . $result['storelocation_id']),
				'date_added'   => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
			  'image'        => $this->model_tool_image->resize($result['image']?$result['image']:'no_image.jpg', $this->config->get('storelocation_feature_thumb_width'), $this->config->get('storelocation_feature_thumb_height')),
			);
		}

		$this->id = 'storelocation';

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/storelocation.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/storelocation.tpl';
		} else {
			$this->template = 'default/template/module/storelocation.tpl';
		}

		$this->render();
	}
}
?>
