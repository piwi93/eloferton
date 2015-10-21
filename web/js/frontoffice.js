$(document).ready(function() { 
    var c = document.getElementById("restante");
    var ctx = c.getContext("2d");
    var container = $(c).parent();
    ctx.font = "30px Arial";
    ctx.fillStyle = "blue";
    ctx.textAlign = "center";
    var radius = c.height / 2;
    var medium = c.width /2;
    ctx.translate(medium, radius);
    drawDigital();
    setInterval(drawDigital,1000);

    function drawDigital(){
        drawDigitalNumbers(ctx);
    }
    /*
    $(window).resize( respondCanvas );

    function respondCanvas(){ 
        var c = document.getElementById("restante");
        var container = $(c).parent();
        $("#restante").attr('width', $(container).width() ); //max width
        $("#restante").attr('height', $(container).height() ); //max height

        drawDigital()
    }

    respondCanvas();
    /*/
    function drawDigitalNumbers(ctx){
        ctx.font = "25px arial";
        var now = new Date();
        var hour = 23-now.getHours();
        var minute = 59-now.getMinutes();
        var second = 59-now.getSeconds();
        ctx.fillStyle = "blue";
        ctx.clearRect(-600,-600,1000,1000);
        var hora=hour.toString();
        if(hour<10) hora="0"+ hora;
        var minuto=minute.toString();
        if(minute<10) minuto = "0" + minuto;
        var segundo=second.toString();
        if(second<10) segundo= "0" + segundo;
    
     ctx.fillText("Estas ofertas finalizan en "+hora + ":" + minuto+":"+segundo, 0,0);
    }
    
    
})
