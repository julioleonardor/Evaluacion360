var tabla;
var id_userx = $('#id_userx').val();

function init(){
    $("#usueva_form").on("submit",function(e){
        evaluar(e);	
    });
}

$(document).ready(function(){
    tabla=$('#usueva_data').dataTable({
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',   
		            'csvHtml5',
		            'pdf'
		        ],
        "ajax":{
            url: '../../controller/competenciaController.php?op=competencia_evaluar',
            type : "get",
            dataType : "json",
            error: function(e){
                console.log(e.responseText);
            }
        },
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 15,//Por cada 10 registros hace una paginación
	    "order": [[ 0, "asc" ]],//Ordenar (columna,orden)
	    "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
		}
	}).DataTable();
});

/* function evaluar(id_com)
{
    window.open('../UsuRespuesta/index.php?id_com='+ id_com +'','_self')
}
 */

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



