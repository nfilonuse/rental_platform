<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	//if(!isset($_COOKIE['amc_dontshowspalsh']))
	//	return view('car.index');
	//else
	 	return redirect()->route('web.rentcar.index');
});
Route::get('/about', 'PagesController@about')->name('web.pages.about');
Route::get('/faq', 'PagesController@faq')->name('web.pages.faq');
Route::get('/privacy', 'PagesController@privacy')->name('web.pages.privacy');
Route::get('/contact-us', 'PagesController@contactus')->name('web.pages.contactus');

Route::group(['prefix' => 'help'], function()
{
	Route::get('/', 'HelpController@index')->name('web.help.index');
});
/*
Route::group(['prefix' => 'paymant'], function()
{
	Route::post('/success', function () { return response('', 200)->header('Content-Type', 'application/json'); });
	Route::post('/cancel', function () { return response('', 200)->header('Content-Type', 'application/json'); });
});
*/
Route::group(['prefix' => 'rentcar'], function()
{
	Route::get('/', 'CarController@index')->name('web.rentcar.index');
	Route::post('/cookadd', 'CarController@cookadd')->name('web.rentcar.cookadd');
	Route::get('/search/result', 'CarController@search')->name('web.rentcar.search');
	Route::post('/resippnce', 'CarController@step4')->name('web.rentcar.step4');

	Route::get('/cart', 'ShoppingCartController@index')->name('web.rentcar.show');
	Route::post('/cart/add', 'ShoppingCartController@add')->name('web.rentcar.sendtocart');
	Route::post('/cart/addcoupon', 'ShoppingCartController@addcoupon')->name('web.rentcar.addcoupon');

	Route::get('/cart/billing', 'ShoppingCartController@billing')->name('web.rentcar.billing');
	Route::post('/cart/addbilling', 'ShoppingCartController@addbilling')->name('web.rentcar.addbilling');
	Route::get('/cart/billinggolikeguest', 'ShoppingCartController@golikeguest')->name('web.rentcar.billinggolikeguest');

	Route::get('/cart/pay', 'ShoppingCartController@pay')->name('web.rentcar.pay');
	Route::post('/cart/paymantproccess', 'ShoppingCartController@paymantproccess')->name('web.rentcar.paymantproccess');

	Route::get('/cart/success', 'ShoppingCartController@success')->name('web.rentcar.success');
	Route::get('/cart/unsuccess', 'ShoppingCartController@unsuccess')->name('web.rentcar.unsuccess');
	Route::get('/cart/unsuccessbooking', 'ShoppingCartController@unsuccessbooking')->name('web.rentcar.unsuccessbooking');

	//Route::post('/cart/step/3', 'CarController@step3')->name('web.rentcar.search');
});

Route::group(['prefix' => 'voucher'], function()
{
	Route::get('/{company_id}/{order_id}', 'VoucherController@index')->name('web.voucher.print');
});

Route::group(['prefix' => 'renthotel'], function()
{
	Route::get('/', 'HotelController@index')->name('web.renthotel.index');
	Route::get('/{id}/step/1', 'HotelController@step1')->name('web.renthotel.step1');
	Route::get('/{id}/step/2', 'HotelController@step2')->name('web.renthotel.step2');
});

//Route::get('rentcar', 'CarController@index')->name('web.rentcar.index');
//	Route::get('rentcar/step1', 'CarController@step1')->name('web.rentcar.step1');

//Route::get('renthotel', 'HotelController@index')->name('web.renthotel.index');
Route::get('coming-soon', function () {
	return view('comingsoon.index');
});

Auth::routes();

Route::group(['prefix' => 'account', 'middleware' => 'auth'], function()
{
	/*account*/
	Route::get('/', 'Account\AccountController@index')->name('account.index');

	/*Myprofile*/
	Route::get('/my-profile', 'Account\AccountController@myprofile')->name('account.users.myprofile');
	Route::post('/my-profile', 'Account\AccountController@update')->name('account.users.myprofile_post');

	/*MyBillingInformation*/
	Route::get('/my-billing-info', 'Account\AccountController@mybillinginfo')->name('account.users.mybillinginfo');
	Route::post('/my-billing-info', 'Account\AccountController@mybillinginfoupdate')->name('account.users.mybillinginfo_post');

	Route::get('/my-orders', 'Account\AccountController@myorders')->name('account.users.myorders');
});

Route::group(['prefix' => 'affiliate', 'middleware' => 'auth'], function()
{
	/*account*/
	Route::get('/', 'Account\AccountController@index')->name('account.index');

	/*My Link*/
	Route::get('/my-link', 'Account\AffiliateController@mylink')->name('account.users.mylink');
	Route::get('/my-cars-booked', 'Account\AffiliateController@mycarsbooked')->name('account.users.mycarsbooked');

});

