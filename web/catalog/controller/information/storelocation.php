<?php
class ControllerInformationStorelocation extends Controller {
	public function index() {
		$this->load->language('information/storelocation');
		$this->load->model('storelocation/storelocation');

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'href'      => $this->url->link('common/home'),
			'text'      => $this->language->get('text_home'),
			'separator' => FALSE
		);

		$this->data['breadcrumbs'][] = array(
			'href'      => $this->url->link('information/storelocation'),
			'text'      => $this->language->get('heading_title'),
			'separator' => $this->language->get('text_separator')
		);

		if (isset($this->request->get['storelocation_id'])) {
			$storelocation_id = $this->request->get['storelocation_id'];
		} else {
			$storelocation_id = 0;
		}

		$storelocation_info = $this->model_storelocation_storelocation->getStorelocationStory($storelocation_id);
		$this->data['storelocation_search_show'] =  $this->config->get('storelocation_search_show');
		
		//$this->document->addScript('catalog/view/javascript/jquery/ul/jquery-ui-1.8.16.custom.min.js');
		$this->document->addScript('https://maps.google.com/maps/api/js?sensor=false');
		$this->document->addScript('catalog/view/javascript/gmaps.js');
		$this->document->addScript('catalog/view/javascript/gmarker.js');
		//$this->document->addStyle('catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css');

		if ($storelocation_info) {
			$this->document->setTitle($storelocation_info['title']);

			$this->data['breadcrumbs'][] = array(
					'href'      => $this->url->link('information/storelocation', 'storelocation_id=' . $this->request->get['storelocation_id']),
					'text'      => $storelocation_info['title'],
					'separator' => $this->language->get('text_separator')
			);

			$this->data['storelocation_info'] = $storelocation_info;

			$this->document->setDescription($storelocation_info['address']);

			$this->data['heading_title'] = $storelocation_info['title'];
			$this->data['address'] = html_entity_decode($storelocation_info['address']);
			$this->data['content'] = html_entity_decode($storelocation_info['description']);
			$this->data['timing'] = html_entity_decode($storelocation_info['timing']);
			$this->data['email'] = html_entity_decode($storelocation_info['email']);
			$this->data['phone'] = html_entity_decode($storelocation_info['phone']);
			$this->data['latitude'] = html_entity_decode($storelocation_info['latitude']);
			$this->data['longitude'] = html_entity_decode($storelocation_info['longitude']);
			
			$this->load->model('tool/image');

			if ($storelocation_info['image']) {
				$this->data['image'] = TRUE;
			} else {
				$this->data['image'] = FALSE;
			}

			$this->data['min_height'] = $this->config->get('storelocation_thumb_height');

			$this->data['thumb'] = $this->model_tool_image->resize($storelocation_info['image'], $this->config->get('storelocation_thumb_width'), $this->config->get('storelocation_thumb_height'));

			$this->data['button_storelocation'] = $this->language->get('button_storelocation');
			
			$this->data['entry_email'] = $this->language->get('entry_email');
			$this->data['entry_phone'] = $this->language->get('entry_phone');
			$this->data['entry_address'] = $this->language->get('entry_address');
			$this->data['entry_timing'] = $this->language->get('entry_timing');
			$this->data['entry_your_location'] = $this->language->get('entry_your_location');
			$this->data['button_direction'] = $this->language->get('button_direction');

			$this->data['storelocation'] = $this->url->link('information/storelocation');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/storelocation.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/information/storelocation.tpl';
			} else {
				$this->template = 'default/template/information/storelocation.tpl';
			}

			$this->children = array(
					'common/column_left',
					'common/column_right',
					'common/content_top',
					'common/content_bottom',
					'common/footer',
					'common/header'
					);

