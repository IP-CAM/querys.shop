<?php
class ModelCatalogVideoGalleryvideo extends Model {	
	/*GALLERY IMAGE*/
	public function addVideo($data) {
      	$this->db->query("INSERT INTO " . DB_PREFIX . "videoGallery_video SET name = '" . $this->db->escape($data['name']) . "', sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW(), date_added = NOW(), description = '" . $this->db->escape($data['description']) . "', code = '" . $this->db->escape($data['code']) . "', source = '" . $this->db->escape($data['source']) . "' ");
		
		$video_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "videoGallery_video SET image = '" . $this->db->escape($data['image']) . "' WHERE video_id = '" . (int)$video_id . "'");
		}
		
		if (isset($data['video_album'])) {
			foreach ($data['video_album'] as $album_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "videoGallery_video_to_album SET video_id = '" . (int)$video_id . "', album_id = '" . (int)$album_id . "'");
			}
		}
			
		$this->cache->delete('video');
	}
	
	public function editVideo($video_id, $data) {
      	$this->db->query("UPDATE " . DB_PREFIX . "videoGallery_video SET name = '" . $this->db->escape($data['name']) . "', sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW(), description = '" . $this->db->escape($data['description']) . "', code = '" . $this->db->escape($data['code']) . "', source = '" . $this->db->escape($data['source']) . "' WHERE video_id = '" . (int)$video_id . "' ");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "videoGallery_video SET image = '" . $this->db->escape($data['image']) . "' WHERE video_id = '" . (int)$video_id . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "videoGallery_video_to_album WHERE video_id = '" . (int)$video_id . "'");
		
		if (isset($data['video_album'])) {
			foreach ($data['video_album'] as $album_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "videoGallery_video_to_album SET video_id = '" . (int)$video_id . "', album_id = '" . (int)$album_id . "'");
			}
		}
				
		$this->cache->delete('video');
	}
	
	public function getVideos($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "videoGallery_video";
			
			$sort_data = array(
				'name',
				'sort_order'
			);	
			
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY name";	
			}
			
			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}
			
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}					

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}	
			
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}				
			
			$query = $this->db->query($sql);
		
			return $query->rows;
		} else {
			$video_data = $this->cache->get('videoGallery_video');
		
			if (!$video_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "videoGallery_video ORDER BY name");
	
				$video_data = $query->rows;
			
				$this->cache->set('videoGallery_video', $video_data);
			}
		 
			return $video_data;
		}
	}
	
	public function getVideo($video_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "videoGallery_video WHERE video_id = '" . (int)$video_id . "'");
		
		return $query->row;
	}
	
	public function getTotalVideos() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "videoGallery_video");
		
		return $query->row['total'];
	}
	
	public function deleteVideo($video_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "videoGallery_video WHERE video_id = '" . (int)$video_id . "'");
			
		$this->cache->delete('video');
	}	

	public function getVideoAlbums($video_id) {
		$video_album_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "videoGallery_video_to_album WHERE video_id = '" . (int)$video_id . "'");

		foreach ($query->rows as $result) {
			$video_album_data[] = $result['album_id'];
		}
		
		return $video_album_data;
	}
	
	public function getAlbums($data = array()) {
		$album_data = $this->cache->get('album');
	
		if (!$album_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "videoGallery_album ORDER BY name");

			$album_data = $query->rows;
		
			$this->cache->set('album', $album_data);
		}
	 
		return $album_data;
	}

}
?>