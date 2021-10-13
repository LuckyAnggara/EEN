<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DumasController;
use App\Http\Controllers\HukdisController;
use App\Http\Controllers\IKUController;
use App\Http\Controllers\IKKController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PenyelesaianLhpController;
use App\Http\Controllers\RealisasiAnggaranController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\KinerjaLainnyaController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\TemuanEksternalController;
use App\Http\Controllers\TemuanInternalController;

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

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('down', [KegiatanController::class, 'list'])->name('down');
Route::get('unauthorized-page', [PageController::class, 'unauthorizedPage'])->name('unauthorized-page');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/',[AuthController::class, 'loginView'])->name('login-view');

Route::middleware('loggedin')->group(function() {
    Route::get('login', [AuthController::class, 'loginView'])->name('login-view');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'registerView'])->name('register-view');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});


Route::middleware('user')->group(function() {
    //DASHBOARD
    Route::get('/dashboard-user', [DashboardController::class, 'dashboardUser'])->name('dashboard-user');
    //IKU
    Route::get('input-form-iku', [IKUController::class, 'input'])->name('input-form-iku');
    Route::get('list-iku', [IKUController::class, 'list'])->name('list-iku');
    Route::get('/iku/{id}/delete', [IKUController::class, 'destroy'])->name('delete-iku');
    Route::post('/iku/store', [IKUController::class, 'store'])->name('store-iku');
    //IKK
    Route::get('input-form-ikk', [IKKController::class, 'input'])->name('input-form-ikk');
    Route::get('list-ikk', [IKKController::class, 'list'])->name('list-ikk');
    Route::get('/ikk/{id}/delete', [IKKController::class, 'destroy'])->name('delete-ikk');
    Route::post('/ikk/store', [IKKController::class, 'store'])->name('store-ikk');
    //KEGIATAN
    Route::get('input-form-kegiatan', [KegiatanController::class, 'input'])->name('input-form-kegiatan');
    Route::get('generate', [KegiatanController::class, 'generateDocx'])->name('input-form-kegiatan');
    Route::get('list-kegiatan', [KegiatanController::class, 'list'])->name('list-kegiatan');
    Route::get('/kegiatan/{id}/delete', [KegiatanController::class, 'destroy'])->name('delete-kegiatan');
    Route::post('/kegiatan/store', [KegiatanController::class, 'store'])->name('store-kegiatan');
    //LHP
    Route::get('input-form-penyelesaian-lhp', [PenyelesaianLhpController::class, 'input'])->name('input-form-penyelesaian-lhp');
    Route::get('list-penyelesaian-lhp', [PenyelesaianLhpController::class, 'list'])->name('list-penyelesaian-lhp');
    Route::get('/penyelesaian-lhp/{id}/delete', [PenyelesaianLhpController::class, 'destroy'])->name('delete-penyelesaian-lhp');
    Route::post('/penyelesaian-lhp/store', [PenyelesaianLhpController::class, 'store'])->name('store-penyelesaian-lhp');
    //DUMAS
    Route::get('input-form-dumas', [DumasController::class, 'input'])->name('input-form-dumas');
    Route::get('/dumas/edit/{bulan}', [DumasController::class, 'edit'])->name('edit-form-dumas');
    Route::get('list-dumas', [DumasController::class, 'list'])->name('list-dumas');
    Route::post('/dumas/store', [DumasController::class, 'store'])->name('store-dumas');
    Route::post('/dumas/update', [DumasController::class, 'update'])->name('update-dumas');
    Route::delete('/dumas/delete/{bulan}', [DumasController::class, 'destroy'])->name('delete-dumas');
    //HUKDIS
    Route::get('input-form-hukdis', [HukdisController::class, 'input'])->name('input-form-hukdis');
    Route::get('/hukdis/edit/{bulan}', [HukdisController::class, 'edit'])->name('edit-form-hukdis');
    Route::get('list-hukdis', [HukdisController::class, 'list'])->name('list-hukdis');
    Route::post('/hukdis/store', [HukdisController::class, 'store'])->name('store-hukdis');
    Route::post('/hukdis/update', [HukdisController::class, 'update'])->name('update-hukdis');
    Route::delete('/hukdis/delete/{bulan}', [HukdisController::class, 'destroy'])->name('delete-hukdis');
    //KOMPETENSI
    Route::get('input-form-kompetensi', [KompetensiController::class, 'input'])->name('input-form-kompetensi');
    Route::get('list-kompetensi', [KompetensiController::class, 'list'])->name('list-kompetensi');
    Route::get('/kompetensi/{id}/delete', [KompetensiController::class, 'destroy'])->name('delete-kompetensi');
    Route::post('/kompetensi/store', [KompetensiController::class, 'store'])->name('store-kompetensi');
    //TINDAK LANJUT TEMUAN EKSTERNAL
    Route::get('input-form-temuan-eksternal', [TemuanEksternalController::class, 'input'])->name('input-form-temuan-eksternal');
    Route::get('list-temuan-eksternal', [TemuanEksternalController::class, 'list'])->name('list-temuan-eksternal');
    Route::get('/temuan-eksternal/{id}/delete', [TemuanEksternalController::class, 'destroy'])->name('delete-temuan-eksternal');
    Route::post('/temuan-eksternal/store', [TemuanEksternalController::class, 'store'])->name('store-temuan-eksternal');
    //TINDAK LANJUT TEMUAN INTERNAL
    Route::get('input-form-temuan-internal', [TemuanInternalController::class, 'input'])->name('input-form-temuan-internal');
    Route::get('list-temuan-internal', [TemuanInternalController::class, 'list'])->name('list-temuan-internal');
    Route::get('/temuan-internal/{id}/delete', [TemuanInternalController::class, 'destroy'])->name('delete-temuan-internal');
    Route::post('/temuan-internal/store', [TemuanInternalController::class, 'store'])->name('store-temuan-internal');
    //REALISASI ANGGARAN
    Route::get('input-form-realisasi-anggaran', [RealisasiAnggaranController::class, 'input'])->name('input-form-realisasi-anggaran');
    Route::get('list-realisasi-anggaran', [RealisasiAnggaranController::class, 'list'])->name('list-realisasi-anggaran');
    Route::get('/realisasi-anggaran/{id}/delete', [RealisasiAnggaranController::class, 'destroy'])->name('delete-realisasi-anggaran');
    Route::post('/realisasi-anggaran/store', [RealisasiAnggaranController::class, 'store'])->name('store-realisasi-anggaran');  
    //KINERJA LAINNYA
    Route::get('input-form-kinerja-lainnya', [KinerjaLainnyaController::class, 'input'])->name('input-form-kinerja-lainnya');
    Route::get('list-kinerja-lainnya', [KinerjaLainnyaController::class, 'list'])->name('list-kinerja-lainnya');
    Route::get('/kinerja-lainnya/{id}/delete', [KinerjaLainnyaController::class, 'destroy'])->name('delete-kinerja-lainnya');
    Route::post('/kinerja-lainnya/store', [KinerjaLainnyaController::class, 'store'])->name('store-kinerja-lainnya');
    //UMUM
    Route::get('input-form-surat-masuk', [SuratMasukController::class, 'input'])->name('input-form-surat-masuk');
    Route::get('list-surat-masuk', [SuratMasukController::class, 'list'])->name('list-surat-masuk');
    Route::get('/surat-masuk/{id}/delete', [SuratMasukController::class, 'destroy'])->name('delete-surat-masuk');
    Route::post('/surat-masuk/store', [SuratMasukController::class, 'store'])->name('store-surat-masuk');

    Route::get('dashboard-overview-1-page', [PageController::class, 'dashboardOverview1'])->name('dashboard-overview-1');
    Route::get('dashboard-overview-2-page', [PageController::class, 'dashboardOverview2'])->name('dashboard-overview-2');
    Route::get('dashboard-overview-3-page', [PageController::class, 'dashboardOverview3'])->name('dashboard-overview-3');
    Route::get('inbox-page', [PageController::class, 'inbox'])->name('inbox');
    Route::get('file-manager-page', [PageController::class, 'fileManager'])->name('file-manager');
    Route::get('point-of-sale-page', [PageController::class, 'pointOfSale'])->name('point-of-sale');
    Route::get('chat-page', [PageController::class, 'chat'])->name('chat');
    Route::get('post-page', [PageController::class, 'post'])->name('post');
    Route::get('calendar-page', [PageController::class, 'calendar'])->name('calendar');
    Route::get('crud-data-list-page', [PageController::class, 'crudDataList'])->name('crud-data-list');
    Route::get('crud-form-page', [PageController::class, 'crudForm'])->name('crud-form');
    Route::get('users-layout-1-page', [PageController::class, 'usersLayout1'])->name('users-layout-1');
    Route::get('users-layout-2-page', [PageController::class, 'usersLayout2'])->name('users-layout-2');
    Route::get('users-layout-3-page', [PageController::class, 'usersLayout3'])->name('users-layout-3');
    Route::get('profile-overview-1-page', [PageController::class, 'profileOverview1'])->name('profile-overview-1');
    Route::get('profile-overview-2-page', [PageController::class, 'profileOverview2'])->name('profile-overview-2');
    Route::get('profile-overview-3-page', [PageController::class, 'profileOverview3'])->name('profile-overview-3');
    Route::get('wizard-layout-1-page', [PageController::class, 'wizardLayout1'])->name('wizard-layout-1');
    Route::get('wizard-layout-2-page', [PageController::class, 'wizardLayout2'])->name('wizard-layout-2');
    Route::get('wizard-layout-3-page', [PageController::class, 'wizardLayout3'])->name('wizard-layout-3');
    Route::get('blog-layout-1-page', [PageController::class, 'blogLayout1'])->name('blog-layout-1');
    Route::get('blog-layout-2-page', [PageController::class, 'blogLayout2'])->name('blog-layout-2');
    Route::get('blog-layout-3-page', [PageController::class, 'blogLayout3'])->name('blog-layout-3');
    Route::get('pricing-layout-1-page', [PageController::class, 'pricingLayout1'])->name('pricing-layout-1');
    Route::get('pricing-layout-2-page', [PageController::class, 'pricingLayout2'])->name('pricing-layout-2');
    Route::get('invoice-layout-1-page', [PageController::class, 'invoiceLayout1'])->name('invoice-layout-1');
    Route::get('invoice-layout-2-page', [PageController::class, 'invoiceLayout2'])->name('invoice-layout-2');
    Route::get('faq-layout-1-page', [PageController::class, 'faqLayout1'])->name('faq-layout-1');
    Route::get('faq-layout-2-page', [PageController::class, 'faqLayout2'])->name('faq-layout-2');
    Route::get('faq-layout-3-page', [PageController::class, 'faqLayout3'])->name('faq-layout-3');
    Route::get('login-page', [PageController::class, 'login'])->name('login');
    Route::get('register-page', [PageController::class, 'register'])->name('register');
    Route::get('error-page-page', [PageController::class, 'errorPage'])->name('error-page');
    Route::get('update-profile-page', [PageController::class, 'updateProfile'])->name('update-profile');
    Route::get('change-password-page', [PageController::class, 'changePassword'])->name('change-password');
    Route::get('regular-table-page', [PageController::class, 'regularTable'])->name('regular-table');
    Route::get('tabulator-page', [PageController::class, 'tabulator'])->name('tabulator');
    Route::get('modal-page', [PageController::class, 'modal'])->name('modal');
    Route::get('slide-over-page', [PageController::class, 'slideOver'])->name('slide-over');
    Route::get('notification-page', [PageController::class, 'notification'])->name('notification');
    Route::get('accordion-page', [PageController::class, 'accordion'])->name('accordion');
    Route::get('button-page', [PageController::class, 'button'])->name('button');
    Route::get('alert-page', [PageController::class, 'alert'])->name('alert');
    Route::get('progress-bar-page', [PageController::class, 'progressBar'])->name('progress-bar');
    Route::get('tooltip-page', [PageController::class, 'tooltip'])->name('tooltip');
    Route::get('dropdown-page', [PageController::class, 'dropdown'])->name('dropdown');
    Route::get('typography-page', [PageController::class, 'typography'])->name('typography');
    Route::get('icon-page', [PageController::class, 'icon'])->name('icon');
    Route::get('loading-icon-page', [PageController::class, 'loadingIcon'])->name('loading-icon');
    Route::get('regular-form-page', [PageController::class, 'regularForm'])->name('regular-form');
    Route::get('datepicker-page', [PageController::class, 'datepicker'])->name('datepicker');
    Route::get('tom-select-page', [PageController::class, 'tomSelect'])->name('tom-select');
    Route::get('file-upload-page', [PageController::class, 'fileUpload'])->name('file-upload');
    Route::get('wysiwyg-editor-page', [PageController::class, 'wysiwygEditor'])->name('wysiwyg-editor');
    Route::get('validation-page', [PageController::class, 'validation'])->name('validation');
    Route::get('chart-page', [PageController::class, 'chart'])->name('chart');
    Route::get('slider-page', [PageController::class, 'slider'])->name('slider');
    Route::get('image-zoom-page', [PageController::class, 'imageZoom'])->name('image-zoom');
});

Route::middleware('admin')->group(function() {
    //DASHBOARD
    Route::get('/dashboard-admin', [DashboardController::class, 'dashboardAdmin'])->name('dashboard-admin');
    //LAPORAN
    Route::get('/laporan-inspektorat-jenderal', [LaporanController::class, 'inputUnit'])->name('laporan-inspektorat-jenderal');
    Route::get('/download-laporan', [LaporanController::class, 'downloadLaporan'])->name('download-laporan');
    Route::get('/data/{bulan}', [LaporanController::class, 'dataSuratMasuk'])->name('data-iku');
    Route::get('/data-kegiatan', [LaporanController::class, 'dataPenyelesaianLHP'])->name('data-kegiatan');
    Route::post('/upload-template-laporan', [LaporanController::class, 'uploadTemplate'])->name('upload-template-laporan');
});
