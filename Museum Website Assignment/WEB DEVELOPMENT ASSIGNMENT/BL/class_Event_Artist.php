<?php
require_once(".\DAL\DAL_Event_Artist.php");

class Event_Artist { 
    private $Artist_idArtist;
    private $Event_idEvent;
    private $Event_name;
    private $Artist_name;
    private $details;
    private $participation_start_date;
    private $participation_end_date;
    private $operation_status=0;
    private $Event_image;
    
    function getParticipation_start_date() {
        return $this->participation_start_date;
    }

    function getParticipation_end_date() {
        return $this->participation_end_date;
    }

    function getEvent_image() {
        return $this->Event_image;
    }

    function setParticipation_start_date($participation_start_date) {
        $this->participation_start_date = $participation_start_date;
    }

    function setParticipation_end_date($participation_end_date) {
        $this->participation_end_date = $participation_end_date;
    }

    function setEvent_image($Event_image) {
        $this->Event_image = $Event_image;
    }

        function getEvent_name() {
        return $this->Event_name;
    }

    function getArtist_name() {
        return $this->Artist_name;
    }

    function setEvent_name($Event_name) {
        $this->Event_name = $Event_name;
    }

    function setArtist_name($Artist_name) {
        $this->Artist_name = $Artist_name;
    }

    function __construct($Artist_name=null, $Event_name=null, $participation_start_date=null, $participation_end_date=null, $details=null, $operation_status=null) {
        $this->Artist_name = $Artist_name;
        $this->Event_name = $Event_name;
        $this->details = $details;
        $this->participation_start_date = $participation_start_date;
        $this->participation_end_date = $participation_end_date;
        $this->operation_status = $operation_status;
    }

    function setArtist_idArtist($Artist_idArtist) {
        $this->Artist_idArtist = $Artist_idArtist;
    }

    function setEvent_idEvent($Event_idEvent) {
        $this->Event_idEvent = $Event_idEvent;
    }

    function setDetails($details) {
        $this->details = $details;
    }

    function setStart_date($participation_start_date) {
        $this->participation_start_date = $participation_start_date;
    }

    function setEnd_date($participation_end_date) {
        $this->participation_end_date = $participation_end_date;
    }

    function setOperation_status($operation_status) {
        $this->operation_status = $operation_status;
    }

    function getOperation_status() {
        return $this->operation_status;
    }

        function getArtist_idArtist() {
        return $this->Artist_idArtist;
    }

    function getEvent_idEvent() {
        return $this->Event_idEvent;
    }

    function getDetails() {
        return $this->details;
    }

    function getStart_date() {
        return $this->participation_start_date;
    }

    function getEnd_date() {
        return $this->participation_end_date;
    }

    function create_event_artist(){
    $this->operation_status=DAL_Event_Artist::{"create_event_artist"}($this->Artist_name,$this->Event_name,$this->participation_start_date,$this->participation_end_date,$this->details);    
    }
    
    function update_event_artist() {
    $this->operation_status=DAL_Event_Artist::{"update_event_artist"}($this->Artist_name,$this->Event_name,$this->participation_start_date,$this->participation_end_date,$this->details);   
    }
    
    static function retrieve_event_artists() {
    $artists=DAL_Event_Artist::{"retrieve_event_artists"}();   
    return $artists;
    }

    static function retrieve_events_for_artists() {
    $artists=DAL_Event_Artist::{"retrieve_events_for_artists"}();   
    return $artists;
    }
    
    function delete_event_artist() {
    $this->operation_status=DAL_Event_Artist::{"delete_event_artist"}($this->Artist_name,$this->Event_name);    
    }
    
}
