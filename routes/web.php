<?php

use App\Http\Controllers\DBBackupController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PlottingController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\IssuesController;
use App\Http\Controllers\MilestoneController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NilaiFaseController;
use App\Http\Controllers\PenilaianMingguan;
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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/lading', function () {
    return view('lading');
});

Route::permanentRedirect('/', '/lading');

Route::get('/login', function () {
    return view('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('profil', ProfilController::class)->except('destroy');
Route::get('/Search', [AdminController::class, 'search']);
Route::get('/Search_Mahasiswa', [AdminController::class, 'search_Mahasiswa']);
Route::get('/Dosen_Pengampu', [AdminController::class, 'dosen_pengampu']);
Route::get('nilai-mingguan/{project_id}/{kode_matakuliah}/edit', [PenilaianMingguan::class, 'edit'])->name('nilai-mingguan.custom_edit');
Route::get('/manage-dosen/rekap/{project_id}', [NilaiFaseController::class, 'rekap'])->name('manage-dosen.rekap');
Route::get('/nilai-mingguan/rekap/{project_id}/{kode_matakuliah}', [PenilaianMingguan::class, 'rekap'])->name('nilai-mingguan.rekap');
Route::post('/get-aspek-by-fase', [NilaiFaseController::class, 'getAspekByFase'])->name('get.aspek.by.fase');
Route::get('/manage-dosen/edit/{project_id}', [NilaiFaseController::class, 'edit'])->name('manage-dosen.edit');
Route::get('/manage-dosen/detail/{project_id}', [NilaiFaseController::class, 'detail'])->name('manage-dosen.detail');
Route::get('/manage-penilaianmingguan/detail/{project_id}', [PenilaianMingguan::class, 'detail'])->name('manage-penilaianmingguan.detail');


Route::resource('manage-user', UserController::class);
Route::resource('manage-admin', AdminController::class);
Route::resource('manage-dosen', NilaiFaseController::class);
Route::resource('nilai-mingguan', PenilaianMingguan::class);
Route::post('/nilai-ujian', [PenilaianMingguan::class, 'ujian'])->name('nilai.ujian');
Route::resource('manage-role', RoleController::class);
Route::resource('manage-menu', MenuController::class);
Route::resource('manage-plotting', PlottingController::class);
Route::resource('manage-project', MahasiswaController::class);
Route::resource('manage-milestone', MilestoneController::class);
Route::resource('manage-issues', IssuesController::class);
Route::post('/issues/update', [IssuesController::class, 'store'])->name('issues.update');
Route::post('manage-issues/store/{milestone_id}', [IssuesController::class, 'store'])->name('manage-issue.store');
Route::get('manage-issues/{milestone_id}', [IssuesController::class, 'show'])->name('manage-issues.show');
Route::get('/manage-project/{project_id}/{nip}', [MahasiswaController::class, 'show'])->name('manage-project.show');
Route::get('/manage-milestone/insert/{project_id}', [MahasiswaController::class, 'create'])->name('manage-project.create');
Route::get('/manage-project/{milestone_id}/detail', [MahasiswaController::class, 'show'])->name('manage-project.detail');
Route::get('/fetch-issues/{milestoneId}', [MahasiswaController::class, 'fetchIssues']);
Route::post('/update-issues', [MahasiswaController::class, 'updateIssues'])->name('update-issues');
Route::get('manage-issues/insert/{milestone_id}', [IssuesController::class, 'create'])->name('manage-issue.create');
Route::post('manage-milestone', [IssuesController::class, 'store'])->name('milestone.store');
Route::resource('manage-permission', PermissionController::class)->only('store', 'destroy');
Route::get('/manage-plotting/{project_id}', 'PlottingController@detail')->name('manage-plotting.detail');
Route::delete('/hapus-dosen-pengampu/{id_dosen_pengampu}', [AdminController::class, 'hapus']);
Route::post('/issues/update/{milestone_id}', [IssuesController::class, 'update'])->name('issues.update');
Route::delete('/manage-project/{project_id}/{milestone_id}', [MahasiswaController::class, 'destroy'])->name('manage-project.destroy');
Route::post('/export', [ExportController::class, 'export'])->name('export');

Route::get('dbbackup', [DBBackupController::class, 'DBDataBackup']);