$(document).ready(function(){var t=!1,p=-1;$(document).on("mousemove",function(e){if(t||e.pageY>p||e.pageY>expop.sensitivity)p=e.pageY;else{var o=new Date;o.setTime(o.getTime()+864e5*expop.expires),document.cookie=expop.name+"=true; expires="+o.toUTCString()+"; path=/",$(expop.target).modal("show"),t=!0}})});