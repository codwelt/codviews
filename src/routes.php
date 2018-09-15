<?php
$middleware = '';
if (!is_null(Config::get('codviews.Middleware.web.admin'))) {
    $middleware = Config::get('codviews.Middleware.web.admin');
} else {
    $middleware = [];
}
Route::group(['middleware' => $middleware, 'namespace' => 'Codwelt\codviews\Controllers', 'prefix' => 'codviews'], function () {
    Route::get('/inicio/', ['as' => 'CodviewInicio', 'uses' => 'codviewsconrtoller@index']);
    Route::get('/detalles/{id}', ['as' => 'CodviewDetalle', 'uses' => 'codviewsconrtoller@show']);
    Route::get('/visitas/graficas/mes/{opcion}', ['as' => 'Codviewgraficasvisitas', 'uses' => 'codviewsapiconrtoller@show']);
    Route::get('/visitas/graficas/demograficas/{opcion}', ['as' => 'Codviewgraficasvisitasmundial', 'uses' => 'codviewsapiconrtoller@mundial']);
    // configuración
    Route::get('/configuracion/', ['as' => 'codviewsconfigcontroller', 'uses' => 'codviewsconfigcontroller@index']);
    Route::get('/configuracion/refresh/', ['as' => 'codviewsrefreshcontroller', 'uses' => 'codviewsconfigcontroller@resetcount']);
    Route::post('/configuracion/agregar/', ['as' => 'codviewsagregarcontroller', 'uses' => 'codviewsconfigcontroller@store']);
});

Route::group(['namespace' => 'Codwelt\codviews\Controllers', 'prefix' => 'codviews'], function () {
    Route::get('/rastreo/api', ['as' => 'Codviewrastrador', 'uses' => 'codviewsapiconrtoller@genvisit']);
});