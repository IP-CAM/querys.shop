<?php
class Modelstorelocationstorelocation extends Model {
	public function addStorelocation($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "storelocation SET status = '" . (int)$data['status'] . "', feature_flag = '" . (int)$data['feature_flag'] . "', phone = '" . $this->db->escape($data['phone']) ."', email = '" . $this->db->escape($data['email']) ."', latitude = '" . $this->db->escape($data['latitude']) ."', longitude = '" . $this->db->escape($data['longitude']) . "', date_added = now()");
		$storelocation_id = $this->db->getLastId();
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "storelocation SET image = '" . $this->db->escape($data['image']) . "' WHERE storelocation_id = '" . (int)$storelocation_id . "'");
		}
		foreach ($data['storelocation_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "storelocation_description SET storelocation_id = '" . (int)$storelocation_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', address = '" . $this->db->escape($value['address']) . "', description = '" . $this->db->escape($value['description']) . "', timing = '" . $this->db->escape($value['timing']). "'");
		}
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'storelocation_id=" . (int)$storelocation_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		if (isset($data['storelocation_store'])) {
			foreach ($data['storelocation_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "storelocation_to_store SET storelocation_id = '" . (int)$storelocation_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		$this->cache->delete('storelocation');
	}

	public function editStorelocation($storelocation_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "storelocation SET status = '" . (int)$data['status'] . "', feature_flag = '" . (int)$data['feature_flag'] ."', phone = '" . $this->db->escape($data['phone']) ."', email = '" . $this->db->escape($data['email']) ."', latitude = '" . $this->db->escape($data['latitude']) ."', longitude = '" . $this->db->escape($data['longitude']) . "' WHERE storelocation_id = '" . (int)$storelocation_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "storelocation_description WHERE storelocation_id = '" . (int)$storelocation_id . "'");
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "storelocation SET image = '" . $this->db->escape($data['image']) . "' WHERE storelocation_id = '" . (int)$storelocation_id . "'");
		}
		foreach ($data['storelocation_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "storelocation_description SET storelocation_id = '" . (int)$storelocation_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', address = '" . $this->db->escape($value['address']) . "', description = '" . $this->db->escape($value['description']) . "', timing = '" . $this->db->escape($value['timing']) . "'");
		}
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'storelocation_id=" . (int)$storelocation_id. "'");
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'storelocation_id=" . (int)$storelocation_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		$this->db->query("DELETE FROM " . DB_PREFIX . "storelocation_to_store WHERE storelocation_id = '" . (int)$storelocation_id . "'");
		if (isset($data['storelocation_store'])) {		
			foreach ($data['storelocation_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "storelocation_to_store SET storelocation_id = '" . (int)$storelocation_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		$this->cache->delete('storelocation');
	}

	public function deleteStorelocation($storelocation_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "storelocation WHERE storelocation_id = '" . (int)$storelocation_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "storelocation WHERE storelocation_id = '" . (int)$storelocation_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'storelocation_id=" . (int)$storelocation_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "storelocation_to_store WHERE storelocation_id = '" . (int)$storelocation_id . "'");
		$this->cache->delete('storelocation');
	}	

	public function getStorelocationStory($storelocation_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'storelocation_id=" . (int)$storelocation_id . "') AS keyword FROM " . DB_PREFIX . "storelocation WHERE storelocation_id = '" . (int)$storelocation_id . "'");
		return $query->row;
	}

	public function getStorelocationDescriptions($storelocation_id) {
		$storelocation_description_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "storelocation_description WHERE storelocation_id = '" . (int)$storelocation_id . "'");
		foreach ($query->rows as $result) {
			$storelocation_description_data[$result['language_id']] = array(
				'title'            => $result['title'],
				'address' => $result['address'],
				'description'      => $result['description'],
				'timing'             => $result['timing']
			);
		}
		return $storelocation_description_data;
	}

	public function getStorelocationStores($storelocation_id) {
		$storelocation_store_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "storelocation_to_store WHERE storelocation_id = '" . (int)$storelocation_id . "'");
		foreach ($query->rows as $result) {
			$storelocation_store_data[] = $result['store_id'];
		}
		return $storelocation_store_data;
	}

	public function getStorelocation() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "storelocation n LEFT JOIN " . DB_PREFIX . "storelocation_description nd ON (n.storelocation_id = nd.storelocation_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY n.date_added DESC");
		return $query->rows;
	}

	public function getTotalStorelocation() {
		$this->checkStoreLocation();
     	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "storelocation");
		return $query->row['total'];
	}	

	public function checkStoreLocation() {
		$create_storelocation = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "storelocation` (`storelocation_id` int(11) NOT NULL auto_increment, `status` int(1) NOT NULL default '0' , `feature_flag` int(1) NOT NULL default '0', `phone` varchar(100) collate utf8_bin default NULL, `email` varchar(100) collate utf8_bin default NULL, `image` varchar(255) collate utf8_bin default NULL, `image_size` int(1) NOT NULL default '0', `latitude` FLOAT(10,6) NOT NULL, `longitude` FLOAT(10,6) NOT NULL, `date_added` datetime default NULL, PRIMARY KEY  (`storelocation_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
		$this->db->query($create_storelocation);
		$create_storelocation_descriptions = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "storelocation_description` (`storelocation_id` int(11) NOT NULL default '0', `language_id` int(11) NOT NULL default '0', `title` varchar(64) collate utf8_bin NOT NULL default '', `address` varchar(255) collate utf8_bin NOT NULL, `description` text collate utf8_bin NOT NULL, `timing` varchar(255) collate utf8_bin NOT NULL default '', PRIMARY KEY  (`storelocation_id`,`language_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
		$this->db->query($create_storelocation_descriptions);
		$create_storelocation_to_store = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "storelocation_to_store` (`storelocation_id` int(11) NOT NULL, `store_id` int(11) NOT NULL, PRIMARY KEY  (`storelocation_id`, `store_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
		$this->db->query($create_storelocation_to_store);
	}
}
?>