<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/


Route::get('admin/infrastructures', 'InfrastructureAPIController@index');
Route::post('admin/infrastructures', 'InfrastructureAPIController@store');
Route::get('admin/infrastructures/{infrastructures}', 'InfrastructureAPIController@show');
Route::put('admin/infrastructures/{infrastructures}', 'InfrastructureAPIController@update');
Route::patch('admin/infrastructures/{infrastructures}', 'InfrastructureAPIController@update');
Route::delete('admin/infrastructures{infrastructures}', 'InfrastructureAPIController@destroy');

Route::get('admin/providers', 'ProviderAPIController@index');
Route::post('admin/providers', 'ProviderAPIController@store');
Route::get('admin/providers/{providers}', 'ProviderAPIController@show');
Route::put('admin/providers/{providers}', 'ProviderAPIController@update');
Route::patch('admin/providers/{providers}', 'ProviderAPIController@update');
Route::delete('admin/providers{providers}', 'ProviderAPIController@destroy');

Route::get('admin/providers', 'ProviderAPIController@index');
Route::post('admin/providers', 'ProviderAPIController@store');
Route::get('admin/providers/{providers}', 'ProviderAPIController@show');
Route::put('admin/providers/{providers}', 'ProviderAPIController@update');
Route::patch('admin/providers/{providers}', 'ProviderAPIController@update');
Route::delete('admin/providers{providers}', 'ProviderAPIController@destroy');

Route::get('admin/projects', 'ProjectAPIController@index');
Route::post('admin/projects', 'ProjectAPIController@store');
Route::get('admin/projects/{projects}', 'ProjectAPIController@show');
Route::put('admin/projects/{projects}', 'ProjectAPIController@update');
Route::patch('admin/projects/{projects}', 'ProjectAPIController@update');
Route::delete('admin/projects{projects}', 'ProjectAPIController@destroy');

Route::get('admin/images', 'ImageAPIController@index');
Route::post('admin/images', 'ImageAPIController@store');
Route::get('admin/images/{images}', 'ImageAPIController@show');
Route::put('admin/images/{images}', 'ImageAPIController@update');
Route::patch('admin/images/{images}', 'ImageAPIController@update');
Route::delete('admin/images{images}', 'ImageAPIController@destroy');

Route::get('admin/news', 'NewsAPIController@index');
Route::post('admin/news', 'NewsAPIController@store');
Route::get('admin/news/{news}', 'NewsAPIController@show');
Route::put('admin/news/{news}', 'NewsAPIController@update');
Route::patch('admin/news/{news}', 'NewsAPIController@update');
Route::delete('admin/news{news}', 'NewsAPIController@destroy');

Route::get('admin/beneficiaries', 'BeneficiaryAPIController@index');
Route::post('admin/beneficiaries', 'BeneficiaryAPIController@store');
Route::get('admin/beneficiaries/{beneficiaries}', 'BeneficiaryAPIController@show');
Route::put('admin/beneficiaries/{beneficiaries}', 'BeneficiaryAPIController@update');
Route::patch('admin/beneficiaries/{beneficiaries}', 'BeneficiaryAPIController@update');
Route::delete('admin/beneficiaries{beneficiaries}', 'BeneficiaryAPIController@destroy');

Route::get('admin/contacts', 'ContactAPIController@index');
Route::post('admin/contacts', 'ContactAPIController@store');
Route::get('admin/contacts/{contacts}', 'ContactAPIController@show');
Route::put('admin/contacts/{contacts}', 'ContactAPIController@update');
Route::patch('admin/contacts/{contacts}', 'ContactAPIController@update');
Route::delete('admin/contacts{contacts}', 'ContactAPIController@destroy');

Route::get('admin/verticals', 'VerticalAPIController@index');
Route::post('admin/verticals', 'VerticalAPIController@store');
Route::get('admin/verticals/{verticals}', 'VerticalAPIController@show');
Route::put('admin/verticals/{verticals}', 'VerticalAPIController@update');
Route::patch('admin/verticals/{verticals}', 'VerticalAPIController@update');
Route::delete('admin/verticals{verticals}', 'VerticalAPIController@destroy');

Route::get('admin/verticals', 'VerticalAPIController@index');
Route::post('admin/verticals', 'VerticalAPIController@store');
Route::get('admin/verticals/{verticals}', 'VerticalAPIController@show');
Route::put('admin/verticals/{verticals}', 'VerticalAPIController@update');
Route::patch('admin/verticals/{verticals}', 'VerticalAPIController@update');
Route::delete('admin/verticals{verticals}', 'VerticalAPIController@destroy');

Route::get('admin/verticals', 'VerticalAPIController@index');
Route::post('admin/verticals', 'VerticalAPIController@store');
Route::get('admin/verticals/{verticals}', 'VerticalAPIController@show');
Route::put('admin/verticals/{verticals}', 'VerticalAPIController@update');
Route::patch('admin/verticals/{verticals}', 'VerticalAPIController@update');
Route::delete('admin/verticals{verticals}', 'VerticalAPIController@destroy');