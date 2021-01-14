/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
canvas = document.getElementById('canvas1');
var ctx = canvas.getContext('2d');
var BIAS_X = 200;
var BIAS_Y = 100;
if ($(window).width()>1280)
    {
    var SCALE = 0.37;
    }
else if ($(window).width()<=1280 && $(window).width()>1152 )
    {
    var SCALE = 0.33;
    }
else if ($(window).width()<=1152 && $(window).width()>768)
    {
    var SCALE = 0.26;
    }
else if ($(window).width()<=768 && $(window).width()>480)
    {
    var SCALE = 0.24;
    }
else if ($(window).width()<=480 && $(window).width()>0)
    {
    var SCALE = 0.18;
    }
var FRIDGE_CONSUMPTION = 1200;
var LAPTOP_CONSUMPTION = 100;
var LIGHTBULB_CONSUMPTION = 50;
var TELEVISION_CONSUMPTION = 150;
var slider_water = document.getElementById("water_lvl");
var slider_turb = document.getElementById("turb_range");
var output_lvl = document.getElementById("lvl");
var output_range = document.getElementById("turb_lvl");
var turbine_length = document.getElementById("water_length");
var generated_power = document.getElementById("generated_power");
var water = document.getElementById("water_sound");
var turbine = document.getElementById("turbine_sound");
var button_view1 = document.getElementById("view1");
var button_view2 = document.getElementById("view2");
var poly_tube = [430, 300, 1200, 50];
var poly_tube2 = [430, 400, 1200, 150];
var poly_hor_tube = [1200, 50, 1500, 50, 1500, 150, 1200, 150];
var poly_pool = [20, 148, 20, 200, 350, 200, 350, 148];
var poly_turbine_lowertop = [30, 180, 30, 200, 90, 200, 90, 180];
var poly_turbine_uppertop = [45, 80, 45, 130, 75, 130, 75, 80];
var poly_linker = [300, 200, 300, 400, 430, 400, 430, 360, 340, 360, 340, 200];
var poly_lower_gate = [1500, 150, 1500, 300, 1600, 300, 1600, 150];
var poly_valve = [450, 280, 450, 400, 430, 400, 430, 280];
var poly_hor_tube_white = [1200, 50, 1200, 150, 1500, 150, 1500, 50];
var poly_tube_white = [430, 400, 1200, 150, 1200, 50, 430, 300];
var poly_upper_valve = [290, 200, 300, 220, 340, 220, 350, 200];
var poly_cleaner = [300, 400, 310, 420, 330, 420, 340, 400];
var poly_white3 = [41, 300 + 1, 79, 300 + 1, 79, 300 + 3, 41, 300 + 3];
var poly_lowerpool = [-390, 350, -390, 700, -100, 700, -100, 350];
var poly_water = [20, 200 - 30, 20, 200, 350, 200, 350, 200 - 30];
var img = new Image();
img.src = "./resources/images/backgr.jpg";
var fill_level = 0;
var intervalId = null;
var fill_level = 0;
var fill_level2 = 0;
var fill_level3 = -182;
var default_height = 40;

window.onload = function() {
    ctx.drawImage(img, BIAS_X - 200 * (SCALE * 2), BIAS_Y - 100 * (SCALE * 2), 1202 * 2 * SCALE, 452 * 2 * SCALE);
    default_sequence();
};

function setIntervalX(callback, delay, repetitions) {
    var x = 0;
    var intervalID = window.setInterval(function() {

        callback();

        if (++x === repetitions) {
            window.clearInterval(intervalID);
        }
    }, delay);
}

