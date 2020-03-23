$(document).ready(function() {
    var hasTriggered = false;
    var lastY = -1;
    var move = function(e) {
        if (hasTriggered || e.pageY > lastY || e.pageY > expop.sensitivity + $(this).scrollTop()) {
            lastY = e.pageY;

            return;
        }

        var date = new Date();

        date.setTime(date.getTime() + expop.expires * 86400000);

        document.cookie = expop.name + '=true; expires=' + date.toUTCString() + '; path=/';

        $(expop.target).modal('show');

        hasTriggered = true;
    };

    $(document).on('mousemove', move);
});