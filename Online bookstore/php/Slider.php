<?php

require_once("DatabaseAccess.php");

class Slider {
	public $id;
	public $title;
	public $imageUrl;
    public $text;
    public $grade;
	
	public function __construct($id, $title, $imageUrl, $text, $grade) {
		$this->id = $id;
		$this->title = $title;
		$this->imageUrl = $imageUrl;
        $this->text = $text;
        $this->grade = $grade;
	}
	
	public static function getSliders(){
		$sliders = array();
		$dbAccess = Slider::getDbAccess();
		$rows = $dbAccess->executeQuery("SELECT * FROM Items;");		
		foreach($rows as $row){
			$sliders[] = new Slider($row[0], $row[1], $row[2], $row[3], $row[4]);
		}
		return $sliders;
	}
    
    public static function changeGrade($id, $grade){
        $dbAccess = Slider::getDbAccess();
        $dbAccess->executeQuery("UPDATE Items SET Grade='$grade' WHERE ID='$id';");
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
