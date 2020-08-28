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
                Route::get('/new', 'VehicleController@form')->name('driver.vehicles.new');
                Route::post('/', 'VehicleController@create')->name('driver.vehicles.create');
                Route::get('/{id}/edit', 'VehicleController@form')->name('driver.vehicles.edit');
                Route::post('/{id}', 'VehicleController@update')->name('driver.vehicles.update');
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
            Route::get('/new', 'UserController@form')->name('users.new');
            Route::post('', 'UserController@create')->name('users.create');
            Route::get('/{id}', 'UserController@form')->name('users.edit');
            Route::post('/{id}', 'UserController@update')->name('users.update');
            Route::delete('/{id}', 'UserController@delete')->name('users.delete');
        });
        /*
         * مدیریت شرکت ها
         */
        Route::group(['prefix' => 'companies'], function () {
            Route::get('/', 'CompanyController@index')->name('companies');
            Route::get('/new', 'CompanyController@form')->name('companies.new');
            Route::get('/documents', 'CompanyController@form')->name('companies.new');
            Route::post('', 'CompanyController@create')->name('companies.create');
            Route::get('/{id}', 'CompanyController@form')->name('companies.edit');
            Route::post('/{id}', 'CompanyController@update')->name('companies.update');
            Route::delete('/{id}', 'CompanyController@delete')->name('companies.delete');

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
            Route::get('/new', 'AreaController@form')->name('areas.new');
            Route::get('/documents', 'AreaController@form')->name('areas.new');
            Route::post('', 'AreaController@create')->name('areas.create');
            Route::get('/{id}', 'AreaController@form')->name('areas.edit');
            Route::post('/{id}', 'AreaController@update')->name('areas.update');
            Route::delete('/{id}', 'AreaController@delete')->name('areas.delete');
        });
        /*
         * مدیریت رانندگان
         */
        Route::group(['prefix' => 'drivers'], function () {
            Route::get('/', 'DriverController@index')->name('drivers');
            Route::get('/new', 'DriverController@form')->name('drivers.new');
            Route::post('', 'DriverController@create')->name('drivers.create');
            Route::get('/{id}', 'DriverController@form')->where(['id' => '[0-9]+'])->name('drivers.edit');
            Route::post('/{id}', 'DriverController@update')->where(['id' => '[0-9]+'])->name('drivers.update');
            Route::delete('/{id}', 'DriverController@delete')->where(['id' => '[0-9]+'])->name('drivers.delete');
            Route::post('/reset/{id}', 'DriverController@reset')->where(['id' => '[0-9]+'])->name('drivers.reset');
        });
        /*
         * مدیریت وسایل نقلیه
         */
        Route::group(['prefix' => 'vehicles'], function () {
            Route::get('/', 'VehicleController@index')->name('vehicles');
            Route::get('/new', 'VehicleController@form')->name('vehicles.new');
            Route::post('', 'VehicleController@create')->name('vehicles.create');
            Route::get('/{id}', 'VehicleController@form')->name('vehicles.edit');
            Route::post('/{id}', 'VehicleController@update')->name('vehicles.update');
            Route::delete('/{id}', 'VehicleController@delete')->name('vehicles.delete');
        });
        /*
         * مدیریت انواع وسایل نقلیه
         */
        Route::group(['prefix' => 'vehicleTypes'], function () {
            Route::get('/', 'VehicleTypeController@index')->name('vehicleTypes');
            Route::get('/new', 'VehicleTypeController@form')->name('vehicleTypes.new');
            Route::post('', 'VehicleTypeController@create')->name('vehicleTypes.create');
            Route::get('/{id}', 'VehicleTypeController@form')->name('vehicleTypes.edit');
            Route::post('/{id}', 'VehicleTypeController@update')->name('vehicleTypes.update');
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
            Route::get('/new', 'PackageTypeController@form')->name('packageTypes.new');
            Route::post('', 'PackageTypeController@create')->name('packageTypes.create');
            Route::get('/{id}', 'PackageTypeController@form')->name('packageTypes.edit');
            Route::post('/{id}', 'PackageTypeController@update')->name('packageTypes.update');
            Route::delete('/{id}', 'PackageTypeController@delete')->name('packageTypes.delete');
        });
        /*
         * مدیریت مسافران
         */
        Route::group(['prefix' => 'passengers'], function () {
            Route::get('/', 'PassengerController@index')->name('passengers');
            Route::get('/new', 'PassengerController@form')->name('passengers.new');
            Route::post('', 'PassengerController@create')->name('passengers.create');
            Route::get('/{id}', 'PassengerController@form')->name('passengers.edit');
            Route::post('/{id}', 'PassengerController@update')->name('passengers.update');
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
