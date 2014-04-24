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
		$this->data['text_confirm'] = $this->language->get('text_confirm');

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
			$this->load->model('extension/module');
		
			$option_groups 	= $this->model_catalog_option->getOptions();
			$manufactures 	= $this->model_catalog_manufacturer->getManufacturers();
			$modules 		= $this->model_extension_module->getModules();

			$menu = array();
			$menu['common'] 			  									= $this->menu(array('common/home')		, 					'fa-home' 	 	 , 'Dashboard'		, 'common');
			$menu['catalog']		  										= $this->menu(array(), 										'fa-th-list' 	 , 'Catalogo'		, 'catalog');
			$menu['catalog']['lvl2']['category']							= $this->menu(array('catalog/category'), 					'fa-sitemap' 	 , 'Categorías' 	, 'catalog', array('num' => $this->model_catalog_category->getTotalCategories(), 'type' => 'info'));
			// $menu['catalog']['lvl2']['category']							= $this->menu(array(), 										'fa-sitemap' 	 , 'Categorías' 	, 'catalog', array('num' => $this->model_catalog_category->getTotalCategories(), 'type' => 'info'));
			// $menu['catalog']['lvl2']['category']['lvl3']['list']			= $this->menu(array('catalog/category'), 					'fa-th-list' 	 , 'Listado' 		, 'catalog', array('num' => $this->model_catalog_category->getTotalCategories(), 'type' => 'info'));
			// $menu['catalog']['lvl2']['category']['lvl3']['add']			= $this->menu(array('catalog/category/insert'), 			'fa-plus-square' , 'Nueva' 			, 'catalog');
			// $menu['catalog']['lvl2']['category']['lvl3']['tecnologias']	= $this->menu(array('catalog/category'), 					'fa-plus-square' , 'Tecnologías'	, 'catalog');
			$menu['catalog']['lvl2']['product']								= $this->menu(array(), 										'fa-barcode' 	 , 'Productos' 		, 'catalog');
			$menu['catalog']['lvl2']['product']['lvl3']['list']				= $this->menu(array('catalog/product'), 					'fa-th-list'     , 'Listado' 		, 'catalog');
			$menu['catalog']['lvl2']['product']['lvl3']['insert']			= $this->menu(array('catalog/product/insert'), 				'fa-plus-square' , 'Nuevo' 			, 'catalog');
			$menu['catalog']['lvl2']['product']['lvl3']['product_related']	= $this->menu(array(), 										'fa-th-list'     , 'Promociones' 	, 'catalog');
			$menu['catalog']['lvl2']['product']['lvl3']['recomendaciones']	= $this->menu(array(), 										'fa-home' 		 , 'Recomendación'	, 'catalog');
			$menu['catalog']['lvl2']['product']['lvl3']['request']			= $this->menu(array(), 										'fa-home' 		 , 'Request'		, 'catalog');
			$menu['catalog']['lvl2']['product']['lvl3']['premios']			= $this->menu(array(), 										'fa-coffee' 	 , 'Premios'		, 'catalog');
			$menu['catalog']['lvl2']['manufacturer']						= $this->menu(array('catalog/manufacturer'),				'fa-th-list' 	 , 'Marcas' 		, 'catalog', array('num' => $this->model_catalog_manufacturer->getTotalManufacturers(), 'type' =>'info') );
			// $menu['catalog']['lvl2']['manufacturer']						= $this->menu(array(), 										'fa-th-list' 	 , 'Marcas' 		, 'catalog');
			// $menu['catalog']['lvl2']['manufacturer']['lvl3'][]				= $this->menu(array('catalog/manufacturer'), 				'fa-th-list' 	 , 'Listado' 		, 'catalog', array('num' => $this->model_catalog_manufacturer->getTotalManufacturers(), 'type' =>'info' ));
			// $menu['catalog']['lvl2']['manufacturer']['lvl3'][]				= $this->menu(array('catalog/product/insert'), 				'fa-plus-square' , 'Nueva' 			, 'catalog');
			// foreach ($manufactures as $key => $value) {
			// 	$menu['catalog']['lvl2']['manufacturer']['lvl3'][$value['name']]	= $this->menu(array('catalog/manufacturer/update','manufacturer_id='.$value['manufacturer_id']),	'fa-edit' , $value['name']		, 'catalog');
			// }
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
			$menu['sale']['lvl2']['quotation']												= $this->menu(array(), 								'fa-sitemap' 	 	, 'Cotización' 	, 'sale');
			$menu['sale']['lvl2']['quotation']['lvl3']['list']								= $this->menu(array(), 					'fa-th-list' 		, 'List' 		, 'sale');
			$menu['sale']['lvl2']['quotation']['lvl3']['add']								= $this->menu(array(), 			'fa-plus-square' 	, 'Add' 		, 'sale');
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
			$menu['sale']['lvl2']['contact']												= $this->menu(array('sale/contact'), 				'fa-sitemap' 	 	, 'Contacto'	, 'sale');
			$menu['report']																= $this->menu(array(), 								'fa-bar-chart-o' 	 	, 'Reportes'	, 'report');
			$menu['report']['lvl2']['sale']												= $this->menu(array(), 								'fa-sitemap' 	 	, 'Ventas'		, 'report');
			$menu['report']['lvl2']['sale']['lvl3']['sale_order']						= $this->menu(array('report/sale_order'),			'fa-home' 			, 'Órdenes' 	, 'report');
			$menu['report']['lvl2']['sale']['lvl3']['sale_tax']							= $this->menu(array('report/sale_tax'),				'fa-home' 			, 'Impuestos' 	, 'report');
			$menu['report']['lvl2']['sale']['lvl3']['sale_shipping']					= $this->menu(array('report/sale_shipping'),		'fa-home' 			, 'Envíos' 		, 'report');
			$menu['report']['lvl2']['sale']['lvl3']['sale_return']						= $this->menu(array('report/sale_return'),			'fa-home' 			, 'Devoluciones', 'report');
			$menu['report']['lvl2']['sale']['lvl3']['sale_coupon']						= $this->menu(array('report/sale_coupon'),			'fa-home' 			, 'Cupones' 	, 'report');
			$menu['report']['lvl2']['product']											= $this->menu(array(), 								'fa-sitemap' 	 	, 'Productos'	, 'report');
			$menu['report']['lvl2']['product']['lvl3']['product_viewed']				= $this->menu(array('report/sale_order'),			'fa-home' 			, 'Visitados' 	, 'report');
			$menu['report']['lvl2']['product']['lvl3']['product_purchased']				= $this->menu(array('report/product_purchased'),	'fa-home' 			, 'Comprados' 	, 'report');
			$menu['report']['lvl2']['product']['lvl3']['product_stock']					= $this->menu(array(),								'fa-truck'			, 'Stock' 		, 'report');
			$menu['report']['lvl2']['customer']											= $this->menu(array(), 								'fa-sitemap' 	 	, 'Clientes'	, 'report');
			$menu['report']['lvl2']['customer']['lvl3']['customer_online']				= $this->menu(array('report/customer_online'),		'fa-home' 			, 'Online' 		, 'report');
			$menu['report']['lvl2']['customer']['lvl3']['customer_order']				= $this->menu(array('report/customer_order'),		'fa-home' 			, 'Órdenes' 	, 'report');
			$menu['report']['lvl2']['customer']['lvl3']['customer_reward']				= $this->menu(array('report/customer_reward'),		'fa-home'			, 'Recompensas' , 'report');
			$menu['report']['lvl2']['customer']['lvl3']['customer_credit']				= $this->menu(array('report/customer_credit'),		'fa-home'			, 'Crédito' 	, 'report');
			$menu['report']['lvl2']['affiliate']										= $this->menu(array(), 								'fa-sitemap' 	 	, 'Afliados'	, 'report');
			$menu['report']['lvl2']['affiliate']['lvl3']['affiliate_commission']		= $this->menu(array('report/customer_online'),		'fa-home' 			, 'Comisión' 	, 'report');


			$menu['extension']															= $this->menu(array()						, 	'fa-cog fa-spin' 	, 'Extensiones'		, 'extension');
			$menu['extension']['lvl2']['module']										= $this->menu(array()						, 	'fa-sitemap' 	 	, 'Módulos'			, 'extension');
			$menu['extension']['lvl2']['module']['lvl3']['list']						= $this->menu(array('extension/module')		, 	'fa-th-list' 	 	, 'List'			, 'extension');
			foreach ($modules as $key => $value) {
				$menu['extension']['lvl2']['module']['lvl3'][$value['code']]			= $this->menu(array($value['action'])		,	'fa-edit' 	, $value['name']	, 'extension');
			}
			$menu['extension']['lvl2']['shipping']										= $this->menu(array('extension/shipping')	, 	'fa-sitemap', 'Envíos'			, 'extension');
			$menu['extension']['lvl2']['payment']										= $this->menu(array('extension/payment')	, 	'fa-sitemap', 'Pagos'			, 'extension');
			$menu['extension']['lvl2']['total']											= $this->menu(array('extension/total')		, 	'fa-sitemap', 'Totales'			, 'extension');
			$menu['extension']['lvl2']['feed']											= $this->menu(array('extension/feed')		, 	'fa-sitemap', 'RSS Productos'	, 'extension');

			$menu['setting']														= $this->menu(array()							,	'fa-cogs' 	, 'Sistema'				 , 'setting');
			$menu['setting']['lvl2']['shipping']									= $this->menu(array('setting/store')			,	'fa-edit' 	, 'Tiendas'				 , 'setting');
			$menu['setting']['lvl2']['local']										= $this->menu(array()							,	'fa-cog' 	, 'Local'				 , 'setting');
			$menu['setting']['lvl2']['local']['lvl3'][]								= $this->menu(array('localisation/language')	,	'fa-cog' 	, 'Idiomas'				 , 'setting');
			$menu['setting']['lvl2']['local']['lvl3'][]								= $this->menu(array('localisation/currency')	,	'fa-cog' 	, 'Monedas'				 , 'setting');
			$menu['setting']['lvl2']['local']['lvl3'][]								= $this->menu(array('localisation/stock_status'),	'fa-cog' 	, 'Estados Stock'		 , 'setting');
			$menu['setting']['lvl2']['local']['lvl3'][]								= $this->menu(array('localisation/order_status'),	'fa-cog' 	, 'Estados Órdenes'		 , 'setting');
			$menu['setting']['lvl2']['local']['lvl3'][]								= $this->menu(array('localisation/country')		,	'fa-cog' 	, 'Paises'				 , 'setting');
			$menu['setting']['lvl2']['local']['lvl3'][]								= $this->menu(array('localisation/geo_zone')	,	'fa-cog' 	, 'Zona Geográfica'		 , 'setting');
			$menu['setting']['lvl2']['local']['lvl3'][]								= $this->menu(array('localisation/zone')		,	'fa-cog' 	, 'Regiones'			 , 'setting');
			$menu['setting']['lvl2']['local']['lvl3'][]								= $this->menu(array()							,	'fa-cog' 	, 'Comunas'				 , 'setting', array('num' => 'FALTA', 'type' =>'error' ));
			$menu['setting']['lvl2']['local']['lvl3'][]								= $this->menu(array('localisation/length_class'),	'fa-cog' 	, 'Tipo Medidas'		 , 'setting');
			$menu['setting']['lvl2']['local']['lvl3'][]								= $this->menu(array('localisation/weight_class'),	'fa-cog' 	, 'Tipo Peso'			 , 'setting');
			$menu['setting']['lvl2']['local']['lvl3']['tax']						= $this->menu(array()							,	'fa-cog' 	, 'Impuestos'			 , 'setting');
			$menu['setting']['lvl2']['local']['lvl3']['tax']['lvl4'][]				= $this->menu(array('localisation/tax_class')	,	'fa-cog' 	, 'Tipo de Impuesto'	 , 'setting');
			$menu['setting']['lvl2']['local']['lvl3']['tax']['lvl4'][]				= $this->menu(array('localisation/tax_rate')	,	'fa-cog' 	, 'Tasa de Impuesto'	 , 'setting');
			$menu['setting']['lvl2']['local']['lvl3']['return']						= $this->menu(array()							,	'fa-cog' 	, 'Devoluciones'		 , 'setting');
			$menu['setting']['lvl2']['local']['lvl3']['return']['lvl4'][]			= $this->menu(array('localisation/return_status'),	'fa-cog' 	, 'Estados', 'setting');
			$menu['setting']['lvl2']['local']['lvl3']['return']['lvl4'][]			= $this->menu(array('localisation/return_action'),	'fa-cog' 	, 'Acciones', 'setting');
			$menu['setting']['lvl2']['local']['lvl3']['return']['lvl4'][]			= $this->menu(array('localisation/return_reason'),	'fa-cog' 	, 'Motivos', 'setting');
			

			$menu['setting']['lvl2']['user']										= $this->menu(array()								,	'fa-cog', 'Usuarios'			, 'setting');
			$menu['setting']['lvl2']['user']['lvl3'][]								= $this->menu(array('user/user')					,	'fa-cog', 'Listado'				, 'setting');
			$menu['setting']['lvl2']['user']['lvl3'][]								= $this->menu(array('user/user/insert')				,	'fa-cog', 'Agregar'				, 'setting');
			$menu['setting']['lvl2']['user']['lvl3'][]								= $this->menu(array('user/user_permission')			,	'fa-cog', 'Grupos Listado'		, 'setting');
			$menu['setting']['lvl2']['user']['lvl3'][]								= $this->menu(array('user/user_permission/insert')	,	'fa-cog', 'Grupos Agregar'		, 'setting');

			$menu['setting']['lvl2']['design']										= $this->menu(array()								,	'fa-cog', 'Diseño'				, 'setting');
			$menu['setting']['lvl2']['design']['lvl3'][]							= $this->menu(array('design/layout')				,	'fa-cog', 'Posiciones'			, 'setting');
			$menu['setting']['lvl2']['design']['lvl3'][]							= $this->menu(array('design/banner')				,	'fa-cog', 'Banners'				, 'setting');
		
			$menu['setting']['lvl2']['error_log']									= $this->menu(array('tool/error_log')				,	'fa-cog', 'Registro Errores'		, 'setting');
			$menu['setting']['lvl2']['backup']										= $this->menu(array('tool/backup')					,	'fa-cog', 'Respaldo & Restauración'	, 'setting');
			$menu['setting']['lvl2']['storelocation']								= $this->menu(array('module/storelocation/listing')	,	'fa-truck', 'Ubicacion Tiendas'	, 'module');

			$menu['blog']										= $this->menu(array()								,	'fa-cog', 'Content Manager'				, 'blog');
			$menu['blog']['lvl2'][]								= $this->menu(array('blog/blog')					,	'fa-cog', 'Home'						, 'blog');
			$menu['blog']['lvl2'][]								= $this->menu(array('blog/article')					,	'fa-cog', 'Artículo'					, 'blog');
			$menu['blog']['lvl2'][]								= $this->menu(array('blog/category')				,	'fa-cog', 'Categorías'					, 'blog');
			$menu['blog']['lvl2'][]								= $this->menu(array('blog/comment')					,	'fa-cog', 'Comentarios'					, 'blog');
			$menu['blog']['lvl2'][]								= $this->menu(array('blog/author')					,	'fa-cog', 'Autores'						, 'blog');
			$menu['blog']['lvl2'][]								= $this->menu(array('blog/setting')					,	'fa-cog fa-spin', 'Configuraciones'		, 'blog');
			$menu['blog']['lvl2'][]								= $this->menu(array('catalog/information')			,	'fa-cog', 'Information'					, 'blog');
			$menu['blog']['lvl2']['video']						= $this->menu(array()								,	'fa-youtube-play', 'Videos'				, 'blog');
			$menu['blog']['lvl2']['video']['lvl3'][]			= $this->menu(array('catalog/videoGallery_album')	,	'fa-youtube-play', 'Video Gallery'		, 'blog');
			$menu['blog']['lvl2']['video']['lvl3'][]			= $this->menu(array('catalog/videoGallery_video')	,	'fa-youtube-play', 'Videos'				, 'blog');
			
			$navigation_menu_sidebar->data['menus'] = $menu;
			$this->data['navigation_menu_sidebar'] = $navigation_menu_sidebar->fetch('common/navigation_menu_sidebar.tpl');	
			//End Menu Lateral


			$this->load->model('setting/store');

			$results = $this->model_setting_store->getStores();

	 
			$navigation_top_bar->data['stores'][] = array(
				'name' => $this->config->get('config_name'),
				'href' => HTTPS_CATALOG
			);
			foreach ($results as $result) {
				$navigation_top_bar->data['stores'][] = array(
					'name' => $result['name'],
					'href' => $result['url']
				);
			}	

			$navigation_top_bar->data['home'] 			= $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_top_bar->data['store_list'] 	= $this->url->link('setting/store', 'token=' . $this->session->data['token'], 'SSL');
			$navigation_top_bar->data['username']		= $this->user->getUserName();
			$navigation_top_bar->data['username_edit']	= $this->url->link('user/user/update', 'user_id='.$this->user->getId().'&token=' . $this->session->data['token'], 'SSL');
			$navigation_top_bar->data['logout']			= $this->url->link('common/logout', 'token=' . $this->session->data['token'], 'SSL');
			$this->data['navigation_top_bar'] = $navigation_top_bar->fetch('common/navigation_top_bar.tpl');
			//End Menu Superior
		}

		$this->template = 'common/header.tpl';

		$this->render();
	}

	private function menu($needle = array(), $icon = '', $title = null, $padre = 'common', $info = array('num' => 0, 'type' => ''), $url = 'common/home' ){
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