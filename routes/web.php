<?php
use App\Http\Livewire\Cashout;
use App\Http\Livewire\Reports;
use App\Http\Livewire\Permisos;
use App\Http\Livewire\Roles;
use App\Http\Livewire\Users;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Products;
use App\Http\Livewire\Categories;
use App\Http\Livewire\Coins;
use App\Http\Livewire\Pos;
use App\Http\Livewire\Asignar;
use App\Http\Controllers\ExportController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::group(['middleware' => ['role:Admin']], function () {
    Route::get('roles', Roles::class);
    Route::get('permisos', Permisos::class);
    Route::get('asignar', Asignar::class);
    Route::get('users', Users::class);
    });

    Route::get('categories', Categories::class);  //->middleware('role:Employee');
    Route::get('products', Products::class);
    Route::get('pos', Pos::class);

    Route::get('coins', Coins::class);
    Route::get('cashout', Cashout::class);
    Route::get('reports', Reports::class);

    //REPORTES PDF
    Route::get('report/pdf/{user}/{type}/{f1}/{f2}', [ExportController::class, 'reportPDF']);
    Route::get('report/pdf/{user}/{type}', [ExportController::class, 'reportPDF']);

    //REPORTES EXCEL
    Route::get('report/excel/{user}/{type}/{f1}/{f2}', [ExportController::class, 'reportExcel']);
    Route::get('report/excel/{user}/{type}', [ExportController::class, 'reportExcel']);

    //REPORTES VENTAS
    Route::get('report/venta/{cart}', [ExportController::class, 'reportVenta']);
    //Route::get('report/venta/{total}/{itemQuantity}/{efectivo}/{change}/{cart}', [ExportController::class, 'reportVenta']);
    //Route::get('report/venta/{user}/{type}', [ExportController::class, 'reportVenta']);

    //Route::get('/imprimir-venta/{sale}', 'pos@printTicket')->name('printTicket');
    //$total, $itemsQuantity, $efectivo, $change;

});
