<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Admin\MyAccountsController as AdminMyAccounts;
use App\Http\Controllers\Admin\StudentsController as AdminStudents;
use App\Http\Controllers\Students\MyAccountController as StudentsMyAccount;
use App\Http\Controllers\Teachers\MyAccountController as TeachersMyAccount;
use App\Http\Controllers\Admin\AcademicsController;
use App\Http\Controllers\Admin\MasterDatasController;

use App\Http\Controllers\TestController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/test', [TestController::class, 'index']);

//-------------------- WEBSITE prefix and urls --------------------

Route::controller(HomeController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/about-us', 'aboutUs')->name('about_us');
    Route::get('/contact-us', 'contactUs')->name('contact_us');
    Route::get('/students', 'contactUs')->name('contact_us');
   
});

//-------------------- ADMIN prefix and urls --------------------
Route::prefix('admin')->group(function () {

    Route::controller(AdminMyAccounts::class)->group(function () {

        Route::get('/', 'login')->name('admin.login');
        Route::post('/do-login', 'doLogin')->name('admin.doLogin');
        Route::get('/logout', 'logout')->name('admin.logout');
        Route::get('/dashboard', 'dashboard')->name('admin.dashboard')->middleware(['auth.admin']);
       // Route::get('/students-list', 'studentList')->name('admin.students.list')->middleware('auth.admin');

       
    });

    Route::middleware(['auth.admin'])->controller(AdminStudents::class)->prefix('students')->group(function () {

        Route::get('/', 'list')->name('admin.students.list');
        Route::get('/add-edit-student/{studentId?}', 'addEdit')->name('admin.students.add_edit');
        Route::post('/save-student', 'saveStudent')->name('admin.students.saveStudent');
        Route::put('/update-student', 'updateStudent')->name('admin.students.updateStudent');
        Route::get('/fees/{studentId}', 'feeDetails')->name('admin.students.fees');
        Route::get('/details/{studentId}', 'details')->name('admin.students.details');
        Route::get('/edit-academic-details/{academicDetailsId}', 'editAcademicDetails')->name('admin.students.editAcademicDetails');
        Route::post('/update-academic-details', 'updateAcademicDetails')->name('admin.students.updateAcademicDetails');
        Route::get('/promote-to-next-class/{studentId}', 'promoteToNextClass')->name('admin.students.promoteToNextClass');
        Route::get('/assign-fees/{studentId}', 'assignFees')->name('admin.students.assignFees');
        Route::get('/show-fees/{studentId}', 'displayFees')->name('admin.students.displayFees');
        Route::post('/payment-details', 'paymentDetails')->name('admin.students.paymentDetails');
        Route::post('/make-payment', 'makePayment')->name('admin.students.makePayment');
        
    });

    Route::middleware(['auth.admin'])->controller(MasterDatasController::class)->prefix('master-data')->group(function () {

        Route::get('/academic-fees/{academic_session_id?}', 'academicFees')->name('admin.masterdata.academicFees');
        Route::get('/assign-class-fees', 'assignClassFees')->name('admin.masterdata.assignClassFees');
        Route::post('/save-class-fees', 'saveClassFees')->name('admin.masterdata.saveClassFees');
       // Route::get('/fees/{studentId}', 'feeDetails')->name('admin.masterdata.fees');
       // Route::get('/details/{studentId}', 'details')->name('admin.masterdata.details');
        
    });
});


//-------------------- STUDENTS prefix and urls --------------------
Route::prefix('students')->group(function () {
    Route::controller(StudentsMyAccount::class)->group(function () {

        Route::get('/', 'login')->name('students.login');
        Route::post('/do-login', 'doLogin')->name('students.doLogin');
        Route::get('/logout', 'logout')->name('students.logout');
        Route::get('/my-account', 'myAccount')->name('students.myAccount')->middleware(['auth.students']);

       
    });
});





//-------------------- TEACHERS prefix and urls --------------------

Route::prefix('teachers')->group(function () {
    Route::controller(TeachersMyAccount::class)->group(function () {

        Route::get('/', 'login')->name('teachers.login');
        Route::post('/do-login', 'doLogin')->name('teachers.doLogin');
        Route::get('/logout', 'logout')->name('teachers.logout');
        Route::get('/dashboard', 'dashboard')->name('teachers.dashboard')->middleware(['auth.teachers']);
        Route::get('/my-account', 'myAccount')->name('teachers.myAccount')->middleware(['auth.teachers']);
       
    });
});


// --------------------------------



