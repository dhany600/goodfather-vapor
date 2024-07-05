<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['checkRole:admin,manager,owner'])->group(
    function () {
        Route::get('/dashboard/chart-data', [DashboardController::class, 'chartData'])->name('dashboard.chart-data');
        Route::get('/dashboard/product-data', [DashboardController::class, 'productData'])->name('dashboard.productData');
        Route::resource('/dashboard', DashboardController::class);
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::get('/transaction-add', [TransactionController::class, 'addTransaction'])->name('transaction.addTransaction');

        Route::get('transaction/data', [TransactionController::class, 'getData'])->name('transaction.data');
        Route::get('transactions/dataTransaction', [TransactionController::class, 'getDataTransaction'])->name('transactions.dataTransaction');
        Route::resource('/transaction', TransactionController::class);

        Route::get('cart/data', [CartController::class, 'getCartData'])->name('cart.data');
        Route::post('cart/add/{id}', [CartController::class, 'addItem'])->name('cart.add');
        Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
        Route::resource('/cart', CartController::class);

        Route::resource('/checkout', CheckoutController::class);

        Route::get('customer/data', [CustomerController::class, 'getData'])->name('customer.getData');
        Route::resource('/customer', CustomerController::class);

        Route::resource('/target', TargetController::class);
        Route::resource('/rating', RatingController::class);

        Route::get('products/data', [ProductController::class, 'getData'])->name('products.data');
        Route::post('products/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
        Route::get('/products/show-data', [ProductController::class, 'getProductsData'])->name('products.getProductsData');
        Route::resource('/product', ProductController::class);

        Route::get('category/{id}/products', [CategoryController::class, 'products'])->name('category.products');
        Route::resource('/category', CategoryController::class);

        Route::resource('/activity-log', ActivityLogController::class);
        Route::get('/employee/show{id}', [EmployeeController::class, 'show'])->name('employee.show');
    }
);

Route::middleware(['checkRole:owner'])->group(
    function () {
        Route::get('/getEmployees', [EmployeeController::class, 'getEmployees'])->name('employee.getEmployees');
        Route::resource('/employee', EmployeeController::class);
    }
);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
