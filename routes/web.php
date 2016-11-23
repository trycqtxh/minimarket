<?php


Route::group(['middleware'=>'web'], function(){
    Route::get('login', [
        'uses'=>'AuthController@getLogin',
        'as'=>'login'
    ]);

    Route::post('login', [
        'uses'=>'AuthController@postLogin',
        'as'=>'post-login'
    ]);

    Route::get('logout', [
        'uses'=>'AuthController@logout',
        'as'=>'logout'
    ]);
});

Route::group(['middleware'=>'auth'], function(){
    //Auth::Route();
    Route::get('/', [
        'uses'=>'HomeController@index',
        'as'=>'dashboard'
    ]);
});

Route::group(['middleware'=>'auth', 'prefix'=>'supplier'], function(){
    Route::get('/',[
        'uses'=>'SupplierController@index',
        'as'=>'supplier'
    ]);
    Route::get('data-supplier', [
        'uses' => 'SupplierController@show',
        'as' => 'data-supplier'
    ]);
    Route::post('tambah',[
        'uses'=>'SupplierController@create',
        'as'=>'tambah-supplier'
    ]);
    Route::post('edit',[
        'uses'=>'SupplierController@update',
        'as'=>'edit-supplier'
    ]);
    Route::post('hapus',[
        'uses'=>'SupplierController@destroy',
        'as'=>'hapus-supplier'
    ]);
});

Route::group(['middleware'=>'auth', 'prefix'=>'customer'], function(){
    Route::get('/',[
        'uses'=>'CustomerController@index',
        'as'=>'customer'
    ]);
    Route::get('data-customer', [
        'uses' => 'CustomerController@show',
        'as' => 'data-customer'
    ]);
    Route::post('tambah',[
        'uses'=>'CustomerController@create',
        'as'=>'tambah-customer'
    ]);
    Route::post('edit',[
        'uses'=>'CustomerController@update',
        'as'=>'edit-customer'
    ]);
    Route::post('hapus',[
        'uses'=>'CustomerController@destroy',
        'as'=>'hapus-customer'
    ]);
});

Route::group(['middleware'=>'auth', 'prefix'=>'product'], function(){
    Route::post('select-satuan', [
        'uses' => 'ProductController@carisatuan',
        'as' => 'cari-satuan'
    ]);
    Route::post('select-kategori', [
        'uses' => 'ProductController@carikategori',
        'as' => 'cari-kategori'
    ]);
    Route::post('cari-item', [
        'uses' => 'ProductController@cari',
        'as' => 'cari'
    ]);
    Route::get('/', [
        'uses' => 'ProductController@index',
        'as' => 'product'
    ]);
    Route::get('data-product', [
        'uses' => 'ProductController@show',
        'as' => 'data-product'
    ]);
    Route::get('product-pilih', [
        'uses' => 'ProductController@productpilih',
        'as' => 'product-pilih'
    ]);
    Route::post('tambah',[
        'uses'=>'ProductController@create',
        'as'=>'tambah-product'
    ]);
    Route::post('edit',[
        'uses'=>'ProductController@update',
        'as'=>'edit-product'
    ]);
    Route::post('hapus',[
        'uses'=>'ProductController@destroy',
        'as'=>'hapus-product'
    ]);

    Route::group(['prefix'=>'category'], function(){
        Route::get('/',[
            'uses'=>'CategoryController@index',
            'as'=>'category'
        ]);
        Route::get('data-category', [
            'uses' => 'CategoryController@show',
            'as' => 'data-category'
        ]);
        Route::post('tambah',[
            'uses'=>'CategoryController@create',
            'as'=>'tambah-category'
        ]);
        Route::post('edit',[
            'uses'=>'CategoryController@update',
            'as'=>'edit-category'
        ]);
        Route::post('hapus',[
            'uses'=>'CategoryController@destroy',
            'as'=>'hapus-category'
        ]);
    });

    Route::group(['prefix'=>'unit'], function(){
        Route::get('/',[
            'uses'=>'UnitController@index',
            'as'=>'unit'
        ]);
        Route::get('data-unit', [
            'uses'=>'UnitController@show',
            'as'=>'data-unit'
        ]);
        Route::post('tambah',[
            'uses'=>'UnitController@create',
            'as'=>'tambah-unit'
        ]);
        Route::post('edit',[
            'uses'=>'UnitController@update',
            'as'=>'edit-unit'
        ]);
        Route::post('hapus',[
            'uses'=>'UnitController@destroy',
            'as'=>'hapus-unit'
        ]);
    });
});

