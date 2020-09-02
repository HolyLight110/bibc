<?php

use Pecee\SimpleRouter\SimpleRouter as Route;

Route::group(['middleware' => \App\Middlewares\Dashboard::class, 'prefix' => 'bibc'], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('login', 'LoginController@index')->name('login-form');
    Route::post('login', 'LoginController@login')->name('login');
    Route::get('logout', 'LoginController@logout')->name('logout');

    Route::group(['middleware' => \App\Middlewares\Panel::class, 'prefix' => 'panel'], function () {
        Route::get('/', 'PanelController@index')->name('panel');

        Route::group(['prefix' => 'driver'], function () {
            Route::group(['prefix' => 'vehicles'], function () {
                Route::get('/', 'VehicleController@index')->name('driver.vehicles');
                Route::get('/create', 'VehicleController@create')->name('driver.vehicles.create');
                Route::post('/', 'VehicleController@store')->name('driver.vehicles.store');
                Route::get('/edit/{id}', 'VehicleController@edit')->name('driver.vehicles.edit');
                Route::post('/edit/{id}', 'VehicleController@update')->name('driver.vehicles.update');
                Route::delete('/{id}', 'VehicleController@delete')->name('driver.vehicles.delete');
            });

            Route::group(['prefix' => 'trips'], function () {
                Route::get('/', 'TripController@index')->name('driver.trips');
            });

            Route::group(['prefix' => 'payments'], function () {
                Route::get('{paymentType?}', 'PaymentController@index')->name('driver.payments');
            });

            Route::group(['prefix' => 'wallet'], function () {
                Route::get('', 'UsersWalletController@index')->name('driver.wallet');
            });
        });

    });
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        /*
         * مدیریت کاربران
         */
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UserController@index')->name('users');
            Route::get('/create', 'UserController@create')->name('users.create');
            Route::post('', 'UserController@store')->name('users.store');
            Route::get('/edit/{id}', 'UserController@edit')->name('users.edit');
            Route::post('/edit/{id}', 'UserController@update')->name('users.update');
            Route::delete('/{id}', 'UserController@delete')->name('users.delete');
        });
        /*
         * مدیریت شرکت ها
         */
        Route::group(['prefix' => 'companies'], function () {
            Route::get('/', 'CompanyController@index')->name('companies');
            Route::get('/create', 'CompanyController@create')->name('companies.create');
            Route::get('/documents', 'CompanyController@form')->name('companies.new');
            Route::post('', 'CompanyController@store')->name('companies.store');
            Route::get('/edit/{id}', 'CompanyController@edit')->name('companies.edit');
            Route::post('/edit/{id}', 'CompanyController@update')->name('companies.update');
            Route::delete('/delete/{id}', 'CompanyController@delete')->name('companies.delete');

            Route::get('/{id}/drivers', 'DriverController@index')->name('companies.drivers');
        });
        /*
         * مدیریت اسناد و مدارک
         */
        Route::group(['prefix' => 'documents'], function () {
            Route::get('/{model}/{modelId}', 'DocumentController@index')->name('documents');
        });
        /*
         * مدیریت نواحی
         */
        Route::group(['prefix' => 'areas'], function () {
            Route::get('/', 'AreaController@index')->name('areas');
            Route::get('/create', 'AreaController@create')->name('areas.create');
            // Route::get('/documents', 'AreaController@form')->name('areas.new');
            Route::post('', 'AreaController@store')->name('areas.store');
            Route::get('/edit/{id}', 'AreaController@edit')->name('areas.edit');
            Route::post('/edit/{id}', 'AreaController@update')->name('areas.update');
            Route::delete('/{id}', 'AreaController@delete')->name('areas.delete');
        });
        /*
         * مدیریت رانندگان
         */
        Route::group(['prefix' => 'drivers'], function () {
            Route::get('/', 'DriverController@index')->name('drivers');
            Route::get('/create', 'DriverController@create')->name('drivers.create');
            Route::post('', 'DriverController@store')->name('drivers.store');
            Route::get('/edit/{id}', 'DriverController@edit')->where(['id' => '[0-9]+'])->name('drivers.edit');
            Route::post('/edit/{id}', 'DriverController@update')->where(['id' => '[0-9]+'])->name('drivers.update');
            Route::delete('/{id}', 'DriverController@delete')->where(['id' => '[0-9]+'])->name('drivers.delete');
            Route::post('/reset/{id}', 'DriverController@reset')->where(['id' => '[0-9]+'])->name('drivers.reset');
        });
        /*
         * مدیریت وسایل نقلیه
         */
        Route::group(['prefix' => 'vehicles'], function () {
            Route::get('/', 'VehicleController@index')->name('vehicles');
            Route::get('/create', 'VehicleController@create')->name('vehicles.create');
            Route::post('', 'VehicleController@store')->name('vehicles.store');
            Route::get('/edit/{id}', 'VehicleController@edit')->name('vehicles.edit');
            Route::post('/edit/{id}', 'VehicleController@update')->name('vehicles.update');
            Route::delete('/{id}', 'VehicleController@delete')->name('vehicles.delete');
        });
        /*
         * مدیریت انواع وسایل نقلیه
         */
        Route::group(['prefix' => 'vehicleTypes'], function () {
            Route::get('/', 'VehicleTypeController@index')->name('vehicleTypes');
            Route::get('/create', 'VehicleTypeController@create')->name('vehicleTypes.create');
            Route::post('', 'VehicleTypeController@store')->name('vehicleTypes.store');
            Route::get('/edit/{id}', 'VehicleTypeController@edit')->name('vehicleTypes.edit');
            Route::post('/edit/{id}', 'VehicleTypeController@update')->name('vehicleTypes.update');
            Route::delete('/{id}', 'VehicleTypeController@delete')->name('vehicleTypes.delete');
        });
        /*
         * مدیریت نرخ ها
         */
        Route::group(['prefix' => 'feeSettings'], function () {
            Route::get('/', 'FeeController@index')->name('feeSettings');
            Route::post('/', 'FeeController@update')->name('feeSettings.update');
        });
        /*
         * مدیریت بسته ها
         */
        Route::group(['prefix' => 'packageTypes'], function () {
            Route::get('/', 'PackageTypeController@index')->name('packageTypes');
            Route::get('/create', 'PackageTypeController@create')->name('packageTypes.create');
            Route::post('', 'PackageTypeController@store')->name('packageTypes.store');
            Route::get('/edit/{id}', 'PackageTypeController@edit')->name('packageTypes.edit');
            Route::post('/edit/{id}', 'PackageTypeController@update')->name('packageTypes.update');
            Route::delete('/{id}', 'PackageTypeController@delete')->name('packageTypes.delete');
        });
        /*
         * مدیریت مسافران
         */
        Route::group(['prefix' => 'passengers'], function () {
            Route::get('/', 'PassengerController@index')->name('passengers');
            Route::get('/create', 'PassengerController@create')->name('passengers.create');
            Route::post('', 'PassengerController@store')->name('passengers.store');
            Route::get('/edit/{id}', 'PassengerController@edit')->name('passengers.edit');
            Route::post('/edit/{id}', 'PassengerController@update')->name('passengers.update');
            Route::delete('/{id}', 'PassengerController@delete')->name('passengers.delete');
        });
        /*
         * مدیریت رزروها
         */
        Route::group(['prefix' => 'bookings'], function () {
            Route::get('/', 'BookingController@index')->name('bookings');
            Route::get('/new', 'BookingController@form')->name('bookings.new');
            Route::post('', 'BookingController@create')->name('bookings.create');
        });


        Route::group(['prefix' => 'heatmap'], function () {
            Route::get('/', 'HeatmapController@index')->name('heatmap');
        });
        /*
     * مدیریت بسته ها
     */
        Route::group(['prefix' => 'trips'], function () {
            Route::get('/', 'TripController@index')->name('trips');
        });
        Route::group(['prefix' => 'admin'], function () {
            Route::get('/', 'DashboardController@index');
        });
    });
});
