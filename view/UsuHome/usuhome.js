

$(document).ready(function() {
    setInterval(function() {
      $.getJSON("home.php", function(data) {
        $("#progress-bar").css("width", data.percent_complete + '%');
        $("#total_porcentaje").html(data.percent_complete + ' %');
      });
    }, 1000); // Update every second
  });