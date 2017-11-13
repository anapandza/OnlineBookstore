<?php

require_once("php/Slider.php");
require_once("php/Thumbnail.php");

class API {
    public static function processRequest() {
        $action = API::getParametarValue("action");
        switch($action){
            case "getSliders":
                return API::getSliders();
            case "changeGrade":
                return API::changeGrade();
            case "getThumbnails":
                return API::getThumbnails();
            case "addThumbnail":
                return API::addThumbnail();
            default:
                return "Unknown action!";
        }
    }

    private static function getSliders(){
        return json_encode(Slider::getSliders());
    }

    private static function changeGrade() {
        $id = API::getParametarValue("id");
        $grade = API::getParametarValue("grade");
        if($id != ""){
            Slider::changeGrade($id, $grade);
            return json_encode(array(
            "success" => true
            ));
        }
        else {
            API::sendErrorAndDie("changeGrade needs an id");
        }
    }

    private static function getThumbnails(){
        return json_encode(Thumbnail::getThumbnails());
    }

    private static function addThumbnail(){
        $title = API::getParametarValue("title");
        $imageUrl = API::getParametarValue("imageUrl");
        try {
            return json_encode(array(
            "id" => Thumbnail::addThumbnail($title, $imageUrl)
            ));
        }
        catch(Exception $e){
            API::sendErrorAndDie("Failed when adding a card: $e");
        }
    }

    public static function sendErrorAndDie($message){
        header("HTTP/1.1 400 Invalid Request");
        die(json_encode(array(
        "message" => $message
    )));
    }

    private static function getParametarValue($key){
        return isset($_REQUEST[$key]) ? $_REQUEST[$key] : "";
    }
}
echo(API::processRequest());