function get_timestamp() {
    return new Date().toISOString().slice(0, 19).replace('T', ' ');
}

window.onload = function () {
    sessionStorage.setItem("visit_start",get_timestamp()); 
    page=window.location.href;
    identifier=document.getElementById('visitor_identifier').innerHTML;
    sessionStorage.setItem("identifier",identifier);
    if (page.substring(page.indexOf('&')+6,page.length-4)==="//localhost/Php_Assignment5/index") {
    sessionStorage.setItem("visited_page","Website access");
    }
    else {
    sessionStorage.setItem("visited_page",page.substring(page.indexOf('&')+6,page.length-4));    
    }
        };

window.onbeforeunload = function () {
        visit_start=sessionStorage.getItem("visit_start");
        visited_page=sessionStorage.getItem("visited_page");  
        visit_end=get_timestamp();
        identifier=sessionStorage.getItem("identifier");
        //alert("session-start: " + visit_start + " session-end: " + visit_end + " visited_page: " + visited_page);
        var json_upload = JSON.stringify({visited_page: visited_page, visit_start: visit_start, visit_end: visit_end, visitor_identifier: identifier});
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "control/Ajax.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-formurlencoded"); 
        xhr.setRequestHeader("Content-length", json_upload.length);
        xhr.setRequestHeader("Connection", "close"); 
        xhr.onreadystatechange = saveSessionComplete;
        xhr.send(json_upload);
};

function saveSessionComplete(){
if(this.readyState==4 && this.status==200){
var res=this.responseText;
var json=JSON.parse(res);
//alert(json.outcome); 
}
}