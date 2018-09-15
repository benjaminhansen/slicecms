function messageTimer() {
    var alert = $(".slicecms-alert");
    if(alert.length) {
        var classlist = alert.attr("class").split(' ');
        for(var x = 0; x < classlist.length; x++){
            if(classlist[x].indexOf("-timeout-") > -1) {
                var parts = classlist[x].split("-");
                var end = parts.length - 1;
                var ms = parts[end];

                setTimeout(function(){
                    alert.fadeOut(function(){
                        $(this).remove();
                    });
                }, ms);
            }
        }
    }
}

function showMessage(typeid, message, timeout) {
    var area = $('.msg-area');
    var timeout_ms = timeout * 1000;
    area.empty();

    switch(typeid) {
        case 1:
            var theclass = "success";
            break;
        case 2:
            var theclass = "warning";
            break;
        case 3:
            var theclass = "danger";
            break;
        default:
            var theclass = "info";
    }

    if(timeout == 0) {
        var timeoutclasses = "slicecms-alert";
    } else {
        var timeoutclasses = "slicecms-alert slicecms-alert-timeout-" + timeout_ms;
    }

    var html = "<div class='alert alert-"+theclass+" "+timeoutclasses+"'>"+message+"</div>";

    area.html(html);
    messageTimer();
}

$(document).ready(function(){
    messageTimer();
});
