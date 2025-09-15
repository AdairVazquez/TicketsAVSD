<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
{{-- CREAR ROL MODAL --}}
<div id="miModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear rol nuevo</h5> <button type="button" class="close"
                    data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" id="nuevo-rol">
                    <div class="row">
                        <div class="col-md-6"> 
                            <label for="">Nombre del rol</label> 
                            <input class="form-control " type="text" name="nombre" id="nombreUs"> </div>

            </div>
            <div class="modal-footer"> <input type="submit" value="Registrar" class="btn btn-success"> <button
                    type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> </div>
            </form>
        </div>
    </div>
</div>
