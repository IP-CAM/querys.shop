<?php 
class ControllerCommonHeader extends Controller {
	protected function index() {
		$this->data['title'] = $this->document->getTitle(); 

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$this->data['base'] = HTTPS_SERVER;
		} else {
			$this->data['base'] = HTTP_SERVER;
		}

		$this->data['description'] = $this->document->getDescription();
		$this->data['keywords'] = $this->document->getKeywords();
		$this->data['links'] = $this->document->getLinks();	
		$this->data['styles'] = $this->document->getStyles();
		$this->data['scripts'] = $this->document->getScripts();
		$this->data['lang'] = $this->language->get('code');
		$this->data['direction'] = $this->language->get('direction');

		$this->language->load('common/header');

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_affiliate'] = $this->language->get('text_affiliate');
		$this->data['text_attribute'] = $this->language->get('text_attribute');
		$this->data['text_attribute_group'] = $this->language->get('text_attribute_group');
		$this->data['text_backup'] = $this->language->get('text_backup');
		$this->data['text_banner'] = $this->language->get('text_banner');
		$this->data['text_catalog'] = $this->language->get('text_catalog');
		$this->data['text_category'] = $this->language->get('text_category');
		$this->data['text_confirm'] = $this->language->get('text_confirm');
		$this->data['text_country'] = $this->language->get('text_country');
		$this->data['text_coupon'] = $this->language->get('text_coupon');
		$this->data['text_currency'] = $this->language->get('text_currency');			
		$this->data['text_customer'] = $this->language->get('text_customer');
		$this->data['text_customer_group'] = $this->language->get('text_customer_group');
		$this->data['text_customer_field'] = $this->language->get('text_customer_field');
		$this->data['text_customer_ban_ip'] = $this->language->get('text_customer_ban_ip');
		$this->data['text_custom_field'] = $this->language->get('text_custom_field');
		$this->data['text_sale'] = $this->language->get('text_sale');
		$this->data['text_design'] = $this->language->get('text_design');
		$this->data['text_documentation'] = $this->language->get('text_documentation');
		$this->data['text_download'] = $this->language->get('text_download');
		$this->data['text_error_log'] = $this->language->get('text_error_log');
		$this->data['text_extension'] = $this->language->get('text_extension');
		$this->data['text_feed'] = $this->language->get('text_feed');
		$this->data['text_filter'] = $this->language->get('text_filter');
		$this->data['text_front'] = $this->language->get('text_front');
		$this->data['text_geo_zone'] = $this->language->get('text_geo_zone');
		$this->data['text_dashboard'] = $this->language->get('text_dashboard');
		$this->data['text_help'] = $this->language->get('text_help');
		$this->data['text_information'] = $this->language->get('text_information');
		$this->data['text_language'] = $this->language->get('text_language');
		$this->data['text_layout'] = $this->language->get('text_layout');
		$this->data['text_localisation'] = $this->language->get('text_localisation');
		$this->data['text_logout'] = $this->language->get('text_logout');
		$this->data['text_contact'] = $this->language->get('text_contact');
		$this->data['text_manager'] = $this->language->get('text_manager');
		$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$this->data['text_module'] = $this->language->get('text_module');
		$this->data['text_option'] = $this->language->get('text_option');
		$this->data['text_order'] = $this->language->get('text_order');
		$this->data['text_order_status'] = $this->language->get('text_order_status');
		$this->data['text_opencart'] = $this->language->get('text_opencart');
		$this->data['text_payment'] = $this->language->get('text_payment');
		$this->data['text_product'] = $this->language->get('text_product'); 
		$this->data['text_profile'] = $this->language->get('text_profile');
		$this->data['text_reports'] = $this->language->get('text_reports');
		$this->data['text_report_sale_order'] = $this->language->get('text_report_sale_order');
		$this->data['text_report_sale_tax'] = $this->language->get('text_report_sale_tax');
		$this->data['text_report_sale_shipping'] = $this->language->get('text_report_sale_shipping');
		$this->data['text_report_sale_return'] = $this->language->get('text_report_sale_return');
		$this->data['text_report_sale_coupon'] = $this->language->get('text_report_sale_coupon');
		$this->data['text_report_product_viewed'] = $this->language->get('text_report_product_viewed');
		$this->data['text_report_product_purchased'] = $this->language->get('text_report_product_purchased');
		$this->data['text_report_customer_online'] = $this->language->get('text_report_customer_online');
		$this->data['text_report_customer_order'] = $this->language->get('text_report_customer_order');
		$this->data['text_report_customer_reward'] = $this->language->get('text_report_customer_reward');
		$this->data['text_report_customer_credit'] = $this->language->get('text_report_customer_credit');
		$this->data['text_report_affiliate_commission'] = $this->language->get('text_report_affiliate_commission');
		$this->data['text_report_sale_return'] = $this->language->get('text_report_sale_return');
		$this->data['text_report_product_viewed'] = $this->language->get('text_report_product_viewed');
		$this->data['text_report_customer_order'] = $this->language->get('text_report_customer_order');
		$this->data['text_review'] = $this->language->get('text_review');
		$this->data['text_return'] = $this->language->get('text_return');
		$this->data['text_return_action'] = $this->language->get('text_return_action');
		$this->data['text_return_reason'] = $this->language->get('text_return_reason');
		$this->data['text_return_status'] = $this->language->get('text_return_status');
		$this->data['text_support'] = $this->language->get('text_support');
		$this->data['text_shipping'] = $this->language->get('text_shipping');
		$this->data['text_setting'] = $this->language->get('text_setting');
		$this->data['text_stock_status'] = $this->language->get('text_stock_status');
		$this->data['text_system'] = $this->language->get('text_system');
		$this->data['text_tax'] = $this->language->get('text_tax');
		$this->data['text_tax_class'] = $this->language->get('text_tax_class');
		$this->data['text_tax_rate'] = $this->language->get('text_tax_rate');
		$this->data['text_total'] = $this->language->get('text_total');
		$this->data['text_user'] = $this->language->get('text_user');
		$this->data['text_user_group'] = $this->language->get('text_user_group');
		$this->data['text_users'] = $this->language->get('text_users');
		$this->data['text_voucher'] = $this->language->get('text_voucher');
		$this->data['text_voucher_theme'] = $this->language->get('text_voucher_theme');
		$this->data['text_weight_class'] = $this->language->get('text_weight_class');
		$this->data['text_length_class'] = $this->language->get('text_length_class');
		$this->data['text_zone'] = $this->language->get('text_zone');
		$this->data['text_openbay_extension'] = $this->language->get('text_openbay_extension');
		$this->data['text_openbay_dashboard'] = $this->language->get('text_openbay_dashboard');
		$this->data['text_openbay_orders'] = $this->language->get('text_openbay_orders');
		$this->data['text_openbay_items'] = $this->language->get('text_openbay_items');
		$this->data['text_openbay_ebay'] = $this->language->get('text_openbay_ebay');
		$this->data['text_openbay_amazon'] = $this->language->get('text_openbay_amazon');
		$this->data['text_openbay_amazonus'] = $this->language->get('text_openbay_amazonus');
		$this->data['text_openbay_settings'] = $this->language->get('text_openbay_settings');
		$this->data['text_openbay_links'] = $this->language->get('text_openbay_links');
		$this->data['text_openbay_report_price'] = $this->language->get('text_openbay_report_price');
		$this->data['text_openbay_order_import'] = $this->language->get('text_openbay_order_import');

