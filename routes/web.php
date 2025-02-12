<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PedidoController@home')->name('home');

Route::middleware(['auth'])->group(function () {
    // Settings
    Route::get('/settings', 'SettingsController@index')->name('settings.index');
    Route::get('/settings/settings', function () {
        return view('settings.settings');
    })->name('settings.settings');

    Route::prefix('settings')->group(function () {
        Route::resource('mesas', 'MesaController');
    });

    // Resources
    Route::resource('estoques', 'EstoqueController');
    Route::resource('categorias', 'CategoriaController');
    Route::resource('clientes', 'ClienteController');
    Route::resource('produtos', 'ProdutoController');
    Route::resource('ingredientes', 'IngredienteController');
    Route::resource('fornecedores', 'FornecedorController');
    Route::resource('users', 'UserController');

    Route::get('/produtos/{id}', 'ProdutoController@show')->name('produtos.show');

    // Estoque
    Route::get('/estoque', 'EstoqueController@index')->name('estoque.index');
    Route::put('/estoque/produto/{id}', 'EstoqueController@updateProduto')->name('estoque.updateProduto');
    Route::put('/estoque/ingrediente/{id}', 'EstoqueController@updateIngrediente')->name('estoque.updateIngrediente');

    // Pedido
    Route::prefix('pedidos')->group(function () {
        Route::post('/', 'PedidoController@store')->name('pedidos.store');
        Route::get('/{id_mesa}', 'PedidoController@show')->name('pedidos.show');
        Route::post('/{id}/finalizar', 'PedidoController@finalizarPedido')->name('pedidos.finalizar');
    });
    

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

require __DIR__ . '/auth.php';
