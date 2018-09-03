$(document).ready(function () {
    var log = $("#server");

    var evtSource = new EventSource("server.php");
    console.log("SSE connection started");


    evtSource.addEventListener("msg", function (e) {        
        
        
         var obj = JSON.parse(e.data);
         console.log(obj.data);
         log.prepend(obj.data + "<br />");
         /*
         if (obj.data == "success") {
         $("#main").fadeOut(1500, function () {
         })();
         }
         
         if (obj.data2 && obj.data3) {
         if (obj.data2 != lastx && obj.data3 != lasty) {
         $("<div class='bomba'></div>").css("left", obj.data2 + "%").css("top", obj.data3 + "%").prependTo("body");
         lastx = obj.data2;
         lasty = obj.data3;
         }
         $("body").prepend(obj.data);
         }
         */
    }, false);

    evtSource.onerror = function (e) {
        if (e.readyState === EventSource.CLOSED) {
            console.log("connection closed");
        } else {
            console.log(e);
        }
               
        evtSource.close();

    };

    $(window).unload(function () {        
        evtSource.close();
    });
    
    $("#firebutton").on("click", function(){
       $.ajax({
           url:"pushdata.php"           
       }) 
    });

});
