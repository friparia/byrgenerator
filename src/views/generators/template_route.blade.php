    
Route::group(array('before' => 'auth'), function(){
    Route::get('{{ $name }}', '{{ $classname }}Controller@getList');
    Route::get('{{ $name }}/info', '{{ $classname }}Controller@getInfo');
    Route::post('{{ $name }}/create', '{{ $classname }}Controller@postStore');
    Route::post('{{ $name }}/update', '{{ $classname }}Controller@postUpdate');
    Route::post('{{ $name }}/delete', '{{ $classname }}Controller@postDelete');
});
