<?php 
class ControllerVideoGalleryVideo extends Controller {  
	public function index() {
		$this->language->load('videoGallery/video');
		
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),			
			'separator' => FALSE
		);
		
		if(isset($this->request->get['album_id'])){
			
			$this->load->model('catalog/videoGallery');
			
			$this->data['text_sort'] = $this->language->get('text_sort');		
				        
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else { 
				$page = 1;
			}	
					
			if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
			} else {
				$sort = 'sort_order';
			}
		
			if (isset($this->request->get['order'])) {
				$order = $this->request->get['order'];
			} else {
				$order = 'ASC';
			}
				
			$url = '';
					
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	
		
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$results = $this->model_catalog_videoGallery->getVideosbyAlbumID($this->request->get['album_id'],$sort, $order, ($page - 1) * 12, 12);
			$video_total = $this->model_catalog_videoGallery->getTotalVideo($this->request->get['album_id']);
			$this->model_catalog_videoGallery->updateViewed($this->request->get['album_id']);
			
			if($results){
				
				$album_info = $this->model_catalog_videoGallery->getAlbum($this->request->get['album_id']);
				
				$this->data['heading_title'] = $this->language->get('text_album') . ' : ' . $album_info['name'];
				
				$this->data['breadcrumbs'][] = array(
					'text'      => $this->language->get('text_videoGallery'),
					'href'      => $this->url->link('videoGallery/album'),			
					'separator' => $this->language->get('text_separator')
				);

				$this->data['breadcrumbs'][] = array(
					'text'      => $this->language->get('text_album') . ' : ' .  $album_info['name'],
					'href'      => $this->url->link('videoGallery/video&album_id='.$this->request->get['album_id']),			
					'separator' => $this->language->get('text_separator')
				);
						
				$this->data['videos'] = array();
				
				$this->load->model('tool/image');
			
		        foreach ($results as $result) {
					if ($result['image']) {
						$image = $result['image'];
					} else {
						$image = 'no_image.jpg';
					}	
					
					$this->data['videos'][] = array(
		            	'name'         => $result['name'],
						'description'  => $result['description'],
						'code'         => $result['code'],
						'source'       => $result['source'],
						'thumb'        => $result['image'],
					    'popup'        => $this->model_tool_image->resize($image, $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
						'date_added'   => explode(" ",$result['date_added']),
		          	);
		        }
	
		        $url = '';
				
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}			
				
				$this->data['sorts'] = array();
						
				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_default'),
					'value' => 'sort_order-ASC',
					'href'  => $this->url->link('videoGallery/video&album_id='. $this->request->get['album_id'] .'&sort=sort_order&order=ASC')
				);
						
				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_name_asc'),
					'value' => 'name-ASC',
					'href'  => $this->url->link('videoGallery/video&album_id='. $this->request->get['album_id'] .'&sort=name&order=ASC')
				);
		 
				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_name_desc'),
					'value' => 'name-DESC',
					'href'  => $this->url->link('videoGallery/video&album_id='. $this->request->get['album_id'] .'&sort=name&order=DESC')
				);
		
				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_date_added_asc'),
					'value' => 'date_added-ASC',
					'href'  => $this->url->link('videoGallery/video&album_id='. $this->request->get['album_id'] .'&sort=date_added&order=ASC')
				); 
		
				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_date_added_desc'),
					'value' => 'date_added-DESC',
					'href'  => $this->url->link('videoGallery/video&album_id='. $this->request->get['album_id'] .'&sort=date_added&order=DESC')
				); 
												
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
				$pagination->limit = 12;
				$pagination->text = $this->language->get('text_pagination');
				$pagination->url = $this->url->link('videoGallery/video&album_id='. $this->request->get['album_id'] . $url . '&page={page}');
					
				$this->data['pagination'] = $pagination->render();
					
				$this->data['sort'] = $sort;
				$this->data['order'] = $order;
				
				$this->document->setTitle('Album : '.$album_info['name']);
	   			
	   			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/videoGallery/video.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/videoGallery/video.tpl';
				} else {
					$this->template = 'default/template/videoGallery/video.tpl';
				}	
							
				$this->children = array(
				'common/column_right',
				'common/column_left',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
				);
					
				$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
				
			} else {
				
				$this->document->setTitle($this->language->get('text_empty'));

	      		$this->data['heading_title'] = $this->language->get('text_empty');
	
	      		$this->data['text_error'] = $this->language->get('text_empty');
	
	      		$this->data['button_continue'] = $this->language->get('button_continue');
	
	      		$this->data['continue'] = HTTP_SERVER . 'index.php?route=videoGallery/album';
				
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
				} else {
					$this->template = 'default/template/error/not_found.tpl';
				}	
				
				$this->children = array(
					'common/column_right',
					'common/column_left',
					'common/content_top',
					'common/content_bottom',
					'common/footer',
					'common/header'
				);
			
				$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
				
			}
			
		} else {
			
			$this->document->setTitle($this->language->get('text_error'));

      		$this->data['heading_title'] = $this->language->get('text_error');

      		$this->data['text_error'] = $this->language->get('text_error');

      		$this->data['button_continue'] = $this->language->get('button_continue');

      		$this->data['continue'] = HTTP_SERVER . 'index.php?route=videoGallery/album';
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
			} else {
				$this->template = 'default/template/error/not_found.tpl';
			}	
			
			$this->children = array(
				'common/column_right',
				'common/column_left',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);
		
			$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
		}					
    	
	}  	
}
?>
