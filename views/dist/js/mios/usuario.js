//codigo para previsualizar imagen
$(".nuevaFoto").change(function () {
    var imagen = this.files[0];
    // console.log("imagen", imagen);
    if (imagen['type'] != "image/jpeg" && imagen["type"] != "image/png") {
        $(".nuevaFoto").val("");
        Swal.fire({
            title: 'La imagen debe estar en formato .png o .jpg!',
            icon: 'error',
            confirmButtonText: 'Cerrar'
        });
    } else if (imagen['size'] > 2000000) {
        $(".nuevaFoto").val("");

        Swal.fire({
            title: 'La imagen no debe pesar mas de 2Mb!',
            icon: 'error',
            confirmButtonText: 'Cerrar'
        });
    } else {
        var datosImg = new FileReader;
        datosImg.readAsDataURL(imagen);

        $(datosImg).on("load", function (event) {
            var rutaImg = event.target.result;

            $(".previsualizar").attr("src", rutaImg);
        })
    }
});

//Auto carga de usuarios para editar

$(document).on("click", ".btnEditarUsuario", function () {
    var idUsuario = $(this).attr("idUsuario");
    // console.log(idUsuario);

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({

        url: "views/ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            $("#editNombre").val(respuesta.nombre);
            $("#hideNombre").val(respuesta.nombre);
            $("#editUsuario").val(respuesta.usuario);
            $("#editarPerfil").html(respuesta.perfil);
            $("#passwordActual").val(respuesta.password);
            $(".previsualizar").attr("src", "views/dist/img/users/" + respuesta.foto)
            $("#fotoActual").val(respuesta.foto);
        }

    });

})

//Activar desactivar usuarios
$(document).on('click', '#btnActivar', function () {
    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);
    datos.append("estadoUsuario", estadoUsuario);


    console.log(idUsuario + " " + estadoUsuario);
    $.ajax({
        url: "views/ajax/activar.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
        },
        error: function (err) {
            console.log(err);
        }
    })
});