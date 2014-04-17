{{ "\n\n" }}
Route::get('user/login','UserController@getLogin');
Route::post('user/login','UserController@postLogin');
Route::group(array('before' => 'auth'), function(){
    Route::post('user/logout', function(){
        Auth::logout();
        return Redirect::to('/');
    });
});
