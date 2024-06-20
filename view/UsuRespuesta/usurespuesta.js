/* Llamar variable global que funcione, este es el codigo correcto */
/* var id_dep = $('#id_dep_userx').val();
 */

 
/* function init() {
  $("#respuesta_form").on("submit", function () {
    guardaryeditar(e);
  });
}  */

$(document).ready(function () {
  
   var id_com = getUrlParameter("id_com"); 

    $.post(
    "../../controller/competenciaController.php?op=mostrar",
    { id_com: id_com },
    function (data) {
      data = JSON.parse(data); 
      $("#id_com").html(data.id_com);
      $("#name_com").html(data.name_com);

      
    }
    );
});

function myFunction(){
  var id_com = getUrlParameter("id_com"); 

  console.log(id_com);
  guardaryeditar();
   
}

var getUrlParameter = function getUrlParameter(sParam) {
  var sPageURL = decodeURIComponent(window.location.search.substring(1)),
    sURLVariables = sPageURL.split("&"),
    sParameterName,
    i;

  for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split("=");

    if (sParameterName[0] === sParam) {
      return sParameterName[1] === undefined ? true : sParameterName[1];
    }
  }
};

function evaluar(id_com) {
  // Realizar una solicitud AJAX al archivo PHP que verifica si hay registros en la tabla "respuesta"
  $.ajax({
      url: 'prueba.php',
      type: 'POST',
      data: {
          id_com: id_com,
          id_userx: id_userx
      },
      success: function(response) {
          if (response > 0) {
              // Si hay registros, mostrar un mensaje de alerta y no permitir el acceso a la página "UsuRespuesta"
              alert('Evaluación realizada');
          } else {
              // Si no hay registros, redirigir al usuario a la página "UsuRespuesta"
              window.open('../UsuRespuesta/index.php?id_com=' + id_com, '_self');
          }
      }
  });
}

/* function getFormData($form){
  var unindexed_array = $form.serializeArray();
  var indexed_array = {};

  $.map(unindexed_array, function(n, i){
      indexed_array[n['name']] = n['value'];
  });

  return indexed_array;
} */




