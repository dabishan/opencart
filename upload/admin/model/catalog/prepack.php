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


}