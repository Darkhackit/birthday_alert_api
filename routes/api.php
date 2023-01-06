<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me', 'me');

});
//Employee
Route::post('employee/create',[\App\Http\Controllers\EmployeeController::class,'create'])->middleware('auth:api');
Route::get('employee',[\App\Http\Controllers\EmployeeController::class,'index'])->middleware('auth:api');
Route::get('employee/show/{employee}',[\App\Http\Controllers\EmployeeController::class,'show'])->middleware('auth:api');
Route::post('employee/update',[\App\Http\Controllers\EmployeeController::class,'update'])->middleware('auth:api');
Route::get('employee/delete/{employee}',[\App\Http\Controllers\EmployeeController::class,'delete'])->middleware('auth:api');
Route::get('employee/get_this_month_employees',[\App\Http\Controllers\EmployeeController::class,'get_this_month_employees'])->middleware('auth:api');
Route::get('employee/get_tomorrow_employees',[\App\Http\Controllers\EmployeeController::class,'get_tomorrow_employees'])->middleware('auth:api');
Route::get('employee/get_today_employees',[\App\Http\Controllers\EmployeeController::class,'get_today_employees'])->middleware('auth:api');

//Branch
Route::post('branch/create',[\App\Http\Controllers\BranchController::class,'create'])->middleware('auth:api');
Route::get('branch',[\App\Http\Controllers\BranchController::class,'index'])->middleware('auth:api');
Route::get('branch/show/{employee}',[\App\Http\Controllers\BranchController::class,'show'])->middleware('auth:api');
Route::post('branch/update',[\App\Http\Controllers\BranchController::class,'update'])->middleware('auth:api');
Route::get('branch/delete/{employee}',[\App\Http\Controllers\BranchController::class,'delete'])->middleware('auth:api');
Route::get('branch/get_branch_employees',[\App\Http\Controllers\BranchController::class,'get_branch_employees'])->middleware('auth:api');

