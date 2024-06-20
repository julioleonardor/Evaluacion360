var id_user = $('#id_userx').val();


$(document).ready(function(){
    $.post("../../controller/usuarioController.php?op=mostrar", { id_user : id_user }, function (data) {
        data = JSON.parse(data);
        $('#codigo_user').val(data.codigo_user);
        $('#name_user').val(data.name_user);
        $('#email_user').val(data.email_user);
        $('#name_dep').val(data.name_dep);
        $('#cargo_user').val(data.cargo_user);
        $('#name_wl').val(data.name_wl);
        $('#supervisor_user').val(data.supervisor_user);
    });
});


$(document).on("click","#btnactualizar", function(){

    $.post("../../controller/usuarioController.php?op=update_perfil",{
        id_user : id_user,
        pass_user : $('#pass_user').val()},
        function (data) {        
    });

    Swal.fire({
        title: 'Correcto!',
        text: 'Se actualizo Correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    })
});