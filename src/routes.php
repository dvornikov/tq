<?php
$languages = array('en', 'ru');  //available lenguages (without the default language)
$locale = Request::segment(1);

if(in_array($locale, $languages)){
    \App::setLocale($locale);   //to change the lang over the entire app
    Config::set('app.languages', $languages);
}else{
    $locale = null;  //no prefix for the default lang
}

Route::group([
    'prefix' => $locale,
    'middleware' => ['web'],
], function () {
    // Route::model('files', 'Dvornikov\TQ\File');
    Route::model('tickets', 'Dvornikov\TQ\Ticket');

    Route::resource('tickets', 'Dvornikov\TQ\TicketsController', [
        'names' => [
            'index' => 'tickets.index',
            'store' => 'tickets.store',
            'create' => 'tickets.create',
            'update' => 'tickets.update',
            'destroy' => 'tickets.destroy',
            'show' => 'tickets.show',
            'edit' => 'tickets.edit'
        ]
    ]);
    // Route::resource('tickets.files', 'Dvornikov\TQ\FilesController', [
    // ]);
    //
    Route::get('files/get/{filename}', ['as' => 'files.get', 'uses' => 'Dvornikov\TQ\FilesController@get']);
    Route::post('files/add', ['as' => 'files.add', 'uses' => 'Dvornikov\TQ\FilesController@add']);

    // Route::get('/tickets', array('as' => 'tickets.index', 'uses' => 'Dvornikov\TQ\TicketsController@index'));
    // Route::post('/tickets}', array('as' => 'tickets.store', 'uses' => 'Dvornikov\TQ\TicketsController@store'));
    // Route::get('/tickets/create', array('as' => 'tickets.create', 'uses' => 'Dvornikov\TQ\TicketsController@create'));
    // Route::get('/tickets/{tickets}', array('as' => 'tickets.show', 'uses' => 'Dvornikov\TQ\TicketsController@show'));
});
