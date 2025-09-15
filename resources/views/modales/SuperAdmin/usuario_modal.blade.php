<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head> {{-- CREAR USUARIO MODAL --}} <div id="miModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear usuario nuevo</h5> <button type="button" class="close"
                    data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" id="nuevo-usuario">
                    <div class="row">
                        <div class="col-md-6"> <label for="">Nombre completo</label> <input
                                class="form-control " type="text" name="nombre" id="nombreUs"> </div>
                        <div class="col-md-6"> <label for="">Correo electronico</label> <input
                                class="form-control" type="text" name="email" id="email"> </div>
                        <div class="col-md-6 mt-3"> <label for="">Contraseña</label> <input class="form-control"
                                type="password" name="pass" id="pass"> </div>
                        <div class="col-md-6 mt-3"> <label for="">Confirma la contraseña</label> <input
                                class="form-control" type="password" name="passConf" id="passConf"> </div>
                        <div class="col-md-12 mt-3"> <label for="">Selecciona el rol</label>
                            <select name="" id="rol" class="form-control"
                                aria-label="Default select example">
                                <option selected>Selecciona el rol</option>
                                <option value="1">Super Administrador</option>
                                <option value="2">Soporte Técnico</option>
                                <option value="3">Cliente</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer"> <input type="submit" value="Registrar" class="btn btn-success"> <button
                    type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> </div>
            </form>
        </div>
    </div>
</div> {{-- ACTUALIZAR USUARIO MODAL --}} <div id="actUs" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar usuario</h5> <button type="button" class="close"
                    data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" id="editar-usuario"> <input type="hidden" id="usuarioIdEdit">
                    <div class="row">
                        <div class="col-md-6"> <label>Nombre completo</label> <input type="text" id="nombreUsEdit"
                                class="form-control" name="nombre"> </div>
                        <div class="col-md-6"> <label>Email</label> <input type="text" id="emailEdit"
                                class="form-control" name="email"> </div>
                        <div class="col-md-6 mt-3"> <label>Contraseña</label> <input type="password" id="passEdit" placeholder="DEJAR EN BLANCO SI NO SE QUIERE CAMBIAR LA CONTRASEÑA"
                                class="form-control" name="pass"> </div>
                        <div class="col-md-6 mt-3"> <label>Confirmar contraseña</label> <input type="password" placeholder="DEJAR EN BLANCO SI NO SE QUIERE CAMBIAR LA CONTRASEÑA"
                                id="passConfEdit" class="form-control" name="pass_confirmation"> </div>
                        <div class="col-md-12 mt-3"> <label>Rol</label> <select id="rolEdit" class="form-control"
                                name="rol">
                                <option value="" disabled>Selecciona el rol</option>
                                <option value="1">Super Usuario</option>
                                <option value="2">Soporte Técnico</option>
                                <option value="3">Cliente</option>
                            </select> </div>
                    </div>
            </div>
            <div class="modal-footer"> <input type="submit" value="Registrar" class="btn btn-success"> <button
                    type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> </div>
            </form>
        </div>
    </div>
</div>
