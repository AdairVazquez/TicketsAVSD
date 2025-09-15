$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if ($('#listaUsu').length) {
        obtenerListUsu();
    }else if($('#listaRoles').length) {
        obtenerListRol();
    }
    $(document).on('click', '.page-link', function (e) {
        e.preventDefault();
        let page = $(this).data('page');
        obtenerListUsu(page); // Carga la página seleccionada
    });
    //##### CRUD USUARIO #####
    //crear nuevo usuario
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
                obtenerListUsu();
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
    //lista de ususarios con paginacion
    function obtenerListUsu(page = 1) {
        $.ajax({
            url: listUserUrl + '?page=' + page,
            type: 'GET',
            success: function (response) {
                let usuarios = response.data;
                let lista = '';

                usuarios.forEach(usuario => {
                    lista += `
                    <tr>
                        <td>${usuario.id}</td>
                        <td>${usuario.nombre}</td>
                        <td>${usuario.email}</td>
                        <td>${usuario.rol}</td>
                        <td>
                            <button class="editUsu btn btn-primary btn-sm" data-id="${usuario.id}">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                        <td>
                            <button class="deleteUsu btn btn-danger btn-sm" data-id="${usuario.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                });

                $("#listaUsu").html(lista);

                // Crear paginación
                let pagination = '';
                if (response.last_page > 1) {
                    for (let i = 1; i <= response.last_page; i++) {
                        pagination += `
                        <li class="page-item ${i === response.current_page ? 'active' : ''}">
                            <a class="page-link" href="#" data-page="${i}">${i}</a>
                        </li>
                    `;
                    }
                }
                $("#paginacion").html(pagination);
            }
        });
    }
    //consulta de solo un usuario y llenado modal de edicion
    window.obtenerUsu = function (id) {
        let url = obtUser.replace(':id', id);

        $.ajax({
            url: url,
            type: 'GET',
            success: function (usuario) {
                // Llenar campos 
                console.log(usuario);
                $('#usuarioIdEdit').val(usuario.id);
                $('#nombreUsEdit').val(usuario.nombre);
                $('#emailEdit').val(usuario.email);
                $('#passEdit').val('');         // siempre vacío
                $('#passConfEdit').val('');
                $('#rolEdit').val(usuario.rol);

                // Mostrar modal
                $('#actUs').modal('show');
            },
            error: function (err) {
                console.error('Error al obtener usuario:', err);
            }
        });
    };

    //editar usuarios
    $('#editar-usuario').submit(function (e) {
        e.preventDefault();

        let url = editUserUrl.replace(':id', $('#usuarioIdEdit').val());
        const postData = {
            nombre: $('#nombreUsEdit').val(),
            email: $('#emailEdit').val(),
            pass: $('#passEdit').val(),
            pass_confirmation: $('#passConfEdit').val(),
            rol: $('#rolEdit').val()
        };
        console.log(postData);

        $.post(url, postData, function (response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: '¡Usuario actualizado!',
                    text: response.message,
                    confirmButtonText: 'OK',
                    timer: 2500,
                    timerProgressBar: true
                });

                $('#editar-usuario')[0].reset();
                $('#actUs').modal('hide');
                obtenerListUsu();
            }
        }).fail(function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Hubo un error al editar el usuario',
                confirmButtonText: 'Entendido'
            });
            console.error(xhr.responseJSON);
        });
    });
    //eliminar usuario
    $(document).on('click', '.deleteUsu', function () {
        let id = $(this).data('id');
        let url = deleteUserUrl.replace(':id', id);
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33', // rojo
            cancelButtonColor: '#3085d6', // azul
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Llamada AJAX para eliminar el usuario
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.fire(
                            '¡Eliminado!',
                            'El usuario ha sido eliminado.',
                            'success'
                        );
                        obtenerListUsu();
                    },
                    error: function (err) {
                        Swal.fire(
                            'Error',
                            'No se pudo eliminar el usuario.',
                            'error'
                        );
                    }
                });
            }
        });
    });

    // ###################################

    //##### CRUD ROLES DE USUARIO #####
    //lista de roles con paginacion
    function obtenerListRol(page = 1) {
        $.ajax({
            url: listRolUrl + '?page=' + page,
            type: 'GET',
            success: function (response) {
                let roles = response.data;
                let lista = '';

                roles.forEach(rol => {
                    lista += `
                    <tr>
                        <td>${rol.id}</td>
                        <td>${rol.nombre_rol}</td>
                        <td>
                            <button class="editRol btn btn-primary btn-sm" data-id="${rol.id}">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                        <td>
                            <button class="deleteUsu btn btn-danger btn-sm" data-id="${rol.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                });

                $("#listaRoles").html(lista);

                // Crear paginación
                let pagination = '';
                if (response.last_page > 1) {
                    for (let i = 1; i <= response.last_page; i++) {
                        pagination += `
                        <li class="page-item ${i === response.current_page ? 'active' : ''}">
                            <a class="page-link" href="#" data-page="${i}">${i}</a>
                        </li>
                    `;
                    }
                }
                $("#paginacion").html(pagination);
            }
        });
    }


})