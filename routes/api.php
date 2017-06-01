<?php
$api = app('Dingo\Api\Routing\Router');

$api->version('v1',
    //['middleware'=>'api.auth']
    [], function ($api) {
        $api->get('project', '\App\Api\V1\Controllers\indexController@index');
        $api->post('project', '\App\Api\V1\Controllers\indexController@add');
        $api->put('project/{id}', '\App\Api\V1\Controllers\indexController@update');
        $api->delete('project/{id}', '\App\Api\V1\Controllers\indexController@delete');
        $api->get('project/{id}','\App\Api\V1\Controllers\indexController@get');
});
