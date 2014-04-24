<?php 
class ControllerVideoGalleryAlbum extends Controller {
	private $error = array();
	
	public function index() {
		$this->language->load('videoGallery/album');
		
		$this->document->setTitle($this->language->get('heading_title'));
		 
		$this->data['text_sort'] = $this->language->get('text_sort');
		
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),			
			'separator' => FALSE
		);
		
		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('videoGallery/album'),			
			'separator' => $this->language->get('text_separator')
		);
		
		$this->load->model('catalog/videoGallery'); 
		$this->load->model('tool/image');
		
		
			
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
			
			$this->data['albums'] = array();
        		
			$results = $this->model_catalog_videoGallery->getAlbums($sort, $order, ($page - 1) * 8, 8);
			$album_total = $this->model_catalog_videoGallery->getTotalAlbum();
		
			$this->data['heading_title'] = $this->language->get('heading_title');
			
	        foreach ($results as $result) {
				if ($result['image']) {
					$image = $result['image'];
				} else {
					$image = 'no_image.jpg';
				}	
				
				$this->data['albums'][] = array(
	            	'name'    => $result['name'],
					'thumb'   => $this->model_tool_image->resize($image, 144, 108),
				    'date_added' => explode(" ",$result['date_added']),
	          		'href'    	 => $this->url->link('videoGallery/video', 'album_id=' . $result['album_id']),
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
				'href'    	 => $this->url->link('videoGallery/album&sort=sort_order&order=ASC'),
			);
					
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'name-ASC',
				'href'  => $this->url->link('videoGallery/album&sort=name&order=ASC'),
			);
	 
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'name-DESC',
				'href'  => $this->url->link('videoGallery/album&sort=name&order=DESC')
			);
	
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_date_added_asc'),
				'value' => 'date_added-ASC',
				'href'  => $this->url->link('videoGallery/album&sort=date_added&order=ASC')
			); 
	
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_date_added_desc'),
				'value' => 'date_added-DESC',
				'href'  => $this->url->link('videoGallery/album&sort=date_added&order=DESC')
			); 
					
			if ($this->config->get('config_review')) {
				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_viewed_desc'),
					'value' => 'viewed-DESC',
					'href'  => $this->url->link('videoGallery/album&sort=viewed&order=DESC')
				); 
						
				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_viewed_asc'),
					'value' => 'viewed-ASC',
					'href'  => $this->url->link('videoGallery/albumsort=viewed&order=ASC')
				);
			}
					
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	
	
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
				
			$pagination = new Pagination();
			$pagination->total = $album_total;
			$pagination->page = $page;
			$pagination->limit = 8;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('videoGallery/album' . $url . '&page={page}');
				
			$this->data['pagination'] = $pagination->render();
				
			$this->data['sort'] = $sort;
			$this->data['order'] = $order;
		
		
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/videoGallery/album.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/videoGallery/album.tpl';
			} else {
				$this->template = 'default/template/videoGallery/album.tpl';
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
?>
