<?php

//ruta del index de la app
Route::get('/', function () {
    return view('welcome');
});
//rutas para hacer interaccion con la bd
//solo con las rutas => directory.index, directory.store, directory.update, directory.delete
Route::resource('/directory', 'DirectoryController', ['except' => [ 'create', 'show', 'edit' ] ]);