		$this->data['text_paypal_express'] = $this->language->get('text_paypal_manage');
		$this->data['text_paypal_express_search'] = $this->language->get('text_paypal_search');
		$this->data['text_recurring_profile'] = $this->language->get('text_recurring_profile');

		if (!$this->user->isLogged() || !isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
			$this->data['logged'] = '';

			$this->data['home'] = $this->url->link('common/login', '', 'SSL');
		} else {

			$navigation_menu_sidebar = new Template();
			$navigation_top_bar 	 = new Template();
			

			$navigation_top_bar->data['logged'] = sprintf($this->language->get('text_logged'), $this->user->getUserName());
			$navigation_menu_sidebar->data['pp_express_status'] = $this->config->get('pp_express_status');
		
			$this->load->model('catalog/option');
			$this->load->model('catalog/manufacturer');
			$this->load->model('catalog/category');
			$option_groups = $this->model_catalog_option->getOptions();
			$manufactures = $this->model_catalog_manufacturer->getManufacturers();

				// echo '<pre style="background-color: #FFFFCB; color: #135092; margin:0px">'; 
				// 	print_r($manufactures); 
				// echo '</pre>'; 
				// //die();
			$menu = array();
			$menu['common'] 			  									= $this->menu(array('common/home')		, 					'fa-home' 	 	 , 'Dashboard'		, 'common');
			$menu['catalog']		  										= $this->menu(array(), 										'fa-th-list' 	 , 'Catalogo'		, 'catalog');
			$menu['catalog']['lvl2']['category']							= $this->menu(array(), 										'fa-sitemap' 	 , 'Categorías' 	, 'catalog');
			$menu['catalog']['lvl2']['category']['lvl3']['list']			= $this->menu(array('catalog/category'), 					'fa-th-list' 	 , 'Listado' 		, 'catalog', array('num' => $this->model_catalog_category->getTotalCategories(), 'type' => 'info'));
			$menu['catalog']['lvl2']['category']['lvl3']['add']				= $this->menu(array('catalog/category/insert'), 			'fa-plus-square' , 'Nueva' 			, 'catalog');
			$menu['catalog']['lvl2']['category']['lvl3']['tecnologias']		= $this->menu(array('catalog/category'), 					'fa-plus-square' , 'Tecnologías'	, 'catalog');
			$menu['catalog']['lvl2']['product']								= $this->menu(array(), 										'fa-barcode' 	 , 'Productos' 		, 'catalog');
			$menu['catalog']['lvl2']['product']['lvl3']['list']				= $this->menu(array('catalog/product'), 					'fa-th-list'     , 'Listado' 		, 'catalog');
			$menu['catalog']['lvl2']['product']['lvl3']['insert']			= $this->menu(array('catalog/product/insert'), 				'fa-plus-square' , 'Nuevo' 			, 'catalog');
			$menu['catalog']['lvl2']['product']['lvl3']['product_related']	= $this->menu(array(), 										'fa-th-list'     , 'Promociones' 	, 'catalog');
			$menu['catalog']['lvl2']['product']['lvl3']['recomendaciones']	= $this->menu(array(), 										'fa-home' 		 , 'Recomendación'	, 'catalog');
			$menu['catalog']['lvl2']['product']['lvl3']['request']			= $this->menu(array(), 										'fa-home' 		 , 'Request'		, 'catalog');
			$menu['catalog']['lvl2']['product']['lvl3']['premios']			= $this->menu(array(), 										'fa-coffee' 	 , 'Premios'		, 'catalog');
			$menu['catalog']['lvl2']['manufacturer']						= $this->menu(array(), 										'fa-th-list' 	 , 'Marcas' 		, 'catalog');
			$menu['catalog']['lvl2']['manufacturer']['lvl3'][]				= $this->menu(array('catalog/manufacturer'), 				'fa-th-list' 	 , 'Listado' 		, 'catalog');
			$menu['catalog']['lvl2']['manufacturer']['lvl3'][]				= $this->menu(array('catalog/product/insert'), 				'fa-plus-square' , 'Nueva' 			, 'catalog');
			foreach ($manufactures as $key => $value) {
				$menu['catalog']['lvl2']['manufacturer']['lvl3'][$value['name']]	= $this->menu(array('catalog/manufacturer/update','manufacturer_id='.$value['manufacturer_id']),	'fa-edit' , $value['name']		, 'catalog');
			}
			$menu['catalog']['lvl2']['attribute']										= $this->menu(array(), 								'fa-list' 	, 'Atributos' 		, 'catalog');
			$menu['catalog']['lvl2']['attribute']['lvl3']['attribute']					= $this->menu(array(), 								'fa-home' 	, 'Atributos' 		, 'catalog');
			$menu['catalog']['lvl2']['attribute']['lvl3']['attribute']['lvl4']['list']	= $this->menu(array('catalog/attribute'), 			'fa-home' 	, 'List' 			, 'catalog');
			$menu['catalog']['lvl2']['attribute']['lvl3']['attribute']['lvl4']['add']	= $this->menu(array('catalog/attribute/insert'), 	'fa-home' 	, 'Add' 			, 'catalog');

			$menu['catalog']['lvl2']['attribute']['lvl3'][]					= $this->menu(array('catalog/attribute_group'), 			'fa-home' 		 , 'Atributos de Grupo'	, 'catalog');
			$menu['catalog']['lvl2']['download']							= $this->menu(array('catalog/download'), 					'fa-home' 		 , 'Descargas' 			, 'catalog');
			$menu['catalog']['lvl2']['filter']								= $this->menu(array(), 										'fa-home' 		 , 'Filtros' 			, 'catalog');
			$menu['catalog']['lvl2']['filter']['lvl3']['list']				= $this->menu(array('catalog/filter'), 						'fa-home' 		 , 'List' 				, 'catalog');
			$menu['catalog']['lvl2']['filter']['lvl3']['add']				= $this->menu(array('catalog/filter/insert'), 				'fa-home' 		 , 'Add' 				, 'catalog');
			$menu['catalog']['lvl2']['profiles']							= $this->menu(array('catalog/profile'), 					'fa-home' 		 , 'Perfiles' 			, 'catalog');
			$menu['catalog']['lvl2']['option']								= $this->menu(array(), 										'fa-home' 		 , 'Opciones' 			, 'catalog');
			$menu['catalog']['lvl2']['option']['lvl3']['list']				= $this->menu(array('catalog/option'),						'fa-th-list' 	 , 'Listado'			, 'catalog');
			$menu['catalog']['lvl2']['option']['lvl3']['add']				= $this->menu(array('catalog/option/insert'),				'fa-plus-square' , 'Nueva'				, 'catalog');
			$menu['catalog']['lvl2']['option']['lvl3']['separator']			= $this->menu(array(),										'fa-minus' , ''			, 'catalog');
			foreach ($option_groups as $key => $value) {
				$menu['catalog']['lvl2']['option']['lvl3'][$value['name']]	= $this->menu(array('catalog/option/update','option_id='.$value['option_id']),	'fa-edit' , $value['name']		, 'catalog');
			}
			$menu['catalog']['lvl2']['review']								= $this->menu(array(), 										'fa-comments'	 , 'Opiniones' 			, 'catalog');
			$menu['catalog']['lvl2']['review']['lvl3']['list']				= $this->menu(array('catalog/review'), 						'fa-th-list'  	 , 'Listado' 			, 'catalog');
			$menu['catalog']['lvl2']['review']['lvl3']['add']				= $this->menu(array('catalog/review/add'), 					'fa-plus-square' , 'Nueva' 				, 'catalog');
			$menu['catalog']['lvl2']['review']['lvl3']['settings']			= $this->menu(array('catalog/review'), 						'fa-cogs' 		 , 'Configuración' 		, 'catalog');
			$menu['catalog']['lvl2']['review']['lvl3']['conceptos']			= $this->menu(array('catalog/review'), 						'fa-cogs' 		 , 'Conceptos' 			, 'catalog');
			
			$menu['sale']																	= $this->menu(array(), 								'fa-shopping-cart'	, 'Ventas' 		, 'sale');
			$menu['sale']['lvl2']['orders']													= $this->menu(array(), 								'fa-sitemap' 	 	, 'Ordenes' 	, 'sale');
			$menu['sale']['lvl2']['orders']['lvl3']['list']									= $this->menu(array('sale/order'), 					'fa-th-list' 		, 'List' 		, 'sale');
			$menu['sale']['lvl2']['orders']['lvl3']['add']									= $this->menu(array('sale/order/insert'), 			'fa-plus-square' 	, 'Add' 		, 'sale');
			$menu['sale']['lvl2']['return']													= $this->menu(array(), 								'fa-sitemap' 	 	, 'Devoluciones', 'sale');
			$menu['sale']['lvl2']['return']['lvl3']['list']									= $this->menu(array('sale/return'), 				'fa-th-list' 		, 'List' 		, 'sale');
			$menu['sale']['lvl2']['return']['lvl3']['add']									= $this->menu(array('sale/return/insert'), 			'fa-plus-square' 	, 'Add' 		, 'sale');
		 	$menu['sale']['lvl2']['customer']												= $this->menu(array(), 								'fa-sitemap' 	 	, 'Clientes'	, 'sale');
			$menu['sale']['lvl2']['customer']['lvl3']['customer']							= $this->menu(array(),					 			'fa-home' 			, 'Clientes' 	, 'sale');
			$menu['sale']['lvl2']['customer']['lvl3']['customer']['lvl4']['list']			= $this->menu(array('sale/customer'), 				'fa-home' 			, 'List' 		, 'sale');
			$menu['sale']['lvl2']['customer']['lvl3']['customer']['lvl4']['add']			= $this->menu(array('sale/customer/insert'), 		'fa-home' 			, 'Add' 		, 'sale');
			$menu['sale']['lvl2']['customer']['lvl3']['customer_group']						= $this->menu(array(),					 			'fa-home' 			, 'Grupos'		, 'sale');
			$menu['sale']['lvl2']['customer']['lvl3']['customer_group']['lvl4']['list']		= $this->menu(array('sale/customer_group'), 		'fa-home' 			, 'List' 		, 'sale');
			$menu['sale']['lvl2']['customer']['lvl3']['customer_group']['lvl4']['add']		= $this->menu(array('sale/customer_group/insert'), 	'fa-home' 			, 'Add' 		, 'sale');
		 	$menu['sale']['lvl2']['customer']['lvl3']['customer_ban_ip']					= $this->menu(array(),					 			'fa-home' 			, 'IP Bloqueada', 'sale');
			$menu['sale']['lvl2']['customer']['lvl3']['customer_ban_ip']['lvl4']['list']	= $this->menu(array('sale/customer_ban_ip'), 		'fa-home' 			, 'List' 		, 'sale');
			$menu['sale']['lvl2']['customer']['lvl3']['customer_ban_ip']['lvl4']['add']		= $this->menu(array('sale/customer_ban_ip/insert'), 'fa-home' 			, 'Add' 		, 'sale');
			$menu['sale']['lvl2']['customer']['lvl3']['gift']								= $this->menu(array(),					 			'fa-home' 			, 'Regalos'		, 'sale');
			$menu['sale']['lvl2']['customer']['lvl3']['gift']['lvl4']['list']				= $this->menu(array('sale/customer_ban_ip'), 		'fa-home' 			, 'List' 		, 'sale');
			$menu['sale']['lvl2']['customer']['lvl3']['gift']['lvl4']['add']				= $this->menu(array('sale/customer_ban_ip/insert'),	'fa-home' 			, 'Add' 		, 'sale');
			
		 	$menu['sale']['lvl2']['affiliate']												= $this->menu(array(), 								'fa-sitemap' 	 	, 'Afiliados'	, 'sale');
			$menu['sale']['lvl2']['affiliate']['lvl3']['list']								= $this->menu(array('sale/affiliate'), 				'fa-th-list' 		, 'List' 		, 'sale');
			$menu['sale']['lvl2']['affiliate']['lvl3']['add']								= $this->menu(array('sale/affiliate/insert'), 		'fa-plus-square' 	, 'Add' 		, 'sale');
		 	$menu['sale']['lvl2']['recurring']												= $this->menu(array('sale/recurring'), 				'fa-sitemap' 	 	, 'Perfiles Periódicos'		, 'sale');
		
			$menu['sale']['lvl2']['profile']												= $this->menu(array(), 								'fa-sitemap' 	 	, 'Profiles'		, 'sale');
			$menu['sale']['lvl2']['profile']['lvl3']['list']								= $this->menu(array('sale/customer_ban_ip'), 		'fa-th-list' 		, 'List' 		, 'sale');
			$menu['sale']['lvl2']['profile']['lvl3']['add']									= $this->menu(array('sale/customer_ban_ip/insert'), 'fa-plus-square' 	, 'Add' 		, 'sale');
			$menu['sale']['lvl2']['coupon']													= $this->menu(array(), 								'fa-sitemap' 	 	, 'Cupones'		, 'sale');
			$menu['sale']['lvl2']['coupon']['lvl3']['list']									= $this->menu(array('sale/coupon'), 				'fa-th-list' 		, 'List' 		, 'sale');
			$menu['sale']['lvl2']['coupon']['lvl3']['add']									= $this->menu(array('sale/coupon/insert'), 			'fa-plus-square' 	, 'Add' 		, 'sale');
			
			$menu['sale']['lvl2']['voucher']												= $this->menu(array(), 								'fa-sitemap' 	 	, 'Vales Regalo', 'sale');
			$menu['sale']['lvl2']['voucher']['lvl3']['voucher']								= $this->menu(array(),					 			'fa-home' 			, 'Vales' 		, 'sale');
			$menu['sale']['lvl2']['voucher']['lvl3']['voucher']['lvl4']['list']				= $this->menu(array('sale/voucher'), 				'fa-home' 			, 'List' 		, 'sale');
			$menu['sale']['lvl2']['voucher']['lvl3']['voucher']['lvl4']['add']				= $this->menu(array('sale/voucher/insert'), 		'fa-home' 			, 'Add' 		, 'sale');
			$menu['sale']['lvl2']['voucher']['lvl3']['voucher_theme']						= $this->menu(array(),					 			'fa-home' 			, 'Motivos'		, 'sale');
			$menu['sale']['lvl2']['voucher']['lvl3']['voucher_theme']['lvl4']['list']		= $this->menu(array('sale/voucher_theme'), 			'fa-home' 			, 'List' 		, 'sale');
			$menu['sale']['lvl2']['voucher']['lvl3']['voucher_theme']['lvl4']['add']		= $this->menu(array('sale/voucher_theme/insert'), 	'fa-home' 			, 'Add' 		, 'sale');
		 	
			// echo '<pre style="background-color: #FFFFCB; color: #135092; margin:0px">'; 
			// 	print_r($menu); 
			// 	// print_r($this->user->getPermission('access')); 
			// echo '</pre>'; 
			// //die();

			$navigation_menu_sidebar->data['menus'] = $menu;
				
			$navigation_menu_sidebar->data['home'] 							= $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['affiliate'] 					= $this->url->link('sale/affiliate', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['attribute'] 					= $this->url->link('catalog/attribute', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['attribute_group'] 				= $this->url->link('catalog/attribute_group', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['backup'] 						= $this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['banner'] 						= $this->url->link('design/banner', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['category'] 						= $this->url->link('catalog/category', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['country'] 						= $this->url->link('localisation/country', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['coupon'] 						= $this->url->link('sale/coupon', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['currency'] 						= $this->url->link('localisation/currency', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['customer'] 						= $this->url->link('sale/customer', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['customer_fields'] 				= $this->url->link('sale/customer_field', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['customer_group'] 				= $this->url->link('sale/customer_group', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['customer_ban_ip'] 				= $this->url->link('sale/customer_ban_ip', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['custom_field'] 					= $this->url->link('design/custom_field', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['download'] 						= $this->url->link('catalog/download', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['error_log'] 					= $this->url->link('tool/error_log', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['feed'] 							= $this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['filter'] 						= $this->url->link('catalog/filter', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['geo_zone'] 						= $this->url->link('localisation/geo_zone', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['information'] 					= $this->url->link('catalog/information', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['language'] 						= $this->url->link('localisation/language', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['layout'] 						= $this->url->link('design/layout', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['logout'] 						= $this->url->link('common/logout', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['contact'] 						= $this->url->link('sale/contact', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['manager'] 						= $this->url->link('extension/manager', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['manufacturer'] 					= $this->url->link('catalog/manufacturer', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['module'] 						= $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['option'] 						= $this->url->link('catalog/option', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['order'] 						= $this->url->link('sale/order', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['order_status'] 					= $this->url->link('localisation/order_status', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['payment'] 						= $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['product'] 						= $this->url->link('catalog/product', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['profile'] 						= $this->url->link('catalog/profile', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['report_sale_order'] 			= $this->url->link('report/sale_order', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['report_sale_tax'] 				= $this->url->link('report/sale_tax', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['report_sale_shipping'] 			= $this->url->link('report/sale_shipping', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['report_sale_return'] 			= $this->url->link('report/sale_return', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['report_sale_coupon'] 			= $this->url->link('report/sale_coupon', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['report_product_viewed'] 		= $this->url->link('report/product_viewed', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['report_product_purchased'] 		= $this->url->link('report/product_purchased', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['report_customer_online'] 		= $this->url->link('report/customer_online', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['report_customer_order'] 		= $this->url->link('report/customer_order', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['report_customer_reward'] 		= $this->url->link('report/customer_reward', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['report_customer_credit'] 		= $this->url->link('report/customer_credit', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['report_affiliate_commission'] 	= $this->url->link('report/affiliate_commission', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['review'] 						= $this->url->link('catalog/review', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['return'] 						= $this->url->link('sale/return', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['return_action'] 				= $this->url->link('localisation/return_action', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['return_reason'] 				= $this->url->link('localisation/return_reason', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['return_status'] 				= $this->url->link('localisation/return_status', 'token=' . $this->session->data['token'], 'SSL');			
			$navigation_menu_sidebar->data['shipping'] 						= $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['setting'] 						= $this->url->link('setting/store', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['store'] 						= HTTP_CATALOG;
			$navigation_menu_sidebar->data['stock_status'] 					= $this->url->link('localisation/stock_status', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['tax_class'] 					= $this->url->link('localisation/tax_class', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['tax_rate'] 						= $this->url->link('localisation/tax_rate', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['total'] 						= $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['user'] 							= $this->url->link('user/user', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['user_group'] 					= $this->url->link('user/user_permission', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['voucher'] 						= $this->url->link('sale/voucher', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['voucher_theme'] 				= $this->url->link('sale/voucher_theme', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['weight_class'] 					= $this->url->link('localisation/weight_class', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['length_class'] 					= $this->url->link('localisation/length_class', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['zone'] 							= $this->url->link('localisation/zone', 'token=' . $this->session->data['token'], 'SSL');

			$navigation_menu_sidebar->data['openbay_show_menu'] 			= $this->config->get('openbaymanager_show_menu');

			$navigation_menu_sidebar->data['openbay_link_extension'] 		= $this->url->link('extension/openbay', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['openbay_link_orders'] 			= $this->url->link('extension/openbay/orderList', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['openbay_link_items'] 			= $this->url->link('extension/openbay/itemList', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['openbay_link_ebay'] 			= $this->url->link('openbay/openbay', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['openbay_link_ebay_settings'] 	= $this->url->link('openbay/openbay/settings', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['openbay_link_ebay_links'] 		= $this->url->link('openbay/openbay/viewItemLinks', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['openbay_link_ebay_orderimport'] = $this->url->link('openbay/openbay/viewOrderImport', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['openbay_link_amazon'] 			= $this->url->link('openbay/amazon', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['openbay_link_amazon_settings'] 	= $this->url->link('openbay/amazon/settings', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['openbay_link_amazon_links'] 	= $this->url->link('openbay/amazon/itemLinks', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['openbay_link_amazonus'] 		= $this->url->link('openbay/amazonus', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['openbay_link_amazonus_settings']= $this->url->link('openbay/amazonus/settings', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['openbay_link_amazonus_links'] 	= $this->url->link('openbay/amazonus/itemLinks', 'token=' . $this->session->data['token'], 'SSL');

			$navigation_menu_sidebar->data['openbay_markets'] = array(
				'ebay' => $this->config->get('openbay_status'),
				'amazon' => $this->config->get('amazon_status'),
				'amazonus' => $this->config->get('amazonus_status'),
			);

			$navigation_menu_sidebar->data['paypal_express'] = $this->url->link('payment/pp_express', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['paypal_express_search'] = $this->url->link('payment/pp_express/search', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_menu_sidebar->data['recurring_profile'] = $this->url->link('sale/recurring', 'token=' . $this->session->data['token'], 'SSL');

			$navigation_menu_sidebar->data['stores'] = array();

			$this->load->model('setting/store');

			$results = $this->model_setting_store->getStores();

			foreach ($results as $result) {
				$navigation_menu_sidebar->data['stores'][] = array(
					'name' => $result['name'],
					'href' => $result['url']
				);
			}	


			$this->data['navigation_menu_sidebar'] = $navigation_menu_sidebar->fetch('common/navigation_menu_sidebar.tpl');	
			$this->data['navigation_top_bar'] = $navigation_top_bar->fetch('common/navigation_top_bar.tpl');
		}

		

		$this->template = 'common/header.tpl';

		$this->render();
	}

	private function menu($needle = array(), $icon = '', $title = null, $padre = 'common', $info = array('num' => 0, 'type' => ''), $url = 'common/home' ){
		// $this->language->load('common/header');
		$class = '';
		$viendo = explode("/", $this->request->get['route']);
		if($padre == $viendo[0]){
			$class = 'active';
		}

		if(isset($needle[0])){
			$controller = $needle[0];
			$controller = explode("/", isset($needle[0])?$needle[0]:$needle);
			$controller = $controller[0]."/".$controller[1];
		} else {
			$controller = $needle;
		}
		if(in_array($controller, $this->user->getPermission('access'))){
			if(isset($needle[1])){
				$href = $this->url->link($needle[0], $needle[1].'&token=' . $this->session->data['token'], 'SSL');
			} else {
				$href = $this->url->link($needle[0], 'token=' . $this->session->data['token'], 'SSL');
			}
			return array(
				'title' => $this->language->get( (isset($title) ? $title : $url) ),
				'icon'  => $icon,
				'class' => $class,
				'href'  => $href,
				'info'	=> $info
			);
		} else if(empty($needle)) {
			return array(
				'title' => $this->language->get( (isset($title) ? $title : $url) ),
				'icon'  => $icon,
				'class' => $class,
				'href'  => 'javascript:;',
				'info'	=> $info
			);
		} else {
			return false;
		}
	}
}
?>