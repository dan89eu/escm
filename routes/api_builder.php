<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/


Route::get('admin/infrastructures', 'API\InfrastructureAPIController@index');
Route::post('admin/infrastructures', 'API\InfrastructureAPIController@store');
Route::get('admin/infrastructures/{infrastructures}', 'API\InfrastructureAPIController@show');
Route::put('admin/infrastructures/{infrastructures}', 'API\InfrastructureAPIController@update');
Route::patch('admin/infrastructures/{infrastructures}', 'API\InfrastructureAPIController@update');
Route::delete('admin/infrastructures{infrastructures}', 'API\InfrastructureAPIController@destroy');

Route::get('admin/providers', 'API\ProviderAPIController@index');
Route::post('admin/providers', 'API\ProviderAPIController@store');
Route::get('admin/providers/{providers}', 'API\ProviderAPIController@show');
Route::put('admin/providers/{providers}', 'API\ProviderAPIController@update');
Route::patch('admin/providers/{providers}', 'API\ProviderAPIController@update');
Route::delete('admin/providers{providers}', 'API\ProviderAPIController@destroy');

Route::get('admin/projects', 'API\ProjectAPIController@index');
	Route::post('admin/projects/sidebar_results', 'API\ProjectAPIController@sidebar_results');
	Route::post('admin/projects', 'API\ProjectAPIController@store');
Route::get('admin/projects/{projects}', 'API\ProjectAPIController@show');
Route::put('admin/projects/{projects}', 'API\ProjectAPIController@update');
Route::patch('admin/projects/{projects}', 'API\ProjectAPIController@update');
Route::delete('admin/projects{projects}', 'API\ProjectAPIController@destroy');

Route::get('admin/images', 'API\ImageAPIController@index');
Route::post('admin/images', 'API\ImageAPIController@store');
Route::get('admin/images/{images}', 'API\ImageAPIController@show');
Route::put('admin/images/{images}', 'API\ImageAPIController@update');
Route::patch('admin/images/{images}', 'API\ImageAPIController@update');
Route::delete('admin/images{images}', 'API\ImageAPIController@destroy');

Route::get('admin/news', 'API\NewsAPIController@index');
Route::post('admin/news', 'API\NewsAPIController@store');
Route::get('admin/news/{news}', 'API\NewsAPIController@show');
Route::put('admin/news/{news}', 'API\NewsAPIController@update');
Route::patch('admin/news/{news}', 'API\NewsAPIController@update');
Route::delete('admin/news{news}', 'API\NewsAPIController@destroy');

Route::get('admin/beneficiaries', 'API\BeneficiaryAPIController@index');
Route::post('admin/beneficiaries', 'API\BeneficiaryAPIController@store');
Route::get('admin/beneficiaries/{beneficiaries}', 'API\BeneficiaryAPIController@show');
Route::put('admin/beneficiaries/{beneficiaries}', 'API\BeneficiaryAPIController@update');
Route::patch('admin/beneficiaries/{beneficiaries}', 'API\BeneficiaryAPIController@update');
Route::delete('admin/beneficiaries{beneficiaries}', 'API\BeneficiaryAPIController@destroy');

Route::get('admin/contacts', 'API\ContactAPIController@index');
Route::post('admin/contacts', 'API\ContactAPIController@store');
Route::get('admin/contacts/{contacts}', 'API\ContactAPIController@show');
Route::put('admin/contacts/{contacts}', 'API\ContactAPIController@update');
Route::patch('admin/contacts/{contacts}', 'API\ContactAPIController@update');
Route::delete('admin/contacts{contacts}', 'API\ContactAPIController@destroy');

Route::get('admin/verticals', 'API\VerticalAPIController@index');
Route::post('admin/verticals', 'API\VerticalAPIController@store');
Route::get('admin/verticals/{verticals}', 'API\VerticalAPIController@show');
Route::put('admin/verticals/{verticals}', 'API\VerticalAPIController@update');
Route::patch('admin/verticals/{verticals}', 'API\VerticalAPIController@update');
Route::delete('admin/verticals{verticals}', 'API\VerticalAPIController@destroy');

Route::get('admin/conectivities', 'API\ConectivityAPIController@index');
Route::post('admin/conectivities', 'API\ConectivityAPIController@store');
Route::get('admin/conectivities/{conectivities}', 'API\ConectivityAPIController@show');
Route::put('admin/conectivities/{conectivities}', 'API\ConectivityAPIController@update');
Route::patch('admin/conectivities/{conectivities}', 'API\ConectivityAPIController@update');
Route::delete('admin/conectivities{conectivities}', 'API\ConectivityAPIController@destroy');

Route::get('admin/categories', 'API\CategoryAPIController@index');
Route::post('admin/categories', 'API\CategoryAPIController@store');
Route::get('admin/categories/{categories}', 'API\CategoryAPIController@show');
Route::put('admin/categories/{categories}', 'API\CategoryAPIController@update');
Route::patch('admin/categories/{categories}', 'API\CategoryAPIController@update');
Route::delete('admin/categories{categories}', 'API\CategoryAPIController@destroy');


Route::get('admin/categoryProjects', 'API\CategoryProjectAPIController@index');
Route::post('admin/categoryProjects', 'API\CategoryProjectAPIController@store');
Route::get('admin/categoryProjects/{categoryProjects}', 'API\CategoryProjectAPIController@show');
Route::put('admin/categoryProjects/{categoryProjects}', 'API\CategoryProjectAPIController@update');
Route::patch('admin/categoryProjects/{categoryProjects}', 'API\CategoryProjectAPIController@update');
Route::delete('admin/categoryProjects{categoryProjects}', 'API\CategoryProjectAPIController@destroy');
