<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Joonas1234\NovaSettings\Http\Controllers\SettingsController;

Route::post('settings', SettingsController::class.'@update');
Route::get('settings', SettingsController::class.'@index');