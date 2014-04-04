<?php 
/**
* @author Miguel Cantillana 
* @package opencart
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see license.txt
*
* OpenCart - eCommerce Solution
*/
class ModelPaymentWebPay extends Model {
  	public function getMethod($address) {
		$this->load->language('payment/webpay');
		
		if ($this->config->get('webpay_status')) {
      		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('alertpay_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
			
			if (!$this->config->get('webpay_geo_zone_id')) {
        		$status = TRUE;
      		} elseif ($query->num_rows) {
      		  	$status = TRUE;
      		} else {
     	  		$status = FALSE;
			}	
      	} else {
			$status = FALSE;
		}
		
		$method_data = array();
	
		if ($status) {  
      		$method_data = array( 
        		'code'         => 'webpay',
        		'title'      => $this->language->get('text_title'),
				'sort_order' => $this->config->get('webpay_sort_order')
      		);
    	}
   
    	return $method_data;
  	}

    function getOrderWebPay($order_id){
         $order_webpay 			= $this->db->query("SELECT ow.* FROM " . DB_PREFIX . "order_webpay ow WHERE ow.order_id = '" . (int)$order_id . "'");

         return $order_webpay;
    }
    
    function getOrderStatus($order_id){
        $order_status_query 	= $this->db->query("SELECT * FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "' AND language_id = '" . (int)$order_query->row['language_id'] . "'");

        return $order_status_query;
    }        

    function getOrderProduct($order_id){
    
        $order_product_query 	= $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");
        
        return $order_product_query;
    }

    function getTotalOrder($order_id){
        $order_total_query 		= $this->db->query("SELECT * FROM " . DB_PREFIX . "order_total WHERE order_id = '" . (int)$order_id . "' ORDER BY sort_order ASC");
        return $order_total_query;
    }
    
    function getDownloadOrder($order_id){
        $order_download_query 	= $this->db->query("SELECT * FROM " . DB_PREFIX . "order_download WHERE order_id = '" . (int)$order_id . "'");
        return $order_download_query;    
    }

    function getCustomerByOrder($order_id){
        $order_customer			= $this->db->query("SELECT o.firstname, o.lastname FROM " . DB_PREFIX . "order o WHERE order_id = '" . (int)$order_id . "'");

        return $order_customer;
    }

    function getTypePaymentVN($type_payment){

        $vn = "";      
        switch($type_payment){
           case 'VN':
              $vn = ("Sin Cuotas");
           break;
           case 'VC':
             $vn  = ("Normales");
           break;
           case 'SI':
              $vn = ("Sin Intereses");
           break;
           case 'VC':
              $vn = ("Cuotas Comercio");
           break;

           case 'VD':
              $vn = ("Venta Débito");
           break;
         }       
         return $vn;
    }
    function getTypePayment($type_payment){

        $vn = "";

        switch($type_payment) {
           case 'VN': $vn = ("Crédito"); break;
           case 'VC': $vn = ("Crédito"); break;
           case 'SI': $vn = ("Crédito"); break;
           case 'VC': $vn = ("Crédito"); break;
           case 'VD': $vn = ("Redcompra"); break;
         }
        return $vn;
    }
}
?>
