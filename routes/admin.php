<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
*/
//note that the prefix is admin for all file route
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    Route::group(['namespace' => 'Dashboard', 'middleware' => 'auth:admin', 'prefix' => 'admin'], function () {

        //======================== Dashboard===========================
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');//the first page admin visits if authentication

        //========================logout admin=========================
        Route::get('logout', 'LoginController@makeLogout')->name('admin.logout');

        //======================== profile admin ======================
        Route::group(['prefix' => 'profile'], function () {
            Route::get('edit', 'ProfileController@editProfile')->name('edit.profile');
            Route::put('update', 'ProfileController@updateProfile')->name('update.profile');
        });

        //======================== Setting methods ======================
        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-method/{type}', 'SettingsController@editShippingMethods')->name('edit.shipping.methods');
            Route::put('shipping-method/{id}', 'SettingsController@updateShippingMethods')->name('update.shipping.methods');

        });

        //======================== Main categories ======================
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', 'CategoriesController@index')->name('admin.mainCategories');
            Route::get('create', 'CategoriesController@create')->name('admin.mainCategories.create');
            Route::post('store', 'CategoriesController@store')->name('admin.mainCategories.store');
            Route::get('edit/{id}', 'CategoriesController@edit')->name('admin.mainCategories.edit');
            Route::post('update/{id}', 'CategoriesController@updateCategory')->name('admin.mainCategories.update');
            Route::get('delete/{id}', 'CategoriesController@destroy')->name('admin.mainCategories.delete');
        });

        //======================== brands routes ======================
        Route::group(['prefix' => 'brands'], function () {
            Route::get('/', 'BrandsController@index')->name('admin.brands');
            Route::get('create', 'BrandsController@create')->name('admin.brands.create');
            Route::post('store', 'BrandsController@store')->name('admin.brands.store');
            Route::get('edit/{id}', 'BrandsController@edit')->name('admin.brands.edit');
            Route::post('update/{id}', 'BrandsController@update')->name('admin.brands.update');
            Route::get('delete/{id}', 'BrandsController@destroy')->name('admin.brands.delete');
        });

        //======================== Tags routes ======================
        Route::group(['prefix' => 'tags'], function () {
            Route::get('/', 'TagsController@index')->name('admin.tags');
            Route::get('create', 'TagsController@create')->name('admin.tags.create');
            Route::post('store', 'TagsController@store')->name('admin.tags.store');
            Route::get('edit/{id}', 'TagsController@edit')->name('admin.tags.edit');
            Route::post('update/{id}', 'TagsController@update')->name('admin.tags.update');
            Route::get('delete/{id}', 'TagsController@destroy')->name('admin.tags.delete');
        });

     /**** ======================== Products Routes ====================== ****/

        Route::group(['prefix' => 'product'], function (){
            Route::get('/show-products', 'ProductController@index')->name('index.product');
            Route::get('create-product', 'ProductController@create')->name('create.product');
            Route::post('save-product-general', 'ProductController@store')->name('save.product.general');
            Route::get('delete-product/{id}', 'ProductController@destroy')->name('delete.product');
            //======================== Product Images ======================

            Route::get('add-product-images/{product_id}', 'ProductController@addProductImages')->name('add.product.images');
            Route::post('save-images-inFolder', 'ProductController@saveImagesOfProductInFolder')->name('save.images.inFolder');
            Route::post('save-images-inDB', 'ProductController@saveImagesOfProductInDB')->name('save.images.inDB');
            Route::delete('delete-image/{id}', 'ProductController@deleteImagesOfProduct')->name('delete.image');
            Route::post('remove-image', 'ProductController@removeImagesOfProductFromFolder')->name('delete.image.fromFolder');


            //======================== Product Edit ======================
            Route::get('edit-product-general/{product_id}', 'ProductController@editProductGeneral')->name('edit.product.general');
            Route::post('update-product-general/{product_id}', 'ProductController@updateProductGeneral')->name('update.product.general');
            Route::get('edit-product-price/{product_id}', 'ProductController@editProductPrice')->name('edit.product.price');
            Route::post('update-product-price/{product_id}', 'ProductController@updateProductPrice')->name('update.product.price');
            Route::get('edit-product-store/{product_id}', 'ProductController@editProductStore')->name('edit.product.store');
            Route::post('update-product-store/{product_id}', 'ProductController@updateProductStore')->name('update.product.store');
            Route::get('edit-product-activation/{product_id}', 'ProductController@editProductActivation')->name('edit.product.activation');
            Route::post('update-product-activation/{product_id}', 'ProductController@updateProductActivation')->name('update.product.activation');

        });

        /**** ======================== End Products Routes ====================== ****/