var rects = [{
            x: SCALE * -390 + BIAS_X,
            y: SCALE * 400 + BIAS_Y,
            w: SCALE * 290,
            h: SCALE * 350,
            mthd: function() {
                lower_pool_desc();
            }
        },
        {
            x: SCALE * 10 + BIAS_X,
            y: SCALE * 30 + BIAS_Y,
            w: SCALE * 200,
            h: SCALE * 270,
            mthd: function() {
                turbine_desc();
            }
        },
        {
            x: SCALE * 1600 + BIAS_X,
            y: SCALE * -100 + BIAS_Y,
            w: SCALE * 400,
            h: SCALE * 400,
            mthd: function() {
                upper_pool_desc();
            }
        },
        {
            x: SCALE * 1500 + BIAS_X,
            y: SCALE * -100 + BIAS_Y,
            w: SCALE * 100,
            h: SCALE * 400,
            mthd: function() {
                gate_desc();
            }
        },
        {
            x: SCALE * 270 + BIAS_X,
            y: SCALE * 200 + BIAS_Y,
            w: SCALE * 170,
            h: SCALE * 200,
            mthd: function() {
                valve_desc();
            }
        },
    ],
    i = 0,
    r;

function draw_interrs() {
    while (r = rects[i++]) ctx.rect(r.x, r.y, r.w, r.h);
    ctx.fillStyle = "blue";
    ctx.fill();
}

canvas.onclick = function(e) {

    // important: correct mouse position:
    var rect = this.getBoundingClientRect(),
        x = e.clientX - rect.left,
        y = e.clientY - rect.top,
        i = 0,
        r;

    //ctx.clearRect(0, 0, canvas.width, canvas.height); // for demo

    while (r = rects[i++]) {
        // add a single rect to path:
        ctx.beginPath();
        ctx.rect(r.x, r.y, r.w, r.h);

        // check if we hover it, fill red, if not fill it blue
        if (ctx.isPointInPath(x, y)) {
            r.mthd();
        };
    }

    //default_sequence();
};

function set_tableValues(power) {
    document.getElementById("fridge_quantity").innerHTML = roundToTwo(power / FRIDGE_CONSUMPTION);
    document.getElementById("laptop_quantity").innerHTML = roundToTwo(power / LAPTOP_CONSUMPTION);
    document.getElementById("lightbulb_quantity").innerHTML = roundToTwo(power / LIGHTBULB_CONSUMPTION);
    document.getElementById("television_quantity").innerHTML = roundToTwo(power / TELEVISION_CONSUMPTION);
}

function write_text(pos_x, pos_y, text, font, color) {
    ctx.font = font;
    ctx.fillStyle = color;
    ctx.fillText(text, SCALE * pos_x + BIAS_X, SCALE * pos_y + BIAS_Y);
}

function roundToTwo(num) {
    return +(Math.round(num + "e+2") + "e-2");
}

function draw_polygon(poly, filly, strokey, close_path, fill_poly, stroke_poly) {
    ctx.fillStyle = filly;
    ctx.strokeStyle = strokey;
    ctx.beginPath();
    ctx.moveTo(SCALE * poly[0] + BIAS_X, SCALE * poly[1] + BIAS_Y);
    for (item = 2; item < poly.length - 1; item += 2) {
        ctx.lineTo(SCALE * poly[item] + BIAS_X, SCALE * poly[item + 1] + BIAS_Y);
    }
    if (close_path === true) {
        ctx.closePath();
    }
    if (fill_poly === true) {
        ctx.fill();
    }
    if (stroke_poly === true) {
        ctx.stroke();
    }
}

function draw_height() {
    ctx.beginPath();
    ctx.moveTo(SCALE * 25 + BIAS_X, SCALE * (250 + default_height) + BIAS_Y);
    ctx.lineTo(SCALE * 125 + BIAS_X, SCALE * (250 + default_height) + BIAS_Y);
    ctx.stroke();
    ctx.setLineDash([]);
}