/*admin*/
// Admin Interface Routes
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function()
{
	/*account*/
	Route::get('/', 'Admin\AdminController@index')->name('admin.index');
	/*coupons*/
	Route::get('/coupons', 'Admin\CouponsController@index')->name('admin.coupons.index');
    Route::get('/coupons/create', 'Admin\CouponsController@create')->name('admin.coupons.create');
    Route::post('/coupons/create', 'Admin\CouponsController@store')->name('admin.coupons.create_post');

    Route::get('/coupons/edit/{id}', 'Admin\CouponsController@edit')->name('admin.coupons.edit');
    Route::post('/coupons/edit/{id}', 'Admin\CouponsController@update')->name('admin.coupons.edit_post');

    Route::get('/coupons/delete/{id}', 'Admin\CouponsController@destroy')->name('admin.coupons.delete');

	/*areas*/
	Route::get('/areas', 'Admin\AreasController@index')->name('admin.areas.index');
    Route::get('/areas/create', 'Admin\AreasController@create')->name('admin.areas.create');
    Route::post('/areas/create', 'Admin\AreasController@store')->name('admin.areas.create_post');

    Route::get('/areas/edit/{id}', 'Admin\AreasController@edit')->name('admin.areas.edit');
    Route::post('/areas/edit/{id}', 'Admin\AreasController@update')->name('admin.areas.edit_post');

    Route::get('/areas/delete/{id}', 'Admin\AreasController@destroy')->name('admin.areas.delete');

	/*driverlicence*/
	Route::get('/driverlicence', 'Admin\DriverLicenceController@index')->name('admin.driverlicence.index');
    Route::get('/driverlicence/create', 'Admin\DriverLicenceController@create')->name('admin.driverlicence.create');
    Route::post('/driverlicence/create', 'Admin\DriverLicenceController@store')->name('admin.driverlicence.create_post');

    Route::get('/driverlicence/edit/{id}', 'Admin\DriverLicenceController@edit')->name('admin.driverlicence.edit');
    Route::post('/driverlicence/edit/{id}', 'Admin\DriverLicenceController@update')->name('admin.driverlicence.edit_post');

    Route::get('/driverlicence/delete/{id}', 'Admin\DriverLicenceController@destroy')->name('admin.driverlicence.delete');

	/*typerentals*/
	Route::get('/typerentals', 'Admin\TypeRentalsController@index')->name('admin.typerentals.index');
    Route::get('/typerentals/create', 'Admin\TypeRentalsController@create')->name('admin.typerentals.create');
    Route::post('/typerentals/create', 'Admin\TypeRentalsController@store')->name('admin.typerentals.create_post'); 

    Route::get('/typerentals/edit/{id}', 'Admin\TypeRentalsController@edit')->name('admin.typerentals.edit');
    Route::post('/typerentals/edit/{id}', 'Admin\TypeRentalsController@update')->name('admin.typerentals.edit_post');

    Route::get('/typerentals/delete/{id}', 'Admin\TypeRentalsController@destroy')->name('admin.typerentals.delete');

	/*cardors*/
	Route::get('/cardors', 'Admin\CarDorsController@index')->name('admin.cardors.index');
    Route::get('/cardors/create', 'Admin\CarDorsController@create')->name('admin.cardors.create');
    Route::post('/cardors/create', 'Admin\CarDorsController@store')->name('admin.cardors.create_post'); 

    Route::get('/cardors/edit/{id}', 'Admin\CarDorsController@edit')->name('admin.cardors.edit');
    Route::post('/cardors/edit/{id}', 'Admin\CarDorsController@update')->name('admin.cardors.edit_post');

    Route::get('/cardors/delete/{id}', 'Admin\CarDorsController@destroy')->name('admin.cardors.delete');

	/*carclasses*/
	Route::get('/carclasses', 'Admin\CarClassesController@index')->name('admin.carclasses.index');
    Route::get('/carclasses/create', 'Admin\CarClassesController@create')->name('admin.carclasses.create');
    Route::post('/carclasses/create', 'Admin\CarClassesController@store')->name('admin.carclasses.create_post'); 

    Route::get('/carclasses/edit/{id}', 'Admin\CarClassesController@edit')->name('admin.carclasses.edit');
    Route::post('/carclasses/edit/{id}', 'Admin\CarClassesController@update')->name('admin.carclasses.edit_post');

    Route::get('/carclasses/delete/{id}', 'Admin\CarClassesController@destroy')->name('admin.carclasses.delete');

	/*sipps*/
	Route::get('/sipps', 'Admin\SippsController@index')->name('admin.sipps.index');
    Route::get('/sipps/create', 'Admin\SippsController@create')->name('admin.sipps.create');
    Route::post('/sipps/create', 'Admin\SippsController@store')->name('admin.sipps.create_post'); 

    Route::get('/sipps/edit/{id}', 'Admin\SippsController@edit')->name('admin.sipps.edit');
    Route::post('/sipps/edit/{id}', 'Admin\SippsController@update')->name('admin.sipps.edit_post');

    Route::get('/sipps/delete/{id}', 'Admin\SippsController@destroy')->name('admin.sipps.delete');

	Route::get('/sipps/{id}/companies', 'Admin\SippsController@editcompanies')->name('admin.sipps.editcompanies');
	Route::post('/sipps/{id}/companies', 'Admin\SippsController@updatecompanies')->name('admin.sipps.updatecompanies');

	/*typecoupons*/
	Route::get('/typecoupons', 'Admin\TypeCouponsController@index')->name('admin.typecoupons.index');
    Route::get('/typecoupons/create', 'Admin\TypeCouponsController@create')->name('admin.typecoupons.create');
    Route::post('/typecoupons/create', 'Admin\TypeCouponsController@store')->name('admin.typecoupons.create_post');

    Route::get('/typecoupons/edit/{id}', 'Admin\TypeCouponsController@edit')->name('admin.typecoupons.edit');
    Route::post('/typecoupons/edit/{id}', 'Admin\TypeCouponsController@update')->name('admin.typecoupons.edit_post');

    Route::get('/typecoupons/delete/{id}', 'Admin\TypeCouponsController@destroy')->name('admin.typecoupons.delete');

	/*statuscoupons*/
	Route::get('/statuscoupons', 'Admin\StatusCouponsController@index')->name('admin.statuscoupons.index');
    Route::get('/statuscoupons/create', 'Admin\StatusCouponsController@create')->name('admin.statuscoupons.create');
    Route::post('/statuscoupons/create', 'Admin\StatusCouponsController@store')->name('admin.statuscoupons.create_post');

    Route::get('/statuscoupons/edit/{id}', 'Admin\StatusCouponsController@edit')->name('admin.statuscoupons.edit');
    Route::post('/statuscoupons/edit/{id}', 'Admin\StatusCouponsController@update')->name('admin.statuscoupons.edit_post');

    Route::get('/statuscoupons/delete/{id}', 'Admin\StatusCouponsController@destroy')->name('admin.statuscoupons.delete');

	/*packages*/
	Route::get('/packages', 'Admin\PackagesController@index')->name('admin.packages.index');
    Route::get('/packages/create', 'Admin\PackagesController@create')->name('admin.packages.create');
    Route::post('/packages/create', 'Admin\PackagesController@store')->name('admin.packages.create_post');

    Route::get('/packages/edit/{id}', 'Admin\PackagesController@edit')->name('admin.packages.edit');
    Route::post('/packages/edit/{id}', 'Admin\PackagesController@update')->name('admin.packages.edit_post');

	Route::get('/packages/delete/{id}', 'Admin\PackagesController@destroy')->name('admin.packages.delete');
	
	/*companies*/
	Route::get('/companies', 'Admin\PackagesController@index')->name('admin.companies.index');
    Route::get('/companies/create', 'Admin\PackagesController@create')->name('admin.companies.create');
    Route::post('/companies/create', 'Admin\PackagesController@store')->name('admin.companies.create_post');

    Route::get('/companies/edit/{id}', 'Admin\PackagesController@edit')->name('admin.companies.edit');
    Route::post('/companies/edit/{id}', 'Admin\PackagesController@update')->name('admin.companies.edit_post');

    Route::get('/companies/delete/{id}', 'Admin\PackagesController@destroy')->name('admin.companies.delete');

	/*accounts*/
	Route::get('/accounts', 'Admin\AccountsController@index')->name('admin.accounts.index');
    Route::get('/accounts/create', 'Admin\AccountsController@create')->name('admin.accounts.create');
    Route::post('/accounts/create', 'Admin\AccountsController@store')->name('admin.accounts.create_post');

    Route::get('/accounts/edit/{id}', 'Admin\AccountsController@edit')->name('admin.accounts.edit');
    Route::post('/accounts/edit/{id}', 'Admin\AccountsController@update')->name('admin.accounts.edit_post');

    Route::get('/accounts/delete/{id}', 'Admin\AccountsController@destroy')->name('admin.accounts.delete');

	/*locations*/
	Route::get('/locations', 'Admin\LocationsController@index')->name('admin.locations.index');
    Route::get('/locations/create', 'Admin\LocationsController@create')->name('admin.locations.create');
    Route::post('/locations/create', 'Admin\LocationsController@store')->name('admin.locations.create_post');

    Route::get('/locations/edit/{id}', 'Admin\LocationsController@edit')->name('admin.locations.edit');
    Route::post('/locations/edit/{id}', 'Admin\LocationsController@update')->name('admin.locations.edit_post');

    Route::get('/locations/delete/{id}', 'Admin\LocationsController@destroy')->name('admin.locations.delete');

	Route::get('/locations/{id}/companies', 'Admin\LocationsController@editcompanies')->name('admin.locations.editcompanies');
	Route::post('/locations/{id}/companies', 'Admin\LocationsController@updatecompanies')->name('admin.locations.updatecompanies');

	/*rates*/
	Route::get('/rates', 'Admin\RatesController@index')->name('admin.rates.index');
    Route::get('/rates/create', 'Admin\RatesController@create')->name('admin.rates.create');
    Route::post('/rates/create', 'Admin\RatesController@store')->name('admin.rates.create_post');

    Route::get('/rates/edit/{id}', 'Admin\RatesController@edit')->name('admin.rates.edit');
    Route::post('/rates/edit/{id}', 'Admin\RatesController@update')->name('admin.rates.edit_post');

    Route::get('/rates/delete/{id}', 'Admin\RatesController@destroy')->name('admin.rates.delete');

	Route::get('/rates/{id}/packages', 'Admin\RatesController@editpackages')->name('admin.rates.editpackages');
	Route::post('/rates/{id}/packages', 'Admin\RatesController@updatepackages')->name('admin.rates.updatepackages');

	Route::get('/rates/{id}/accounts', 'Admin\RatesController@editaccounts')->name('admin.rates.editaccounts');
	Route::post('/rates/{id}/accounts', 'Admin\RatesController@updateaccounts')->name('admin.rates.updateaccounts');

	Route::get('/rates/{id}/companies', 'Admin\RatesController@editcompanies')->name('admin.rates.editcompanies');
	Route::post('/rates/{id}/companies', 'Admin\RatesController@updatecompanies')->name('admin.rates.updatecompanies');

	Route::get('/rates/{id}/areas', 'Admin\RatesController@editareas')->name('admin.rates.editareas');
	Route::post('/rates/{id}/areas', 'Admin\RatesController@updateareas')->name('admin.rates.updateareas');

	Route::get('/rates/{id}/sipps', 'Admin\RatesController@editsipps')->name('admin.rates.editsipps');
	Route::post('/rates/{id}/sipps', 'Admin\RatesController@updatesipps')->name('admin.rates.updatesipps');

	/*users*/
	Route::get('/users', 'Admin\UsersController@index')->name('admin.users.index');
    Route::get('/users/create', 'Admin\UsersController@create')->name('admin.users.create');
    Route::post('/users/create', 'Admin\UsersController@store')->name('admin.users.create_post');

    Route::get('/users/edit/{id}', 'Admin\UsersController@edit')->name('admin.users.edit');
    Route::post('/users/edit/{id}', 'Admin\UsersController@update')->name('admin.users.edit_post');

    Route::get('/users/delete/{id}', 'Admin\UsersController@destroy')->name('admin.users.delete');

	/*users affiliate*/
	Route::get('/affiliate_users', 'Admin\UserAffiliateController@index')->name('admin.usersaffiliate.index');
    Route::get('/affiliate_users/create', 'Admin\UserAffiliateController@create')->name('admin.usersaffiliate.create');
    Route::post('/affiliate_users/create', 'Admin\UserAffiliateController@store')->name('admin.usersaffiliate.create_post');

    Route::get('/affiliate_users/edit/{id}', 'Admin\UserAffiliateController@edit')->name('admin.usersaffiliate.edit');
    Route::post('/affiliate_users/edit/{id}', 'Admin\UserAffiliateController@update')->name('admin.usersaffiliate.edit_post');

    Route::get('/affiliate_users/delete/{id}', 'Admin\UserAffiliateController@destroy')->name('admin.usersaffiliate.delete');

	Route::get('/affiliate_users/report/{id}', 'Admin\UserAffiliateController@report')->name('admin.usersaffiliate.report');

	/*Renta car Actions*/
    Route::get('/retrieveres', 'Admin\RentalcarController@retrieveres')->name('admin.rentalcaraction.retrieveres');

	Route::get('/cancelres', 'Admin\RentalcarController@cancelres')->name('admin.rentalcaraction.cancelres');
	Route::post('/cancelres', 'Admin\RentalcarController@updatecancelres')->name('admin.rentalcaraction.updatecancelres');

	/*reports*/
	Route::get('/reports/report1', 'Admin\ReportsController@report1')->name('admin.reports.report1');
    Route::get('/reports/report2', 'Admin\ReportsController@report2')->name('admin.reports.report2');

	/*reports*/
	Route::get('/reports/exportreport1', 'Admin\ReportsController@exportreport1')->name('admin.reports.exportreport1');
    Route::get('/reports/exportreport2', 'Admin\ReportsController@exportreport2')->name('admin.reports.exportreport2');
});
