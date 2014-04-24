<?php    
class ControllerCatalogVideoGalleryvideo extends Controller { 
	private $error = array();
  
  	public function index() {
		$this->load->language('catalog/videoGallery_video');
		
		$this->document->setTitle($this->language->get('heading_title'));
		 
		$this->load->model('catalog/videoGallery_video');
		
    	$this->getList();
  	}
  
  	public function insert() {
		$this->load->language('catalog/videoGallery_video');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/videoGallery_video');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_videoGallery_video->addVideo($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->redirect(HTTPS_SERVER . 'index.php?route=catalog/videoGallery_video&token=' . $this->session->data['token'] . $url);
		}
    
    	$this->getForm();
  	} 
   
  	public function update() {
		$this->load->language('catalog/videoGallery_video');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/videoGallery_video');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_videoGallery_video->editVideo($this->request->get['video_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->redirect(HTTPS_SERVER . 'index.php?route=catalog/videoGallery_video&token=' . $this->session->data['token'] . $url);
		}
    
    	$this->getForm();
  	}   

  	public function delete() {
		$this->load->language('catalog/videoGallery_video');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/videoGallery_video');
			
    	if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $video_id) {
				$this->model_catalog_videoGallery_video->deleteVideo($video_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->redirect(HTTPS_SERVER . 'index.php?route=catalog/videoGallery_video&token=' . $this->session->data['token'] . $url);
    	}
	
    	$this->getList();
  	}  
    
  	private function getList() {
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		$url = '';
			
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/videoGallery_album', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' <i class="fa fa-angle-right"></i> '
   		);
							
		$this->data['insert'] = HTTPS_SERVER . 'index.php?route=catalog/videoGallery_video/insert&token=' . $this->session->data['token'] . $url;
		$this->data['delete'] = HTTPS_SERVER . 'index.php?route=catalog/videoGallery_video/delete&token=' . $this->session->data['token'] . $url;	

		$this->data['videos'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$video_total = $this->model_catalog_videoGallery_video->getTotalVideos();
	
		$results = $this->model_catalog_videoGallery_video->getVideos($data);
 
		$this->load->model('tool/image');
		
    	foreach ($results as $result) {
    		if ($result['image']) {
				$image = $result['image'];
			} else {
				$image = 'no_image.jpg';
			}
    		
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => HTTPS_SERVER . 'index.php?route=catalog/videoGallery_video/update&token=' . $this->session->data['token'] . '&video_id=' . $result['video_id'] . $url
			);
						
			$this->data['videos'][] = array(
				'video_id' => $result['video_id'],
				'name'            => $result['name'],
				'description'     => $result['description'],
				'code'            => $result['code'],
				'source'          => $result['source'],
				'date_added'      => $result['date_added'],
			    'thumb'           => $result['image'],
				'sort_order'      => $result['sort_order'],
				'selected'        => isset($this->request->post['selected']) && in_array($result['video_id'], $this->request->post['selected']),
				'action'          => $action
			);
		}	
	
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_image'] = $this->language->get('column_image');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');		
		
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

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$this->data['sort_name'] = HTTPS_SERVER . 'index.php?route=catalog/videoGallery_video&token=' . $this->session->data['token'] . '&sort=name' . $url;
		$this->data['sort_sort_order'] = HTTPS_SERVER . 'index.php?route=catalog/videoGallery_video&token=' . $this->session->data['token'] . '&sort=sort_order' . $url;
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $video_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = HTTPS_SERVER . 'index.php?route=catalog/videoGallery_video&token=' . $this->session->data['token'] . $url . '&page={page}';
			
		$this->data['pagination'] = $pagination->render();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		
		$this->template = 'catalog/videoGallery_video_list.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}
  
  	private function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');

    	$this->data['text_enabled'] = $this->language->get('text_enabled');
    	$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_default'] = $this->language->get('text_default');
    	$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_source'] = $this->language->get('entry_source');
		$this->data['entry_album'] = $this->language->get('entry_album');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
    	$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
  
    	$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');
	  
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}
		    
		$url = '';
			
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/videoGallery_album', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' <i class="fa fa-angle-right"></i> '
   		);
							
		if (!isset($this->request->get['video_id'])) {
			$this->data['action'] = HTTPS_SERVER . 'index.php?route=catalog/videoGallery_video/insert&token=' . $this->session->data['token'] . $url;
		} else {
			$this->data['action'] = HTTPS_SERVER . 'index.php?route=catalog/videoGallery_video/update&token=' . $this->session->data['token'] . '&video_id=' . $this->request->get['video_id'] . $url;
		}
		
		$this->data['cancel'] = HTTPS_SERVER . 'index.php?route=catalog/videoGallery_video&token=' . $this->session->data['token'] . $url;

		$this->data['token'] = $this->session->data['token'];
		
    	if (isset($this->request->get['video_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$video_info = $this->model_catalog_videoGallery_video->getVideo($this->request->get['video_id']);
    	}

    	if (isset($this->request->post['name'])) {
      		$this->data['name'] = $this->request->post['name'];
    	} elseif (isset($video_info)) {
			$this->data['name'] = $video_info['name'];
		} else {	
      		$this->data['name'] = '';
    	}
		
		if (isset($this->request->post['source'])) {
      		$this->data['source'] = $this->request->post['source'];
    	} elseif (isset($video_info)) {
			$this->data['source'] = $video_info['source'];
		} else {	
      		$this->data['source'] = '';
    	}
		
		
    	if (isset($this->request->post['code'])) {
      		$this->data['code'] = $this->request->post['code'];
    	} elseif (isset($video_info)) {
			$this->data['code'] = $video_info['code'];
		} else {	
      		$this->data['code'] = '';
    	}
		
		if (isset($this->request->post['description'])) {
      		$this->data['description'] = $this->request->post['description'];
    	} elseif (isset($video_info)) {
			$this->data['description'] = $video_info['description'];
		} else {	
      		$this->data['description'] = '';
    	}
    			
		$this->data['albums'] = $this->model_catalog_videoGallery_video->getAlbums();
		
		if (isset($this->request->post['video_album'])) {
			$this->data['video_album'] = $this->request->post['video_album'];
		} elseif (isset($video_info)) {
			$this->data['video_album'] = $this->model_catalog_videoGallery_video->getVideoAlbums($this->request->get['video_id']);
		} else {
			$this->data['video_album'] = array(0);
		}	

		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (isset($video_info)) {
			$this->data['image'] = $video_info['image'];
		} else {
			$this->data['image'] = '';
		}
		
		$this->load->model('tool/image');

		if (isset($video_info) && $video_info['image'] && file_exists(DIR_IMAGE . $video_info['image'])) {
			$this->data['preview'] = $video_info['image'];
		} else {
			$this->data['preview'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
		
		if (isset($this->request->post['sort_order'])) {
      		$this->data['sort_order'] = $this->request->post['sort_order'];
    	} elseif (isset($video_info)) {
			$this->data['sort_order'] = $video_info['sort_order'];
		} else {
      		$this->data['sort_order'] = '';
    	}
		
		$this->template = 'catalog/videoGallery_video_form.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}  
	 
  	private function validateForm() {
    	if (!$this->user->hasPermission('modify', 'catalog/videoGallery_video')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	if ((strlen(utf8_decode($this->request->post['name'])) < 3) || (strlen(utf8_decode($this->request->post['name'])) > 300)) {
      		$this->error['name'] = $this->language->get('error_name');
    	}
		
		if (!$this->error) {
	  		return TRUE;
		} else {
	  		return FALSE;
		}
  	}    

  	private function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'catalog/videoGallery_video')) {
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