function default_sequence() {
    ctx.drawImage(img, BIAS_X - 200 * (SCALE * 2), BIAS_Y - 100 * (SCALE * 2), 1202 * 2 * SCALE, 452 * 2 * SCALE);
    var poly_tube_water = [430, 400 - slider_water.value, 1200, 150 - slider_water.value, 1200, 150, 430, 400];
    var poly_hor_tube_water = [1200, 150 - slider_water.value, 1200, 150, 1502, 150, 1502, 150 - slider_water.value];
    var poly_upper_gate = [1500, 150 - slider_water.value, 1500, -slider_water.value - 100, 1600, -slider_water.value - 100, 1600, 150 - slider_water.value];
    var poly_turbine_chanlow = [40, 200, 40, 250 + 2 + slider_turb.value / 2, -220, 500 + slider_turb.value / 2, -180, 500 + slider_turb.value / 2, 81, 250 + 2 + slider_turb.value / 2, 81, 200];
    var poly_lowerwater = [-390, 400 + slider_turb.value / 2, -390, 700, -100, 700, -100, 400 + slider_turb.value / 2];
    var poly_turbine_body = [50, 100, 50, 250 + slider_turb.value / 2, 70, 250 + slider_turb.value / 2, 70, 100];
    var poly_height_marker = [-10, 200, -20, 200, -20, 250 + slider_turb.value / 2, -10, 250 + slider_turb.value / 2];

    draw_polygon(poly_lowerpool, '#000', '#000', false, false, true);
    draw_polygon(poly_lowerwater, '#116', '#116', true, true, false);
    draw_polygon(poly_pool, '#FFF', '#000', true, true, true);
    if (slider_water.value > 0) {
        draw_polygon(poly_turbine_chanlow, '#116', '#000', true, false, true);
        draw_polygon(poly_linker, '#116', '#000', true, false, true);
    } else {
        draw_polygon(poly_turbine_chanlow, '#FFF', '#000', true, false, true);
        draw_polygon(poly_linker, '#FFF', '#000', true, true, true);
    }

    draw_polygon(poly_height_marker, '#811', '#811', false, false, true);
    draw_polygon(poly_tube, '#000', '#000', false, false, true);
    draw_polygon(poly_tube2, '#000', '#000', false, false, true);
    draw_polygon(poly_hor_tube_white, '#fff', '#000', true, true, false);
    draw_polygon(poly_tube_white, '#fff', '#000', true, true, false);
    //draw_polygon(poly_water,'#116','#100',true,full,false);
    draw_polygon(poly_turbine_body, '#666', '#000', true, true, true);
    draw_polygon(poly_turbine_uppertop, '#000', '#000', false, true, true);
    draw_polygon(poly_hor_tube, '#116', '#000', false, false, true);
    draw_polygon(poly_hor_tube_water, '#116', '#116', true, true, false);
    draw_polygon(poly_tube_water, '#116', '#100', false, true, false);
    draw_polygon(poly_lower_gate, '#666', '#000', true, true, true);
    draw_polygon(poly_upper_gate, '#666', '#000', true, true, true);
    draw_polygon(poly_valve, '#000', '#000', true, true, true);
    draw_polygon(poly_upper_valve, '#000', '#000', true, true, true);
    draw_polygon(poly_cleaner, '#000', '#000', true, true, true);
    draw_polygon(poly_turbine_lowertop, '#000', '#000', false, true, true);
    write_text(-10, 240 + slider_turb.value / 4, "h", "20px Arial", "black");
    //draw_interrs();
    draw_height();
    write_text(81, 320, "DEFAULT HEIGHT", "8px Arial", "black");
    set_tableValues(roundToTwo(0.5 * (slider_turb.value / 100 + 1) * slider_water.value));
    draw_interrs();
}

function fill_water1() {
    var poly_linker_1 = [300, 400 - fill_level, 300, 400, 430, 400, 430, 400 - fill_level, 340, 400 - fill_level, 340, 400 - fill_level];
    draw_polygon(poly_linker_1, '#116', '#000', true, true, false);
    if (fill_level < 40) {
        fill_level++;
    }
}

