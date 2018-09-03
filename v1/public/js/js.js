var lastx = 0, lasty = 0;
var evtSource = new EventSource("server.php");
var log = $("#server");

$(document).ready(function(){
           
    evtSource.addEventListener("ping", function(e) {
                
        var obj = JSON.parse(e.data);
        
        log.prepend(obj.data + "<br />");
        
        if (obj.data == "success"){
            $("#main").fadeOut(1500, function(){                
            })();
        }
       
        if (obj.data2 && obj.data3){
            if (obj.data2 != lastx && obj.data3 != lasty){
                $("<div class='bomba'></div>").css("left", obj.data2 + "%").css("top", obj.data3 + "%").prependTo("body");
                lastx = obj.data2;
                lasty = obj.data3;                
            }
            $("body").prepend(obj.data);
        }
                
    }, false);
        
    evtSource.onerror = function(e) {
        console.log("please reload the page");
        evtSource.close();
    
    };                    
        
});

$( window ).unload(function() {
  console.log("event source close");
    evtSource.close();
});