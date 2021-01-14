/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var PATH_LOWER_POOL="./resources/images/water.jpg";
var TITLE_LOWER_POOL="Lower river";
var DESC_LOWER_POOL="This is the lower part of the river, the water leaves the system ,unaffected, after its fall produced energy";

var PATH_UPPER_POOL="./resources/images/water.jpg";
var TITLE_UPPER_POOL="Upper river";
var DESC_UPPER_POOL="This is the higher part of the river, the water enters in the system and its fall will produce energy";

var PATH_TURBINE="./resources/images/turbine.jpg";
var TITLE_TURBINE="Turbine";
var DESC_TURBINE="This hydroelectric turbine converts the kinetic energy of the falling water into electric energy";

var PATH_GATE="./resources/images/gate.jpg";
var TITLE_GATE="Gate";
var DESC_GATE="The gate regulates the quantity of water entering in the channel";

var PATH_VALVE="./resources/images/valve.jpg";
var TITLE_VALVE="Valve duct";
var DESC_VALVE="This tube fills thanks to the pressure of the water in the higher river";

var PATH_VENT="./resources/images/vent.jpg";
var TITLE_VENT="Mill vent";
var DESC_VENT="Part of the water is detoured to make possible the mill rotation";

function assign(x,y,z) {
document.getElementById("image_description").src = x;
document.getElementById("description_title").innerHTML = "<h2> " + y + " </h2>";
document.getElementById("description_text").innerHTML = z;    
}

function lower_pool_desc() {
assign(PATH_LOWER_POOL,TITLE_LOWER_POOL,DESC_LOWER_POOL);
}

function upper_pool_desc() {
assign(PATH_UPPER_POOL,TITLE_UPPER_POOL,DESC_UPPER_POOL);
}

function turbine_desc() {
assign(PATH_TURBINE,TITLE_TURBINE,DESC_TURBINE);  
}

function gate_desc() {
assign(PATH_GATE,TITLE_GATE,DESC_GATE);    
}

function valve_desc() {
assign(PATH_VALVE,TITLE_VALVE,DESC_VALVE);    
}

function vent_desc() {
assign(PATH_VENT,TITLE_VENT,DESC_VENT); 
}