function fill_water2() {
    var poly_linker_2 = [300, 400 - fill_level2, 300, 400, 340, 400, 340, 400 - fill_level2];
    if (fill_level2 < 181) {
        draw_polygon(poly_linker_2, '#116', '#000', true, true, false);
        fill_level2++;
    } else {
        var poly_turbine_body = [50, 100, 50, 250 + slider_turb.value / 2, 70, 250 + slider_turb.value / 2, 70, 100];
        var poly_turbine_chanlow = [40, 200, 40, 250 + 2 + slider_turb.value / 2, -220, 500 + slider_turb.value / 2, -180, 500 + slider_turb.value / 2, 81, 250 + 2 + slider_turb.value / 2, 81, 200];
        if (slider_water.value > 0) {
            draw_polygon(poly_turbine_chanlow, '#116', '#000', true, true, true);
        }
        draw_polygon(poly_turbine_body, '#666', '#000', true, true, true);
        draw_polygon(poly_turbine_uppertop, '#000', '#000', false, true, true);
        draw_polygon(poly_turbine_lowertop, '#000', '#000', false, true, true);
    }
}

function fill_water3() {
    if (fill_level3 > 0 && fill_level3 < 30) {
        var poly_linker_3 = [20, 200 - fill_level3, 20, 200, 350, 200, 350, 200 - fill_level3];
        draw_polygon(poly_linker_3, '#116', '#000', true, true, false);
    }

    if (fill_level3 < 30) {
        fill_level3++;
    }
    var poly_turbine_body = [50, 100, 50, 250 + slider_turb.value / 2, 70, 250 + slider_turb.value / 2, 70, 100];
    draw_polygon(poly_turbine_body, '#666', '#000', true, true, true);
    draw_polygon(poly_turbine_lowertop, '#000', '#000', false, true, true);
    draw_polygon(poly_turbine_uppertop, '#000', '#000', false, true, true);
}

slider_water.oninput = function() {

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    output_lvl.innerHTML = "  " + roundToTwo(slider_water.value) + " L/s";
    generated_power.innerHTML = "  " + roundToTwo(0.5 * (slider_turb.value / 100 + 1) * slider_water.value) + " W";
    water.volume = slider_water.value / 100;
    turbine.volume = (roundToTwo(0.5 * (slider_turb.value / 100 + 1) * slider_water.value)) / 400;
        default_sequence();

        if (slider_water.value > 0 && (fill_level < 40 || fill_level2 < 181 || fill_level3 < 30)) {

            // FIRST PART OF ANIMATION   
            setIntervalX(fill_water1, 1000 / slider_water.value, 41 / slider_water.value);

            //SECOND PART OF ANIMATION
            setIntervalX(fill_water2, 1000 / slider_water.value, 182 / slider_water.value);

            //THIRD PART OF ANIMATION
            setIntervalX(fill_water3, 1000 / slider_water.value, 212 / slider_water.value);

        } else {
            var poly_turbine_chanlow = [40, 200, 40, 250 + 2 + slider_turb.value / 2, -220, 500 + slider_turb.value / 2, -180, 500 + slider_turb.value / 2, 81, 250 + 2 + slider_turb.value / 2, 81, 200];
            var poly_turbine_body = [50, 100, 50, 250 + slider_turb.value / 2, 70, 250 + slider_turb.value / 2, 70, 100];
            draw_polygon(poly_linker, '#116', '#000', true, true, true);
            draw_polygon(poly_upper_valve, '#000', '#000', true, true, true);
            draw_polygon(poly_water, '#116', '#100', true, true, false);
            draw_polygon(poly_turbine_chanlow, '#116', '#000', true, true, true);
            draw_polygon(poly_turbine_body, '#666', '#000', true, true, true);
            draw_polygon(poly_turbine_uppertop, '#000', '#000', false, true, true);
            draw_polygon(poly_turbine_lowertop, '#000', '#000', false, true, true);
        }

        if (slider_water.value <= 0) {
            default_sequence();
            draw_polygon(poly_linker, '#116', '#000', true, true, true);
            draw_polygon(poly_upper_valve, '#000', '#000', true, true, true);
            draw_polygon(poly_turbine_chanlow, '#FFF', '#000', true, false, true);
            draw_polygon(poly_turbine_body, '#666', '#000', true, true, true);
            draw_polygon(poly_turbine_uppertop, '#000', '#000', false, true, true);
            draw_polygon(poly_turbine_lowertop, '#000', '#000', false, true, true);
        }
};

