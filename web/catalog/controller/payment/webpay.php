<?php 
/**
* @author Sebastian Gonzalez Riffo
* @email: sebastian@gonzalezr.cl
* @package opencart
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see license.txt
*
* OpenCart - eCommerce Solution
*/
class ControllerPaymentWebPay extends Controller {
	
    /* Crea el formulario con datos que irán a Webpay mediante POST */
    protected function index() {

		$this->load->model('checkout/order');
        
        $this->data['button_confirm'] = $this->language->get('button_confirm');

		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        //Seteamos los valores que van irán a WebPay
        // $this->data['tbk_monto']            = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false)."00";
        $this->data['tbk_monto']            = $order_info['total']."00";
        $this->data['tbk_tipo_transaccion'] = 'TR_NORMAL'; 
        $this->data['tbk_orden_compra']     = $order_info['order_id'];
		$this->data['tbk_id_sesion']        = $order_info['order_id'];
		$this->data['tbk_url_exito']        = $this->url->link('payment/webpay/exito','','SSL');
		$this->data['tbk_url_fracaso']      = $this->url->link('payment/webpay/fracaso','','SSL');
        
        //Ruta del CGI: tbk_bp_pago
        $this->data['action'] = '/cgi-bin/tbk_bp_pago.cgi';

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/webpay.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/webpay.tpl';
		} else {
			$this->template = 'default/template/payment/webpay.tpl';
		}	
		
