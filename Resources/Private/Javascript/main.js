$(document).ready(function() {
    var hasTriggered = false;
    var lastY = -1;
    var trigger = function(e) {
        if (hasTriggered || e.pageY >= lastY) {
            lastY = e.pageY;

            return;
        }

        var date = new Date();

        date.setTime(date.getTime() + expop.expires * 86400000);

        document.cookie = expop.name + '=true; expires=' + date.toUTCString() + '; path=/';

        $(expop.target).modal('show');

        hasTriggered = true;
    };

    $(document).on('mouseleave', trigger);
});