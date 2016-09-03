<?php
class ModelCatalogPrepack extends Model {
	public function getTotalPrepacks(){
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "prepack`");

		return $query->row['total'];
	}

	public function getPrepacks($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX ."prepack p";

		if (!empty($data['filter_name'])) {
			$sql .= " AND od.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sort_data = array(
			'p.name',
			'p.sort_order'
			);

		if (isset($data['sort']) && (in_array($data['sort'], $sort_data))) {
			$sql .= ' ORDER BY ' . $data['sort'];
		} else {
			$sql .= " ORDER BY p.name"; 
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= ' ASC';
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " .(int)$data['start'] . "," . (int)$data['limit'];
		}
        $query = $this->db->query($sql);
		return $query->rows;
	}

	public function getPrepack($prepack_id) {
	    $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "prepack` p LEFT JOIN `" . DB_PREFIX . "prepack_description` pd ON 
	    	(p.prepack_id = pd.prepack_id) WHERE
	    	p.prepack_id = '" . (int)$prepack_id . "' AND
	    	pd.language_id = '" . $this->config->get('config_language_id') ."'");


	    return $query->row;
    }

	public function getPrepackDescriptions($prepack_id) {
		$prepack_data = array();

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "prepack_description` WHERE prepack_id = '" . (int)$prepack_id . "'");

		foreach ($query->rows as $result) {
			$prepack_data[$result['language_id']] = array('description' => $result['description']);
		}

		return $prepack_data;
	}

	public function addPrepack($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "prepack` SET name = '". $this->db->escape($data['name']) . "', sort_order= '" . $this->db->escape($data['sort_order']) . "'");
		$prepack_id = $this->db->getLastId();

		foreach ($data['prepack_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "prepack_description SET
				prepack_id = '" . (int)$prepack_id . "',
				language_id = '" .(int)$language_id . "',
				description = '" . $this->db->escape($value['description']) . "'"
			);

		}

		return $prepack_id;
	}

	public function editPrepack($prepack_id, $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "prepack` SET 
		    name = '" . $this->db->escape($data['name']) . "',
			sort_order = '" . $this->db->escape($data['sort_order']) . "'
			WHERE prepack_id='" . (int)$prepack_id . "'"
			);

		$this->db->query("DELETE FROM `" . DB_PREFIX . "prepack_description` WHERE prepack_id= '" . (int)$prepack_id ."'");

		foreach ($data['prepack_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "prepack_description` SET 
				prepack_id = '" . (int)$prepack_id . "',
				language_id = '" . (int)($language_id) . "',
				description = '" . $this->db->escape($value['description']) ."'"
			);
		}
	}

	public function deletePrepack($prepack_id) {
	    $this->db->query("DELETE FROM `" . DB_PREFIX . "prepack` WHERE 
	        prepack_id='" . (int)$prepack_id . "'" );

        $this->db->query("DELETE FROM `" . DB_PREFIX . "prepack_description` WHERE 
	        prepack_id='" . (int)$prepack_id . "'" );

    }

}