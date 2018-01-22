<?php

require_once("DatabaseAccess.php");

class Thumbnail {
	public $id;
	public $title;
	public $imageUrl;
	
	public function __construct($id, $title, $imageUrl) {
		$this->id = $id;
		$this->title = $title;
		$this->imageUrl = $imageUrl;
	}
	
	public static function getThumbnails(){
		$thumbnails = array();
		$dbAccess = Thumbnail::getDbAccess();
		$rows = $dbAccess->executeQuery("SELECT * FROM Images;");		
		foreach($rows as $row){
			$thumbnails[] = new Thumbnail($row[0], $row[1], $row[2]);
		}
		return $thumbnails;
	}

	public static function addThumbnail($title, $imageUrl){
		$dbAccess = Thumbnail::getDbAccess();
		$dbAccess->executeQuery("INSERT INTO Images (Title, ImageUrl) VALUES ('$title', '$imageUrl');");
		$rows = $dbAccess->executeQuery("SELECT MAX(ID) FROM Images;");
		return $rows[0][0];  // id novog thumbnaila
	}
	
	private static function getDbAccess(){
		return new DatabaseAccess(
			"localhost",  //location to DB server
			"PandzaAna", //name of the base 
			"PandzaAna", //username
			"PandzaAna1" //password
		);
	}
}
