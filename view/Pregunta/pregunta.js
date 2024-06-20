var tabla;

function init(){
    $("#pregunta_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

$(document).ready(function(){

    tabla=$('#pregunta_data').dataTable({
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
            url: '../../controller/preguntaController.php?op=listar',
            type : "get",
            dataType : "json",
            error: function(e){
                console.log(e.responseText);	
            }
        },
		"bDestroy": true,
		"responsive": false,
		"bInfo":true,
		"iDisplayLength": 15,//Por cada 10 registros hace una paginación
	    "order": [[ 0, "asc" ]],//Ordenar (columna,orden)
        "scrollY":        false,
        "scrollX":        true,
        "scrollCollapse": true,   
        "fixedColumns":   true,
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

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#pregunta_form")[0]);
    $.ajax({
        url: "../../controller/preguntaController.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){

            $('#pregunta_form')[0].reset();
            $("#preguntamantenimiento").modal('hide');
            $('#pregunta_data').DataTable().ajax.reload();

            swal.fire(
                'Registro!',
                'El registro correctamente.',
                'success'
            )
        }
    });
}

function editar(id_preg){
    $.post("../../controller/preguntaController.php?op=mostrar",{id_preg:id_preg},function (data) {
        data = JSON.parse(data);
        $('#id_preg').val(data.id_preg);
        $('#pregunta').val(data.pregunta);
    });
    $('#mdltitulo').html('Editar Registro');
    $('#preguntamantenimiento').modal('show');
}

function eliminar(id_preg){
    swal.fire({
        title: 'Pregunta',
        text: "Desea Eliminar el Registro?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            $.post("../../controller/preguntaController.php?op=eliminar",{id_preg:id_preg},function (data) {

            });

            $('#pregunta_data').DataTable().ajax.reload();	

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
    })
}

$(document).on("click","#btnnuevo", function(){
    $('#id_preg').val('');
    $('#pregunta').val('');

    $('#mdltitulo').html('Nuevo Registro');
    $('#preguntamantenimiento').modal('show');
});

init();