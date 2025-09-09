$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    console.log('Jquery esta funcionando');

    $('#nuevo-usuario').submit(function (e) {
        e.preventDefault();

        const postData = {
            nombre: $('#nombreUs').val(),
            email: $('#email').val(),
            pass: $('#pass').val(),
            pass_confirmation: $('#passConf').val(),
            rol: $('#rol').val()
        };

        $.post(storeUserUrl, postData, function (response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: '¡Usuario creado!',
                    text: response.message,
                    confirmButtonText: 'OK',
                    timer: 2500,
                    timerProgressBar: true
                });

                $('#nuevo-usuario')[0].reset();
                $('#miModal').modal('hide');
            }
        }).fail(function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Hubo un error al crear el usuario',
                confirmButtonText: 'Entendido'
            });
            console.error(xhr.responseJSON);
        });
    });

    $ajax({
        url: listUserUrl,
        type: 'GET',
        success: function (response) {
            let peticiones = JSON.parse(response)
        }
    })

})