slider_turb.oninput = function() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    output_range.innerHTML = "  " + roundToTwo(1 + slider_turb.value / 100) + " m";
    water.volume = slider_water.value / 100;
    turbine.volume = (roundToTwo(0.5 * (slider_turb.value / 100 + 1) * slider_water.value)) / 400;
    output_lvl.innerHTML = "  " + roundToTwo(slider_water.value) + " L/s";
    generated_power.innerHTML = "  " + roundToTwo(0.5 * (slider_turb.value / 100 + 1) * slider_water.value) + " W";
        default_sequence();
        if (slider_water.value > 0) {
            var poly_turbine_chanlow = [40, 200, 40, 250 + 2 + slider_turb.value / 2, -220, 500 + slider_turb.value / 2, -180, 500 + slider_turb.value / 2, 81, 250 + 2 + slider_turb.value / 2, 81, 200];
            var poly_turbine_body = [50, 100, 50, 250 + slider_turb.value / 2, 70, 250 + slider_turb.value / 2, 70, 100];
            draw_polygon(poly_linker, '#116', '#000', true, true, true);
            draw_polygon(poly_upper_valve, '#000', '#000', true, true, true);
            draw_polygon(poly_turbine_chanlow, '#116', '#000', true, true, true);
            draw_polygon(poly_water, '#116', '#100', true, true, false);
            draw_polygon(poly_turbine_body, '#666', '#000', true, true, true);
            draw_polygon(poly_turbine_uppertop, '#000', '#000', false, true, true);
            draw_polygon(poly_turbine_lowertop, '#000', '#000', false, true, true);
        } else {
            var poly_turbine_chanlow = [40, 200, 40, 250 + 2 + slider_turb.value / 2, -220, 500 + slider_turb.value / 2, -180, 500 + slider_turb.value / 2, 81, 250 + 2 + slider_turb.value / 2, 81, 200];
            var poly_turbine_body = [50, 100, 50, 250 + slider_turb.value / 2, 70, 250 + slider_turb.value / 2, 70, 100];
            draw_polygon(poly_linker, '#116', '#000', true, true, true);
            draw_polygon(poly_upper_valve, '#000', '#000', true, true, true);
            draw_polygon(poly_turbine_body, '#666', '#000', true, true, true);
            draw_polygon(poly_turbine_uppertop, '#000', '#000', false, true, true);
            draw_polygon(poly_turbine_lowertop, '#000', '#000', false, true, true);
        }
};

output_lvl.innerHTML = "  " + roundToTwo(slider_water.value) + " L/s";
output_range.innerHTML = "  " + roundToTwo(1 + slider_turb.value / 100) + " m";
generated_power.innerHTML = "  " + roundToTwo(0.5 * (slider_turb.value / 100 + 1) * slider_water.value) + " W";
water.volume = slider_water.value / 100;
turbine.volume = (roundToTwo(0.5 * (slider_turb.value / 100 + 1) * slider_water.value)) / 400;
ctx.canvas.width = 2 * SCALE * 1200;
ctx.canvas.height = 2 * SCALE * 450;
ctx.translate(200 * (SCALE * 2) - BIAS_X, 100 * (SCALE * 2) - BIAS_Y);
ctx.drawImage(img, 0, 0, 1202 * 2 * SCALE, 452 * 2 * SCALE);
button_view1.setAttribute('disabled', true);
default_sequence();
document.getElementById("image_description").src = "./resources/images/default.jpg";
document.getElementById("description_title").innerHTML = "<h2> Click on an element to get its description </h2>";
document.getElementById("description_text").innerHTML = "";