//        //======================== product routes ======================
//        Route::group(['prefix' => 'products'], function () {
//
//            Route::get('/', 'ProductController@index')->name('admin.products');
//            Route::get('general-information', 'ProductController@create')->name('admin.products.general.create');
//            Route::post('store-general-information', 'ProductController@store')->name('admin.products.general.store');
//
//            Route::get('price/{id}', 'ProductController@getPrice')->name('admin.products.price');
//            Route::post('price', 'ProductController@saveProductPrice')->name('admin.products.price.store');
//
//            Route::get('stock/{id}', 'ProductController@getStock')->name('admin.products.stock');
//            Route::post('stock', 'ProductController@saveProductStock')->name('admin.products.stock.store');
//
//            Route::get('images/{id}', 'ProductController@addImages')->name('admin.products.images');
//            Route::post('images', 'ProductController@saveProductImages')->name('admin.products.images.store');
//            Route::post('images/db', 'ProductController@saveProductImagesDB')->name('admin.products.images.store.db');
//            Route::post('delete', 'ProductController@deleteProductImages')->name('admin.products.images.delete');
//        });

        //======================== Attributes Routes ======================

        Route::group(['prefix' => 'attributes'], function () {
            Route::get('/', 'AttributesController@index')->name('admin.attributes');
            Route::get('create', 'AttributesController@create')->name('admin.attributes.create');
            Route::post('store', 'AttributesController@store')->name('admin.attributes.store');
            Route::get('delete/{id}', 'AttributesController@destroy')->name('admin.attributes.delete');
            Route::get('edit/{id}', 'AttributesController@edit')->name('admin.attributes.edit');
            Route::post('update/{id}', 'AttributesController@update')->name('admin.attributes.update');
        });


            //======================== options Routes ======================
        Route::group(['prefix' => 'options'], function () {
            Route::get('/','OptionsController@index') -> name('admin.options');
            Route::get('create','OptionsController@create') -> name('admin.options.create');
            Route::post('store','OptionsController@store') -> name('admin.options.store');
            Route::get('delete/{id}','OptionsController@destroy') -> name('admin.options.delete');
            Route::get('edit/{id}','OptionsController@edit') -> name('admin.options.edit');
            Route::post('update/{id}','OptionsController@update') -> name('admin.options.update');
        });

       //======================== sliders Routes ======================

        Route::group(['prefix' => 'sliders'], function () {
            Route::get('/', 'SliderController@addImages')->name('admin.sliders.create');
            Route::post('images', 'SliderController@saveSliderImages')->name('admin.sliders.images.store'); //save folder
            Route::post('images/db', 'SliderController@saveSliderImagesDB')->name('admin.sliders.images.store.db'); //save db
            Route::delete('delete-image-slider/{id}', 'SliderController@deleteImagesOfSlider')->name('delete.image.slider');
            Route::post('remove-image-slider', 'SliderController@removeImagesOfSliderFromFolder')->name('delete.slider.image.fromFolder');
        });
        //======================== sliders Routes ======================

        Route::group(['prefix' => 'banners'], function () {
            Route::get('/', 'BannerController@addImages')->name('admin.banner.create');
            Route::post('images', 'BannerController@saveBannerImages')->name('admin.banner.images.store'); //save folder
            Route::post('images/db', 'BannerController@saveBannerImagesDB')->name('admin.banner.images.store.db'); //save db
            Route::delete('delete-image-banner/{id}', 'BannerController@deleteImagesOfBanner')->name('delete.image.banner');
            Route::post('remove-image-banner', 'BannerController@removeImagesOfBannerFromFolder')->name('delete.banner.image.fromFolder');
        });



    });

    //========================  login form admin ===========================
    Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin', 'prefix' => 'admin'], function () {
        Route::get('login', 'LoginController@login')->name('admin.login');
        Route::post('login', 'LoginController@makeLogin')->name('make.admin.login');
    });

});
