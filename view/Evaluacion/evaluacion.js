var tabla;

function init(){
    $("#evaluacion_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

$(document).ready(function(){
    tabla=$('#evaluacion_data').dataTable({
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
            url: '../../controller/evaluacionController.php?op=listar_preguntas',
            type : "get",
            dataType : "json",
            error: function(e){
                console.log(e.responseText);	
            }
        },
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,//Por cada 10 registros hace una paginación
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

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#evaluacion_form")[0]);
    $.ajax({
        url: "../../controller/evaluacionController.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){

            $('#evaluacion_form')[0].reset();
            $("#evaluacionmantenimiento").modal('hide');
            $('#evaluacion_data').DataTable().ajax.reload();

            swal.fire(
                'Registro!',
                'El registro correctamente.',
                'success'
            )
        }
    });
}

function editar(id_eva){
    $.post("../../controller/evaluacionController.php?op=mostrar",{id_eva:id_eva},function (data) {
        data = JSON.parse(data);
        $('#id_eva').val(data.id_eva);
        $('#name_eva').val(data.name_eva);
        $('#description_eva').val(data.description_eva);
        $('#est_eva').val(data.est_eva);
    });
    $('#mdltitulo').html('Editar Registro');
    $('#evaluacionmantenimiento').modal('show');
}

function eliminar(id_eva){
    swal.fire({
        title: 'Evaluacion',
        text: "Desea Eliminar el Registro?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            $.post("../../controller/evaluacionController.php?op=eliminar",{id_eva:id_eva},function (data) {

            });

            $('#evaluacion_data').DataTable().ajax.reload();	

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
    })
}

$(document).on("click","#btnnuevo", function(){
    $('#id_eva').val('');
    $('#name_eva').val('');
    $('#description_eva').val('');
    $('#est_eva').val('');
    $('#mdltitulo').html('Nuevo Registro');
    $('#evaluacionmantenimiento').modal('show');
});

init();