		$this->render();
	}


    /* Página de Fracaso si la transacción no fue completada correctamente */
	public function fracaso(){

        $tbk_orden_compra = (isset($this->request->get['TBK_ORDEN_COMPRA'])?$this->request->get['TBK_ORDEN_COMPRA']:'');
        $this->language->load('payment/webpay');
		$this->language->load('payment/webpay');
		$this->language->load('checkout/checkout');
        $this->data['continue'] = $this->config->get('config_url');
        
        $path = $this->request->get['route'];
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home'),
            'separator' => false
        );  

        $this->data['breadcrumbs'][] = array(
            'text'      => 'Carro',
            'href'      => $this->url->link('checkout/cart'),
            'separator' => $this->language->get('text_separator')
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => 'Compra',
            'href'      => $this->url->link('checkout/checkout'),
            'separator' => $this->language->get('text_separator')
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => 'Fracaso Webpay',
            'href'      => $this->url->link('payment/webpay/fracaso','TBK_ORDEN_COMPRA='.$tbk_orden_compra),
            'separator' => $this->language->get('text_separator')
        );

        $this->data['text_contenido_error'] = $this->language->get('text_contenido_error');
        $this->data['text_volver']          = $this->language->get('text_volver');
        $this->data['text_title']           = $this->language->get('text_title');
		$this->data['button_continue']      = $this->language->get('button_continue');
        $this->data['tbk_orden_compra']     = $tbk_orden_compra;
        
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/webpay_failure.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/payment/webpay_failure.tpl';
        } else {
            $this->template = 'default/template/payment/webpay_failure.tpl';
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
        

	public function exito() {

        if (!empty($_POST['TBK_ORDEN_COMPRA'])) {

            $this->data['breadcrumbs'][] = array(
                'text'      => $this->language->get('text_home'),
                'href'      => $this->url->link('common/home'),
                'separator' => false
            );  

            $this->data['breadcrumbs'][] = array(
                'text'      => 'Compra',
                'href'      => $this->url->link('checkout/checkout'),
                'separator' => $this->language->get('text_separator')
            );

            $this->data['breadcrumbs'][] = array(
                'text'      => 'Exito',
                'href'      => $this->url->link('payment/webpay/exito'),
                'separator' => $this->language->get('text_separator')
            );


            $this->load->model('checkout/order');
            $this->load->model('payment/webpay');
           
            $this->language->load('payment/webpay');
            $this->language->load('checkout/checkout');
            
            #titulos de lenguage
            $this->data['text_heading_title'] = $this->language->get('text_heading_title');
            $this->data['text_nombre_comercio'] = $this->language->get('text_nombre_comercio');
            $this->data['text_url_comercio'] = $this->language->get('text_url_comercio');
            $this->data['text_nombre'] = $this->language->get('text_nombre');
            $this->data['text_fecha_transaccion'] = $this->language->get('text_fecha_transaccion');
            $this->data['text_tipo_transaccion'] = $this->language->get('text_tipo_transaccion');
            $this->data['text_codigo_autorizacion'] = $this->language->get('text_codigo_autorizacion');
            $this->data['text_numero_tarjeta'] = $this->language->get('text_numero_tarjeta');
            $this->data['text_numero_orden_pedido'] = $this->language->get('text_numero_orden_pedido');
            $this->data['text_cantidad_cuotas'] = $this->language->get('text_cantidad_cuotas');
            $this->data['text_tipo_cuotas'] = $this->language->get('text_tipo_cuotas');

            $this->data['text_informativo'] = $this->language->get('text_informativo');
            
            $this->data['button_continue'] = $this->language->get('button_continue');
        
            $this->data['column_name'] = $this->language->get('column_name');
            $this->data['column_model'] = $this->language->get('column_model');
            $this->data['column_quantity'] = $this->language->get('column_quantity');
            $this->data['column_price'] = $this->language->get('column_price');
            $this->data['column_total'] = $this->language->get('column_total');

            
            $order_id       =   $_POST['TBK_ORDEN_COMPRA'];

            $order_info     =   $this->model_checkout_order->getOrder($order_id);
            $order_webpay   =   $this->model_payment_webpay->getOrderWebPay($order_id);
            $order_customer =   $this->model_payment_webpay->getCustomerByOrder($order_id);

            if ( empty($order_webpay->row) ) {
                $this->redirect( $this->url->link('payment/webpay/fracaso','TBK_ORDEN_COMPRA='.$order_id) );
            }

            if( $order_webpay->row['tbk_respuesta'] != 0 ){
                 // $this->redirect($this->url->link('payment/webpay/fracaso', 'token=' . $this->session->data['token'] , 'SSL'));
                 $this->redirect($this->url->link('payment/webpay/fracaso','TBK_ORDEN_COMPRA='.$order_id, 'SSL'));
            }

            $vn             =   $this->model_payment_webpay->getTypePaymentVN($order_webpay->row['tbk_tipo_pago']);
            $tipo_pago      =   $this->model_payment_webpay->getTypePayment($order_webpay->row['tbk_tipo_pago']);


            $this->model_checkout_order->confirm($_POST['TBK_ORDEN_COMPRA'], $this->config->get('webpay_order_status_id'));

            $this->data['continue'] = $this->url->link('checkout/success');
           
            #Data para imprimir vista, requeridos por Certificación Transbank
            $this->data['nombre_comercio']          = $this->config->get('config_name');
            $this->data['url_comercio']             = $this->config->get('config_url');
            $this->data['nombre']                   = $order_customer->row['firstname']." ".$order_customer->row['lastname'];
            $this->data['fecha_transaccion']        = date('d-m-Y');
            $this->data['tipo_transaccion']         = 'Venta';
            $this->data['codigo_autorizacion']      = $order_webpay->row['tbk_codigo_autorizacion'];
            $this->data['numero_tarjeta']           = $order_webpay->row['tbk_final_numero_tarjeta'];
            $this->data['numero_orden_pedido']      = $order_id;
            $this->data['cantidad_cuotas']          = $order_webpay->row['tbk_numero_cuotas'];
            $this->data['vn']         			    = $vn;            
            $this->data['tipo_pago']			    =	$tipo_pago;
            $this->data['tbk_fecha_transaccion']	=	$order_webpay->row['tbk_fecha_transaccion'];
            ###

            $this->data['products'] = array();
            
            $order_detail = $this->model_payment_webpay->getOrderDetails($order_info);
            foreach ($order_detail['productos'] as $key => $product) {

                $option_data = $product['option'];
                $this->data['products'][] = array(
                    'product_id' => $product['product_id'],
                    'name'       => $product['name'],
                    'model'      => $product['model'],
                    'option'     => $option_data,
                    'quantity'   => $product['quantity'],
                    'price'      => $product['price'],
                    'total'      => $product['total'],
                    'href'       => $this->url->link('product/product', 'product_id=' . $product['product_id'])
                ); 
            }

            $taxes = $this->cart->getTaxes();
			$this->load->model('setting/extension');
			
			$sort_order = array(); 
			
			$results = $this->model_setting_extension->getExtensions('total');
			
			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}
			
			array_multisort($sort_order, SORT_ASC, $results);
			
			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);
		
					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}
			
			$sort_order = array(); 
		  
			foreach ($total_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}
	
            array_multisort($sort_order, SORT_ASC, $total_data);

            $this->data['totals'] = $total_data;
            $this->data['totals'] = $order_detail['totals'];

            
			$this->cart->clear();
			
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['guest']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);	
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);
                
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/webpay_success.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/payment/webpay_success.tpl';
            } else {
                $this->template = 'default/template/payment/webpay_success.tpl';
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
            $this->redirect( $this->url->link('common/home','','SSL') );
        }
	
	}


    /* Página de cierre 
     * DEBUG_CGI_WEBPAY : Se define en config
     */
    public function cierre(){

        $trs_respuesta = -9; //Error por Defecto

        if(isset($this->request->post) && !empty($this->request->post)){

            if(DEBUG_CGI_WEBPAY){
                $log = new Log('webpay_cierre_'.$this->request->post['TBK_ID_SESION'].'.txt');
                $log->write( 'POST TBK => '. serialize($this->request->post) );
            }
            $trs_transaccion        = $this->request->post['TBK_TIPO_TRANSACCION'];
            $trs_respuesta          = (int)$this->request->post['TBK_RESPUESTA'];
            $trs_orden_compra       = $this->request->post['TBK_ORDEN_COMPRA'];
            $trs_id_session         = $this->request->post['TBK_ID_SESION'];
            $trs_cod_autorizacion   = $this->request->post['TBK_CODIGO_AUTORIZACION'];
            $trs_monto              = substr($this->request->post['TBK_MONTO'],0,-2).".00";
            $trs_nro_final_tarjeta  = $this->request->post['TBK_FINAL_NUMERO_TARJETA'];
            $trs_fecha_expiracion   = '';
            // $trs_fecha_expiracion    = $this->request->post['TBK_FECHA_EXPIRACION'];
            $trs_fecha_contable     = $this->request->post['TBK_FECHA_CONTABLE'];
            $trs_fecha_transaccion  = $this->request->post['TBK_FECHA_TRANSACCION'];
            $trs_hora_transaccion   = $this->request->post['TBK_HORA_TRANSACCION'];
            $trs_id_transaccion     = $this->request->post['TBK_ID_TRANSACCION'];
            $trs_tipo_pago          = $this->request->post['TBK_TIPO_PAGO'];
            $trs_nro_cuotas         = $this->request->post['TBK_NUMERO_CUOTAS'];
            $trs_mac                = $this->request->post['TBK_MAC'];
            //$trs_monto_cuota      = $this->request->post['TBK_MONTO_CUOTA'];
            $trs_tasa_interes_max   = '';
            $trs_vci                = $this->request->post['TBK_VCI'];
       
            /* Graba en base de datos */
            $sql    =   "INSERT INTO " . DB_PREFIX . "order_webpay VALUES (NULL,'".$trs_orden_compra."','".$trs_transaccion."','".$trs_respuesta."','".$trs_monto."','".$trs_cod_autorizacion."','".$trs_nro_final_tarjeta."','".$trs_fecha_expiracion."','".$trs_fecha_contable."','".$trs_fecha_transaccion."','".$trs_hora_transaccion."','".$trs_id_session."','".$trs_id_transaccion."','".$trs_tipo_pago."','".$trs_nro_cuotas."','".$trs_tasa_interes_max."','".$trs_mac."','".$trs_vci."', NOW() )";
            $rs_ingresa = $this->db->query($sql);
            if(DEBUG_CGI_WEBPAY){
                $log->write( 'Guarda Tabla Webpay => '. $sql );
            }


            if( (int)$trs_respuesta == 0){ 

                if(DEBUG_CGI_WEBPAY){
                    $log->write('entra a validar todo');
                }

                //validar MAC
                /*1.- Abrir archivo y guardar variables POST recibidas */ 
                $filename = DIR_LOG_TMP."/log".$trs_id_transaccion.".txt";

                if(DEBUG_CGI_WEBPAY){
                    $log->write('Guarda ID Transaccion en Log temporal '. $filename);
                }
                
                $fp=fopen($filename,"w");
                reset($this->request->post);
                
                while (list($key,$val) = each($this->request->post)) {            
                    fwrite($fp,"$key=$val&");           
                }
                fclose($fp); 

                if(DEBUG_CGI_WEBPAY){
                    $log->write('Genera Log File con POST, para validar MAC');
                }
                    
                $cmdline = DIR_LOG_CGI."/cgi-bin/tbk_check_mac.cgi ".$filename;
                exec($cmdline,$result,$retint); 
                
                if($result[0] == "CORRECTO") { 

                    if(DEBUG_CGI_WEBPAY){
                        $log->write('MAC VALIDADA');
                    }

                    //VALIDAR ORDEN DE COMPRA
                    if(DEBUG_CGI_WEBPAY){
                        $log->write('Validando Orden de Compra');
                    }
                    
                    $sql    = "SELECT * FROM " . DB_PREFIX . "order WHERE order_id = '".(int)$trs_orden_compra . "' AND order_status_id = 0";
                    $query  = $this->db->query($sql);

                    $total_order = $query->num_rows;
                    
                    //ORDEN DE COMPRA CORRECTA
                    if ($total_order) {
                        if(DEBUG_CGI_WEBPAY){
                            $log->write('Order ID ['.(int)$trs_orden_compra.'] Existe y está en order_status_id = 0 aún');
                        }
                        
                        $monto = $query->row['total'];

                        if(DEBUG_CGI_WEBPAY){
                            $log->write('Order ID ['.(int)$trs_orden_compra.'] Monto : [' . $monto. ']');
                        }
                        
                        if($monto == $trs_monto){

                            if(DEBUG_CGI_WEBPAY){
                                $log->write('Order ID ['.(int)$trs_orden_compra.'] Monto Validado : [' . $monto. '] , TBK : ['.$trs_monto.'] ');
                            }

                            if(mysql_error() != '') {
                                if(DEBUG_CGI_WEBPAY){
                                    $log->write('RECHAZA TRANSACCION ID ['.(int)$trs_orden_compra.'] - Hay un error en MySQL');
                                }
                                echo "RECHAZADO";
                            } else {
                                //Orden correctamente pagada
                                $order_status_id = $this->config->get('webpay_order_status_id');
                                if(DEBUG_CGI_WEBPAY){
                                    $log->write('Descuenta Stock de productos');
                                }

                                $this->db->query("UPDATE `" . DB_PREFIX . "order` SET order_status_id = '" . (int)$order_status_id . "', date_modified = NOW() WHERE order_id = '" . (int)$trs_orden_compra . "'");

                                $this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = '" . (int)$trs_orden_compra . "', order_status_id = '" . (int)$order_status_id . "', notify = '0', comment = 'Orden pagada correctamente en Webpay', date_added = NOW()");

                                $order_product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$trs_orden_compra . "'");
                                
                                foreach ($order_product_query->rows as $order_product) {
                                    $this->db->query("UPDATE " . DB_PREFIX . "product SET quantity = (quantity - " . (int)$order_product['quantity'] . ") WHERE product_id = '" . (int)$order_product['product_id'] . "' AND subtract = '1'");
                                    if(DEBUG_CGI_WEBPAY) {
                                        $log->write("Descuenta Stock Ficha Padre [" . (int)$order_product['product_id'] . "]: -" . (int)$order_product['quantity'] );
                                    }
                                    $order_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$trs_orden_compra . "' AND order_product_id = '" . (int)$order_product['order_product_id'] . "'");
                                
                                    foreach ($order_option_query->rows as $option) {
                                        $this->db->query("UPDATE " . DB_PREFIX . "product_option_value SET quantity = (quantity - " . (int)$order_product['quantity'] . ") WHERE product_option_value_id = '" . (int)$option['product_option_value_id'] . "' AND subtract = '1'");
                                        if(DEBUG_CGI_WEBPAY){
                                            $log->write("Descuenta Stock Option Value ID [" . (int)$option['product_option_value_id'] . "]: -" . (int)$order_product['quantity'] );
                                        }
                                    }
                                }
                                if(DEBUG_CGI_WEBPAY){
                                    $log->write('ACEPTA TRANSACCION ID ['.(int)$trs_orden_compra.']');
                                }
                                echo "ACEPTADO";
                            }

                        } else {
                            if(DEBUG_CGI_WEBPAY){
                               $log->write('RECHAZADO MONTOS NO COINCIDEN ['.(int)$trs_orden_compra.'] Monto ORDEN : [' . $monto. '] , TBK : ['.$trs_monto.'] ');
                            }
                            echo "RECHAZADO";
                        }
                            
                    } else {
                        if(DEBUG_CGI_WEBPAY) {
                           $log->write('LA ORDEN YA FUE PAGADA O CAMBIO DE ESTADO RECHAZADO MONTOS NO COINCIDEN ['.(int)$trs_orden_compra.']');
                        }
                        echo "RECHAZADO";
                    }
                        
                } else {
                    if(DEBUG_CGI_WEBPAY){
                        $log->write('MAC NO HA SIDO VALIDADA');
                    }
                    echo "RECHAZADO";
                }
            } else {
                if(DEBUG_CGI_WEBPAY){
                    $log->write('TBK RESPUESTA NO ES 0, estado retornado: ' . $trs_respuesta);
                }
                echo "ACEPTADO";
            }

        } else {
            $log = new Log('webpay_error.txt');
            $log->write('No se recibe POST retorno en Pago Webpay');
            die('RECHAZADO');
        }
        die;
    }
}
?>