					$this->response->setOutput($this->render());
		} else {
			$this->data['button_search'] = $this->language->get('button_search');
			$this->data['form_search'] = $this->url->link('information/storelocation');
			$this->data['text_key'] = $this->language->get('text_key');
			$this->data['text_distance'] = $this->language->get('text_distance');
			$this->data['text_meter'] = $this->language->get('text_meter');
				
			if (isset($this->request->post['key'])) {
				$key = $this->request->post['key'];
			} else {
				if (isset($this->request->get['key'])) {
					$key = $this->request->get['key'];
				} else {
					$key = '';
				}
			}
			
			if (isset($this->request->post['latitude'])) {
				$latitude = $this->request->post['latitude'];
			} else {
				if (isset($this->request->get['latitude'])) {
					$latitude = $this->request->get['latitude'];
				} else {
					$latitude = '33.51737258784171';
				}
			}
			
			if (isset($this->request->post['longitude'])) {
				$longitude = $this->request->post['longitude'];
			} else {
				if (isset($this->request->get['longitude'])) {
					$longitude = $this->request->get['longitude'];
				} else {
					$longitude = '-86.78323101043702';
				}
			}
			
			if (isset($this->request->post['radius'])) {
				$radius = $this->request->post['radius'];
			} else {
				if (isset($this->request->get['radius'])) {
					$radius = $this->request->get['radius'];
				} else {
					$radius = 0;
				}
			}
			
			$this->data['key_search'] = $key;
			$this->data['radius'] = $radius;

			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}
				
			$limit = $this->config->get('storelocation_per_page');

			$data = array(
					'key' => $key,
					'latitude' => $latitude,
					'longitude' => $longitude,
					'radius' => $radius,
					'start'              => ($page - 1) * $limit,
					'limit'              => $limit
			);
				
			$storelocation_total = $this->model_storelocation_storelocation->getTotalStorelocation($data);
			$storelocation_data = $this->model_storelocation_storelocation->getStorelocation($data);
			 
			$this->load->model('tool/image');
			if ($storelocation_data) {
				foreach ($storelocation_data as $result) {
					$this->data['storelocation_data'][] = array(
						'title'        => $result['title'],
						'address'  	   => html_entity_decode($result['address']),
						'latitude'     => $result['latitude'],
						'longitude'    => $result['longitude'],
						'href'         => $this->url->link('information/storelocation', 'storelocation_id=' . $result['storelocation_id']),
						'date_added'   => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
						'image'        => $this->model_tool_image->resize($result['image']?$result['image']:'no_image.jpg', $this->config->get('storelocation_thumb_width'), $this->config->get('storelocation_thumb_height'))
					);
				}

				$this->document->setTitle($this->language->get('heading_title'));

				$this->data['heading_title'] = $this->language->get('heading_title');

				$this->data['text_read_more'] = $this->language->get('text_read_more');
				$this->data['text_date_added'] = $this->language->get('text_date_added');

				$this->data['button_continue'] = $this->language->get('button_continue');

				$this->data['continue'] = $this->url->link('common/home');

				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/storelocation.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/information/storelocation.tpl';
				} else {
					$this->template = 'default/template/information/storelocation.tpl';
				}

				$pagination = new Pagination();
				$pagination->total = $storelocation_total;
				$pagination->page = $page;
				$pagination->limit = $limit;
				$pagination->text = $this->language->get('text_pagination');
				$pagination->url = $this->url->link('information/storelocation', (isset($key)?('key=' . $key . '&radius=' . $radius . '&page={page}'):'page={page}'));
					
				$this->data['pagination'] = $pagination->render();

				$this->children = array(
					'common/column_left',
					'common/column_right',
					'common/content_top',
					'common/content_bottom',
					'common/footer',
					'common/header'
				);
				$this->response->setOutput($this->render());
			} else {
				$this->document->setTitle($this->language->get('text_error'));

				$this->data['heading_title'] = $this->language->get('text_error');

				$this->data['text_error'] = $this->language->get('text_error');

				$this->data['button_continue'] = $this->language->get('button_continue');

				$this->data['continue'] = $this->url->link('information/storelocation');

				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/storelocation.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/information/storelocation.tpl';
				} else {
					$this->template = 'default/template/information/storelocation.tpl';
				}

				$this->children = array(
					'common/column_left',
					'common/column_right',
					'common/content_top',
					'common/content_bottom',
					'common/footer',
					'common/header'
				);
				$this->response->setOutput($this->render());
			}
		}
	}
}
?>
