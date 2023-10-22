<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAlta">
                    Añadir usuarios
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover dt-responsive" id="table_id">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>usuario</th>
                            <th>foto</th>
                            <th>perfil</th>
                            <th>estado</th>
                            <th>Ultimo acceso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($users as $key => $user) {
                            // var_dump($user);
                        ?>
                            <tr>
                                <td scope="row"><?= $user['id'] ?></td>
                                <td><?= $user['nombre'] ?></td>
                                <td><?= $user['usuario'] ?></td>
                                <td>
                                    <img style="height: 2em;" src="views/dist/img/users/<?= $user['foto'] ?>">
                                </td>
                                <td><?= $user['perfil'] ?></td>
                                <td><?php
                                    if ($user['estado']) {
                                    ?>
                                        <a href="activar&id=<?= $user['id'] ?>" type="button" class="btn btn-success btn-sm" id="btnActivar" idUsuario="<?= $user['id'] ?>" estadoUsuario="<?= $user['estado'] ?>">Activo</a>
                                    <?php

                                    } else {
                                    ?>
                                        <a href="activar&id=<?= $user['id'] ?>" type="button" class="btn btn-danger btn-sm" id="btnActivar" idUsuario="<?= $user['id'] ?>" estadoUsuario="<?= $user['estado'] ?>">Desactivado</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td><?= $user['ultimo_login'] ?></td>

                                <td>
                                    <button type="button" class="btn btn-info btnEditarUsuario" idUsuario="<?= $user['id'] ?>" data-toggle="modal" data-target="#modalEditUsuario"><i class="fas fa-user-edit"></i></button>
                                    <button type="button" class="btn btn-danger "><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        <?php
                        }

                        ?>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <!-- Footer -->
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<!-- Ventana modal con el formulario de alta -->
<div class="modal fade" id="modalAlta">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" action="" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Añadir usuarios</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="nuevoNombre" class="form-control" placeholder="Introduce el nombre" require="">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="text" name="nuevoUsuario" class="form-control" placeholder="Introduce el usuario" require="">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="text" name="nuevoPassword" class="form-control" placeholder="Introduce el password" require="">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                        </div>
                        <select name="nuevoPerfil" class="form-control">
                            <option value="">Seleccionar perfil</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Especial">Especial</option>
                            <option value="Vendedor">Vendedor</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <p>
                            <label for="">Subir imagen</label>
                            <input type="file" name="nuevaFoto" class="nuevaFoto" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Tamaño maximo 2Mb</small>
                        </p>
                        <img style="height: 250px;" src="views/dist/img/users/default.png" alt="" class="thumbnail previsualizar">

                    </div>

                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar </button>
                    <button onclick="form.submit()" type="button" class="btn btn-primary">Guardar Usuario</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modalEditUsuario">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" action="" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Editar usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="editNombre" id="editNombre" class="form-control" placeholder="Introduce el nombre" require="">
                        <input type="hidden" name="hideNombre" id="hideNombre" class="form-control" placeholder="Introduce el nombre" require="">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="text" name="editUsuario" id="editUsuario" class="form-control" placeholder="Introduce el usuario" require="" readonly>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" name="editPassword" id="editPassword" class="form-control" placeholder="Introduce el password" require="">
                        <input type="hidden" name="passwordActual" id="passwordActual" class="form-control" placeholder="Introduce el password" require="">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                        </div>
                        <select name="editPerfil" class="form-control">
                            <option value="" id="editarPerfil">Seleccionar perfil</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Especial">Especial</option>
                            <option value="Vendedor">Vendedor</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <p>
                            <label for="">Subir imagen</label>
                            <input type="file" class="nuevaFoto" name="editarFoto">
                            <input type="hidden" name="fotoActual" id="fotoActual">
                            <small id="helpId" class="text-muted">Tamaño maximo 2Mb</small>
                        </p>
                        <img style="height: 250px;" src="views/dist/img/users/default.png" alt="" class="thumbnail previsualizar">

                    </div>

                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar </button>
                    <button onclick="form.submit()" type="button" class="btn btn-info">Guardar cambios</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->