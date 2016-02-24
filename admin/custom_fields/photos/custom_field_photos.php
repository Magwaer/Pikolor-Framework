<?php
/*
* Pikolor Engine - by Pikolor
*
* @package		Pikolor Engine
* @author		Buzco Stanislav
* @copyright	Copyright (c) 2008 - 2016, Pikolor
* @link		http://pikolor.com
* @ Version : 2 Beta
* @index
*/

require_once("models/Photos_model.php");

class custom_field_photos extends Custom_field{
	
	public $has_multilang = false;
	
	public function init()
	{
		parent::init();
		$this->add_css("/admin/custom_fields/photos/css/photos.css" , "photos_field");
		$this->add_js("/admin/custom_fields/photos/js/ajax_uploading.js" , "ajax_uploading");
		$this->add_js("/admin/custom_fields/photos/js/photos.js" , "photos_field");
		
		$this->load("models", "photos_model", true);
	}
	
	public function get_html()
	{
		if (!is_array($this->data['value']))
			$photos = json_decode(isset($this->data['value']) ? $this->data['value'] : "", true);
		else
			$photos = $this->data['value'];
		
		if (!is_array($photos)) $photos = array();
		
		foreach($photos as &$photo)
		{
			$db_photo = $this->photos_model->get_by_id($photo);
			$photo = $db_photo;
		}
		
		$this->data['value'] = $photos;
		
		echo  $this->getTemplate("/admin/custom_fields/photos/photos.twig", $this->data);
	}
	
	public function prepare_data($data, $node_id)
	{
		return json_encode($data);
	}
	
	public function upload()
	{
		$folder = $this->request->get('folder');
		$photo = "";
		$photo_id = 0;
		$error = "";
		$msg = "";
		$fileElementName = 'file';

		if(!empty($_FILES[$fileElementName]['error']))
		{
		switch($_FILES[$fileElementName]['error'])
		{
			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
			break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
			break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
			break;
			case '4':
				$error = 'No file was uploaded.';
			break;

			case '6':
				$error = 'Missing a temporary folder';
			break;
			case '7':
				$error = 'Failed to write file to disk';
			break;
			case '8':
				$error = 'File upload stopped by extension';
			break;
			case '999':
			default:
				$error = 'No error code avaiable';
			}
		}
		elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
		{
			$error = 'No file was uploaded..';
		}
		else{
			if (!empty($_FILES[$fileElementName]['name'])) {
				$userfile = $_FILES[$fileElementName]['tmp_name'];
				$userfile_name = $_FILES[$fileElementName]['name'];

				list($wi, $hi, $type, $attr) = @getimagesize($userfile);
				switch ($type) {
					case '1' :$ext = ".gif";
					break;
					case '2' :$ext = ".jpg";
					break;
					case '3' :$ext = ".png";
					break;
				}

				if (!empty($ext)) {
					list($width, $height) = getimagesize($userfile);

					$photo_id = $this->photos_model->create(array("date" => date('Y-m-d H:i:s') , "original_title" => $userfile_name));
					$name = $photo_id . $ext;

					if (is_uploaded_file($userfile)) {
						$adr = realpath(ROOT . DS . "upload" . DS . $folder) ;
						move_uploaded_file($userfile, $adr . DS . $name);

						$photo = "/upload/" . $folder . "/" . $photo_id . $ext;
						$this->photos_model->update(array("path" => $photo), $photo_id);
					}
				}
			}
		}
		$final = array("error" => $error, "msg" => $msg, "photo" => $photo, "id" => $photo_id);
		echo json_encode($final);
		die();
	}
}


