<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
// use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Cache\RateLimiting\Limit;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RolesPermissionController;
use App\Http\Controllers\WarehouseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('login', [LoginController::class, 'login']);

  
// Route::post('users', [UserController::class, 'store']);

Route::middleware(['auth:api','is_god_mode' , 'lang'])->group(function(){

    Route::post('logout',[LoginController::class,'logout']);
    Route::controller(RolesPermissionController::class)->group(function () {

        Route::get('/user/roles', 'getUserRolesPermissions');
   
            Route::post('/roles/update', 'updateUserRolesPermissions');
            Route::get('/roles/revoke', 'revokeUserRolesPermissions');
        
        Route::apiResource('posts' , PostController::class);
        Route::apiResource('comments' , CommentController::class);
        Route::apiResource('areas' , AreaController::class);
        Route::apiResource('warehouses' , WarehouseController::class);
        Route::get('area/warehouses' , [AreaController::class , 'areaWarehouses']);
        Route::get('countries' , [CountryController::class , 'index']);

        Route::apiResource('roles' , RolesPermissionController::class);
        Route::apiResource('users' , UserController::class);
        Route::get('roles' , 'getRoles');
        Route::post('role/{role_id}/permissions' , 'assignRolePermissions');
    
       
        Route::post('/roles/assign', 'assignUserRoles');
    });
    
    Route::get('/generate-report' , [ReportController::class,'geenrateReport'])->middleware('is_admin');
    Route::post('/send-sms', [SMSController::class, 'sendSMS']);
    Route::post('/image-resize', [ImageController::class , 'resize']);
    Route::apiResource('users' , UserController::class)->only('index');
    Route::post('sendNotification', NotificationController::class)->name('send.notification');
    Route::post('/item-create', [ItemController::class, 'create'])->name('item-create');
    Route::post('/image-store', [ImageController::class,'store']);
    Route::get('settings' , [SettingController::class,'index']);
    Route::post('settings' , [SettingController::class,'setSettings']);

  

});

Route::get('orders' , [OrderController::class , 'index'])->name('orders.index');