Route::group(['middleware'=>'auth', 'prefix'=>'stock'], function(){
    Route::group(['prefix'=>'in'], function(){
        Route::get('/',[
            'uses'=>'StockInController@index',
            'as'=>'stock-in'
        ]);
        Route::get('data',[
            'uses'=>'StockInController@show',
            'as'=>'data-stock-in'
        ]);
        Route::post('tambah',[
            'uses'=>'StockInController@create',
            'as'=>'tambah-stock-in'
        ]);
        Route::post('select-detailitem',[
            'uses'=>'StockInController@caridetailitem',
            'as'=>'select-detailitem'
        ]);
        Route::post('select-supplier',[
            'uses'=>'StockInController@carisupplier',
            'as'=>'select-supplier'
        ]);
    });

    Route::group(['prefix'=>'out'], function(){
        Route::get('/',[
            'uses'=>'StockOutController@index',
            'as'=>'stock-out'
        ]);
        Route::get('data',[
            'uses'=>'StockOutController@show',
            'as'=>'data-stock-out'
        ]);
        Route::post('tambah',[
            'uses'=>'StockOutController@create',
            'as'=>'tambah'
        ]);
        Route::post('select-detailitem',[
            'uses'=>'StockOutController@caridetailitem',
            'as'=>'select-detailitem-out'
        ]);
    });

    Route::get('',[
        'uses'=>'SupplierController@index'
    ]);
});

Route::group(['middleware'=>'auth', 'prefix'=>'transaction'], function(){
    Route::get('/',[
        'uses'=>'TransactionController@index',
        'as'=>'transaction'
    ]);
    Route::get('nota-tgl', [
        'uses' => 'TransactionController@getKodeTransaksi',
        'as' => 'nota-tgl'
    ]);
    Route::post('cari-id', [
        'uses' => 'TransactionController@caribyid',
        'as' => 'cari-id'
    ]);
    Route::post('add-cart', [
        'uses' => 'TransactionController@addcart',
        'as' => 'add-cart'
    ]);
    Route::get('data-cart', [
        'uses' => 'TransactionController@datacart',
        'as' => 'add-cart'
    ]);
    Route::post('delete-cart', [
        'uses' => 'TransactionController@deletecart',
        'as' => 'delete-cart'
    ]);
    Route::post('remove-item', [
        'uses' => 'TransactionController@removeitem',
        'as' => 'remove-item'
    ]);
    Route::get('totalbayar', function(){
        return Response()->json(Cart::subtotal());
    });
    Route::post('bayar', [
        'uses' => 'TransactionController@bayar',
        'as' => 'bayar'
    ]);
});

Route::group(['middleware'=>'auth', 'prefix'=>'report'], function(){
    Route::group(['prefix' => 'sales'], function(){
        Route::get('/',[
            'uses'=>'ReportController@sales',
            'as'=>'sales-report'
        ]);
        Route::post('data-report',[
            'uses'=>'ReportController@datareportsales',
            'as'=>'data-report'
        ]);

        Route::get('salesexcel', [
            'uses'=> 'ReportController@salesexcel',
            'as'=>'salesexcel'
        ]);

    });

    Route::group(['prefix' => 'stockin'], function(){
        Route::get('/',[
            'uses'=>'ReportController@stockin',
            'as'=>'in-report'
        ]);
        Route::get('/data-report',[
            'uses'=>'ReportController@datareportstockin',
            'as'=>'out-report'
        ]);

    });
    Route::group(['prefix' => 'stockout'], function(){
        Route::get('/',[
            'uses'=>'ReportController@stockout',
            'as'=>'stockout-report'
        ]);
        Route::get('/data-report',[
            'uses'=>'ReportController@datareportstockout',
            'as'=>'out-report'
        ]);

    });



    Route::get('/out',[
        'uses'=>'ReportController@stockout',
        'as'=>'out-report'
    ]);
});

Route::group(['middleware'=>'auth', 'prefix'=>'setting'], function(){
    Route::get('/',[
        'uses'=>'SupplierController@index',
        'as'=>'setting'
    ]);

});
