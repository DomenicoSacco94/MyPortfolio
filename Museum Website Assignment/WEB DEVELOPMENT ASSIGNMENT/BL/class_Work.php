<?php
require_once(".\DAL\DAL_Work.php");

class Work { 
    private $idWork;
    private $Work_name;
    private $material;
    private $type;
    private $date;
    private $Work_description;
    private $Room_idRoom;
    private $Room_name;
    private $Work_img_name;
    private $Work_image;
    private $Artist_name;
    private $operation_status=0;
    
    function getWork_img_name() {
        return $this->Work_img_name;
    }

    function getArtist_name() {
        return $this->Artist_name;
    }

    function setWork_img_name($Work_img_name) {
        $this->Work_img_name = $Work_img_name;
    }

    function setArtist_name($Artist_name) {
        $this->Artist_name = $Artist_name;
    }

        function getWork_image() {
        return $this->Work_image;
    }

    function setWork_image($Work_image) {
        $this->Work_image = $Work_image;
    }

        function getWork_image_name() {
        return $this->Work_img_name;
    }

    function setWork_image_name($Work_img_name) {
        $this->Work_img_name = $Work_img_name;
    }

        function getRoom_name() {
        return $this->Room_name;
    }

    function setRoom_name($Room_name) {
        $this->Room_name = $Room_name;
    }

        function __construct($idWork=null, $Work_name=null, $material=null, $type=null, $date=null, $Work_description=null, $Room_name=null, $Work_img_name=null, $Work_image=null, $operation_status=null) {
        $this->idWork = $idWork;
        $this->Work_name = $Work_name;
        $this->material = $material;
        $this->type = $type;
        $this->date = $date;
        $this->Work_description = $Work_description;
        $this->Room_name = $Room_name;
        $this->operation_status = $operation_status;
        $this->Work_img_name= $Work_img_name;
        $this->Work_image= $Work_image;
    }

    function setIdWork($idWork) {
        $this->idWork = $idWork;
    }

    function setWork_name($Work_name) {
        $this->Work_name = $Work_name;
    }

    function setMaterial($material) {
        $this->material = $material;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setWork_description($Work_description) {
        $this->Work_description = $Work_description;
    }

    function setRoom_idRoom($Room_idRoom) {
        $this->Room_idRoom = $Room_idRoom;
    }

    function setOperation_status($operation_status) {
        $this->operation_status = $operation_status;
    }

    function getOperation_status() {
        return $this->operation_status;
    }

        function getIdWork() {
        return $this->idWork;
    }

    function getWork_name() {
        return $this->Work_name;
    }

    function getMaterial() {
        return $this->material;
    }

    function getType() {
        return $this->type;
    }

    function getDate() {
        return $this->date;
    }

    function getWork_description() {
        return $this->Work_description;
    }

    function getRoom_idRoom() {
        return $this->Room_idRoom;
    }

    function create_work(){
    $this->operation_status=DAL_Work::{"create_work"}($this->Work_name,$this->material,$this->type,$this->date,$this->Work_description,$this->Room_name,$this->Work_img_name,$this->Work_image);    
    }
    
    function update_work() {
    $this->operation_status=DAL_Work::{"update_work"}($this->idWork,$this->Work_name,$this->material,$this->type,$this->date,$this->Work_description,$this->Room_name,$this->Work_img_name,$this->Work_image);   
    }
    
    static function retrieve_works() {
    $works_array=DAL_Work::{"retrieve_works"}();   
    return $works_array;
    }
    
    static function retrieve_works_for_artists() {
    $works_array=DAL_Work::{"retrieve_works_for_artists"}();   
    return $works_array;
    }
    
     static function retrieve_works_for_rooms() {
    $works_array=DAL_Work::{"retrieve_works_for_rooms"}();   
    return $works_array;
    }
    
    function delete_work() {
    $this->operation_status=DAL_Work::{"delete_work"}($this->idWork);    
    }
}
