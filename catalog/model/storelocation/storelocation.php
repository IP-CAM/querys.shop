<?php
class ModelStorelocationStorelocation extends Model {
	public function getStorelocationStory($storelocation_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "storelocation n LEFT JOIN " . DB_PREFIX . "storelocation_description nd ON (n.storelocation_id = nd.storelocation_id) LEFT JOIN " . DB_PREFIX . "storelocation_to_store n2s ON (n.storelocation_id = n2s.storelocation_id) WHERE n.storelocation_id = '" . (int)$storelocation_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND n.status = '1'");
		return $query->row;
	}

	public function getStorelocation($data) {
		$query = $this->db->query("SELECT *, ( 3959 * acos( cos( radians(".$data['latitude'].") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$data['longitude'].") ) + sin( radians(".$data['latitude'].") ) * sin( radians( latitude ) ) ) ) AS distance FROM " . DB_PREFIX . "storelocation n LEFT JOIN " . DB_PREFIX . "storelocation_description nd ON (n.storelocation_id = nd.storelocation_id) LEFT JOIN " . DB_PREFIX . "storelocation_to_store n2s ON (n.storelocation_id = n2s.storelocation_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND n.status = '1'".($data['radius']?' HAVING distance < '.$data['radius']:'')." ORDER BY distance, n.date_added DESC LIMIT ".$data['start'].",".$data['limit']);
		return $query->rows;
	}

	public function getStorelocationShorts($limit) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "storelocation n LEFT JOIN " . DB_PREFIX . "storelocation_description nd ON (n.storelocation_id = nd.storelocation_id) LEFT JOIN " . DB_PREFIX . "storelocation_to_store n2s ON (n.storelocation_id = n2s.storelocation_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND n.status = '1' ORDER BY n.feature_flag DESC, n.date_added DESC LIMIT " . (int)$limit); 
		return $query->rows;
	}

	public function getTotalStorelocation($data) {
		//$query = $this->db->query("SELECT count(*) as total, ( 3959 * acos( cos( radians(".$data['latitude'].") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$data['longitude'].") ) + sin( radians(".$data['latitude'].") ) * sin( radians( latitude ) ) ) ) AS distance FROM " . DB_PREFIX . "storelocation n LEFT JOIN " . DB_PREFIX . "storelocation_description nd ON (n.storelocation_id = nd.storelocation_id) LEFT JOIN " . DB_PREFIX . "storelocation_to_store n2s ON (n.storelocation_id = n2s.storelocation_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND n.status = '1'".($data['radius']?' HAVING distance < '.$data['radius']:'')." ORDER BY distance, n.date_added DESC LIMIT ".$data['start'].",".$data['limit']);
		$query = $this->db->query("SELECT count(*) as total FROM " . DB_PREFIX . "storelocation n LEFT JOIN " . DB_PREFIX . "storelocation_description nd ON (n.storelocation_id = nd.storelocation_id) LEFT JOIN " . DB_PREFIX . "storelocation_to_store n2s ON (n.storelocation_id = n2s.storelocation_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND n.status = '1'".($data['radius']?" AND ( 3959 * acos( cos( radians(".$data['latitude'].") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$data['longitude'].") ) + sin( radians(".$data['latitude'].") ) * sin( radians( latitude ) ) ) ) < ".$data['radius']:''));
		if ($query->row) {
			return $query->row['total'];
		} else {
			return FALSE;
		}
	}
}
?>
