#USER AUTHENTICATION
Route::get('/operator/login','LoginController@ViewOperatorLogin')->name('operator.login.view');
Route::post('/operator/login','LoginController@AuthOperatorLogin')->name('operator.login.auth');

Route::get('/operator/register','LoginController@ViewOperatorRegister')->name('operator.register.view');
Route::post('/operator/register','LoginController@AuthOperatorRegister')->name('operator.register.auth');

Route::get('/operator','HomeController@HomeOperator')->name('operator.home');
