<?php
/**
 * media model
 * @package EMLOG (www.emlog.net)
 */

class Media_Model {

	private $db;

	function __construct() {
		$this->db = Database::getInstance();
	}

	function getMedias() {
		$sql = "SELECT * FROM " . DB_PREFIX . "attachment WHERE thumfor = 0 order by aid desc";
		$query = $this->db->query($sql);
		$attach = [];
		while ($row = $this->db->fetch_array($query)) {
			$attach[$row['aid']] = [
				'attsize'  => changeFileSize($row['filesize']),
				'filename' => htmlspecialchars($row['filename']),
				'addtime'  => date("Y-m-d H:i", $row['addtime']),
				'aid'      => $row['aid'],
				'filepath' => $row['filepath'],
				'width'    => $row['width'],
				'height'   => $row['height'],
			];
			$thum = $this->db->once_fetch_array('SELECT * FROM ' . DB_PREFIX . 'attachment WHERE thumfor = ' . $row['aid']);
			if ($thum) {
				$attach[$row['aid']]['thum_filepath'] = $thum['filepath'];
				$attach[$row['aid']]['thum_width'] = $thum['width'];
				$attach[$row['aid']]['thum_height'] = $thum['height'];
			}
		}
		return $attach;
	}

	function addMedia() {

	}

	function deleteLink() {

	}

}