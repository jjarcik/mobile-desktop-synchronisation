$(document).ready(function () {
    var log = $("#server");
    var items = [];

    var evtSource = new EventSource("server.php");
    console.log("SSE connection started");
    evtSource.addEventListener("msg", function (e) {                
        var obj = JSON.parse(e.data);                                 
        $.each(obj.data, function(){
            
            if (!items[$(this)[0].time]){
                items[$(this)[0].time] = 1;
                createFirework($(this)[0]);
                console.log($(this));
            }
            
            
        });                                    
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
       }); 
    });
    
    $("#clearbutton").on("click", function(){
       $.ajax({
           url:"cleardata.php"           
       }); 
    });
    
    
        
});

function createFirework(data){
    var $div = $("<div>");
    $div.css({left:data.x,top:data.y});
    $div.append("<span class='s1'/>");
    $div.append("<span class='s2'/>");
    $div.append("<span class='s3'/>");
    $div.appendTo($("#fireworks"));
}
