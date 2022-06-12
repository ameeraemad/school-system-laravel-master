<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SchoolClassRoomController;
use App\Http\Controllers\SchoolClassRoomStudentController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentParentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherSubjectController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cms')->middleware('guest:admin,school,teacher')->group(function () {
    Route::get('{guard}/login', [UserAuthController::class, 'showLogin'])->name('cms.login');
    Route::post('{guard}/login', [UserAuthController::class, 'login']);
});

Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {
    Route::resource('cities', CityController::class);

    Route::resource('schools', SchoolController::class);

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);

    Route::resource('role.permissions', RolePermissionController::class);
});

Route::prefix('cms/admin')->middleware('auth:admin,school,teacher')->group(function () {
    Route::view('', 'cms.parent')->name('cms.admin');
    Route::resource('subjects', SubjectController::class);
    Route::resource('class-rooms', ClassRoomController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('student-parents', StudentParentController::class);
    Route::resource('students', StudentController::class);
    Route::get('logout', [UserAuthController::class, 'logout'])->name('cms.logout');
});

Route::prefix('cms/admin')->middleware('auth:school')->group(function () {
    Route::resource('schools-class-rooms', SchoolClassRoomController::class);
    Route::resource('school-class-rooms.students', SchoolClassRoomStudentController::class);
    Route::resource('teacher.subjects', TeacherSubjectController::class);
});
