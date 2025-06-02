<?php

use App\Http\Controllers\API\DeviceController;
use Illuminate\Support\Facades\Route;

Route::post('register/device', [DeviceController::class, 'registerDevice']);



