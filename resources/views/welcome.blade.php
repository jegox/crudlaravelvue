<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css')}} ">
    <link rel="stylesheet" href="{{ asset('/css/toastr.min.css')}} ">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <style>
        .bg-menu{background-color: #34495e}
        .navbar-light .navbar-brand, .navbar-light .navbar-nav .active>.nav-link{color: #fff}
        .navbar-light .navbar-nav .nav-link{color: #fff}
        .form-check-input{margin-left: 0px;}
    </style>
</head>
<body style="background-color: #ecf0f1">
    @include('menu')
    <div class="container-fluid">
        <div id="dir" class="col-12 col-sm-11 mt-3 mx-auto">
            <div class="row">
                <div class="col">
                    <h3 class="gray">
                        Contactos
                        <span data-toggle="tooltip" data-placement="right" title="Agregar Contacto">
                            <button type="button" v-on:click="toggleForm" class="btn btn-green btn-sm" data-toggle="" data-target="#formadd" id="btntoggle" aria-expanded="false" aria-controls="formadd">
                                <i class="fas fa-plus" aria-hidden="true"></i>
                            </button>
                        </span>
                    </h3>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="collapse" id="formadd">
                            <!-- formulario de almacenar contacto -->
                            <form method="POST" v-show="update" v-on:submit.prevent="storeDirectory" id="adddirectory" class="p-4" action="{{ route('directory.store') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="form-group col-3">
                                        <label>Nombre completo</label>
                                        <input type="text" class="form-control" name="fullname" required>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Telefono</label>
                                        <input type="text" class="form-control" name="phone" required>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Correo</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Dirección</label>
                                        <input type="text" class="form-control" name="address" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" class="btn btn-primary" value="Registrar Contacto">
                                    </div>
                                </div>
                            </form>
                            <!-- formulario para actualizar contacto-->
                            <form method="POST" v-show="!update" v-on:submit.prevent="updateDirectory" id="updatedirectory" class="p-4" action="{{ route('directory.index') }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" v-bind:value="edit.id" id="ida">
                                <div class="row">
                                    <div class="form-group col-3">
                                        <label>Nombre completo</label>
                                        <input type="text" class="form-control" v-model="edit.fullname" name="fullname" required>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Telefono</label>
                                        <input type="text" class="form-control" v-model="edit.phone" name="phone" required>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Correo</label>
                                        <input type="email" class="form-control" v-model="edit.email" name="email" required>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Dirección</label>
                                        <input type="text" class="form-control" v-model="edit.address" name="address" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" class="btn btn-success" value="Actualizar Contacto">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-green">
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Nombre completo</th>
                                        <th>Telefono</th>
                                        <th>Correo</th>
                                        <th>Dirección</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="{{ route('directory.destroy', '') }}" id="destroy" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                    @verbatim
                                    <template v-for="a in directory">
                                        <tr>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button type="button" class="btn btn-primary" v-on:click="showDirectory(a)"><i class="fas fa-pencil-alt"></i></button>
                                                    <button type="button" v-on:click="deleteDirectory(a)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                </div>
                                            </td>
                                            <td>{{ a.fullname }}</td>
                                            <td>{{ a.phone }}</td>
                                            <td>{{ a.email }}</td>
                                            <td>{{ a.address }}</td>
                                        </tr>
                                    </template>
                                    @endverbatim
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/jquery.min.js')}} "></script>
    <script src="{{ asset('/js/popper.min.js')}} "></script>
    <script src="{{ asset('/js/bootstrap.min.js')}} "></script>
    <script src="{{ asset('/js/bootbox.min.js')}} "></script>
    <script src="{{ asset('/js/toastr.min.js')}} "></script>
    <script src="{{ asset('/js/vue.min.js')}} "></script>
    <script src="{{ asset('/js/axios.min.js')}} "></script>
    <script src="{{ asset('/js/directory.js')}} "></script>
    <script>$(function(){ $('[data-toggle="tooltip"]').tooltip() })</script>
</body>
</html>
