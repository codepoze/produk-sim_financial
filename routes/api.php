<?php

use App\Http\Controllers\api\Project;
use Illuminate\Support\Facades\Route;

// untuk project
Route::get('/project/{any}', [Project::class, 'index']);
Route::get('/project/detail/{id}', [Project::class, 'detail']);