    var testoIngresso = document.getElementById("ingresso");
    var testoUscita = document.getElementById("uscita");
    var testoVel = document.getElementById("speedvalue");
    var testoRuota = document.getElementById("wheelvalue");
    var canvas = document.getElementById('Steer');
    var ctx = canvas.getContext('2d');
    var image = document.getElementById('source');
    ctx.translate(100, 100);
    ctx.drawImage(image, -80, -80);
    var SpeedLevel = 0;
    var WheelPos = 0;
    var olderpos = 0;
    var ingresso = new Array();
    var ingresso3 = new Array();
    var uscita = new Array();
    var uscita3 = new Array();
    var i = 0;
    var exampleSocket = new WebSocket("wss://echo.websocket.org");
    stack = new Array();
    var head_pointer = 0;
    var connected = 0;
    var istante_ricezione;
    var sampling_time = 300;
    var dead_line_counter = 0;
    var dead_line_counter2 = 0;
    var treshold = 2;
    var reference = 0;
    /* Il nostro messaggio, ospiter� tanti placeholder quanti sono i comandi che saranno inviati (direzione, velocit�, bussola, se ti va persino coordinate geografiche da far vedere)*/
    /* Il "bello" � che ognuno potr� ospitare un algoritmo di controllo diverso, possiamo persino renderle interdipendenti con un filtro di Kalmann ! */

    var Data_Controller = {
        AccX: 0,
        AccY: 0, 
        AccZ: 0,
        AngX: 0,
        AngY: 0,
        AngZ: 0,
        Press: 0,
        Temp: 0,
        WheelPos: 0,
        ThrottlePos: 0,
        Speed: 0,
        Timestamp: 0
    };

    console.log("JSON: " + JSON.stringify(Data_Controller));

    slidebar.onchange = function() {
        SpeedLevel = this.value;
        testoVel.innerHTML = SpeedLevel;
        dead_line_counter = 0;
    };

    slidebar3.onchange = function() {
        WheelPos = this.value;
        angle = (WheelPos - 50) * 90 / 50;
        testoRuota.innerHTML = angle;
        ctx.rotate((angle - olderpos) * Math.PI / 180);
        ctx.drawImage(image, -80, -80);
        olderpos = angle;
        dead_line_counter2 = 0;
    };

    function wait(ms) {
        var start = new Date().getTime();
        var end = start;
        while (end < start + ms) {
            end = new Date().getTime();
        }
    }


    /* Questo d� il via libera per l'invio dei pacchetti */
    exampleSocket.onopen = function(event) {
        connected = 1;
    };


    /* Quando i paccketti arrivano, vengono messi nello stack, il tempo di arrivo pu� essere irregolare a causa del ping che cambia */
    exampleSocket.onmessage = function(event) {
        console.log("Ricevuto: " + event.data);
        received = JSON.parse(event.data);
        Data_Controller = JSON.parse(event.data);
    };

    /* update viene interrogato ad intervalli regolari, per cui il flusso dei pacchetti viene effettivamente regolarizzato */

    function update() {
        var latency = 0;
        var total_num = 0;
        var total_num3 = 0;
 
        if (typeof received === 'undefined') {
            console.log("Waiting for connection...");
        } else {
            total_num = received.Speed;
            total_num3 = received.WheelPos;
        }
	wait(100 + Math.floor(Math.random() * 110));
        latency = Date.now() - Data_Controller.Timestamp;
        console.log("Ora: " + Date.now() + " Ricevuto: " + Data_Controller.Timestamp);
        console.log("///////////// Latency: " + latency);
        var del = Math.floor(latency / (sampling_time));

        console.log("///////////// Delay: " + del);
        del += 1;
        ingresso[i] = total_num;
        ingresso3[i] = total_num3;
        if (parseInt(head_pointer) >= 0) {
            document.getElementById("available_packets").innerHTML = i;
        }

        if (i - 2 * del >= 0 && !isNaN(del) && i >= 1) {

            var error2 = SpeedLevel - ingresso[i];
            var error5 = WheelPos - ingresso3[i];
            dead_line_counter++;
            dead_line_counter2++;

            if (dead_line_counter < treshold) {
                uscita[i] = (uscita[i - 1] + error2);
            }

            if (dead_line_counter2 < treshold) {
                uscita3[i] = (uscita3[i - 1] + error5);
            }

            if (isNaN(uscita[i])) {
                uscita[i] = uscita[i - 1];
            }
            if (isNaN(uscita3[i])) {
                uscita3[i] = uscita3[i - 1];
            }
        }

        /*Controllo gli indici, per definizione nella trasformata z i campioni negativi sono nulli */
        else {
            uscita[i] = 0;
            uscita3[i] = 0;
        }

        /* Imposto il pacchetto Data_Controller */
        Data_Controller.Speed = Math.round(uscita[i] * 10000) / 10000;
        Data_Controller.WheelPos = Math.round(uscita3[i] * 10000) / 10000;
        Data_Controller.Timestamp = Date.now();

        if (connected !== 0) {
            console.log("Inviato alla macchinina:" + JSON.stringify(Data_Controller));
            exampleSocket.send(JSON.stringify(Data_Controller));
        }

        /* Queste righe mostrano a video i campioni acquisiti */
        testoIngresso.innerHTML = "<table border=&quot;1&quot><tr> <th>AccX</th><th>AccY</th><th>AccZ</th><th>AngX</th><th>AngY</th><th>AngZ</th><th>Pressure</th><th>Temperature</th><th>Steer angle</th><th> Speed </th><th>Acceleration</th> </tr>" + "<tr><th>" + Data_Controller.AccX + "</th>" + "<th>" + Data_Controller.AccY + "</th>" + "<th>" + Data_Controller.AccZ + "</th>" + "<th>" + Data_Controller.AngX + "</th>" + "<th>" + Data_Controller.AngY + "</th>" + "<th>" + Data_Controller.AngZ + "</th>" + "<th>" + Data_Controller.Press + "</th>" + "<th>" + Data_Controller.Temp + "</th>" + "<th>" + parseFloat((ingresso3[i] - 50) * 90 / 50) + "</th>" + "<th>" + parseFloat(ingresso[i]) + "</th>" + "<th>" + Data_Controller.ThrottlePos + "</th>" + "</tr>" + "</table>";
        testoUscita.innerHTML = "<table border=&quot;1&quot><tr> <th>Speed</th><th>Steer Angle (% from 0 degrees)</th></tr>" + "<tr><th>" + Math.round(Data_Controller.Speed) + "</th>" + "<th>" + Math.round( Data_Controller.WheelPos) + "</tr>" + "</table>";
        /* L'indice i rappresenta i campioni, intervallati fra loro dal tempo di campionamento */
        i++;
    }

    /* Attendo 300ms prima di invire i pacchetti */

    wait(100);
    setInterval(update, sampling_time);