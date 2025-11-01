<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\BoqPartController;
use App\Http\Controllers\Admin\BoqItemController;
use App\Http\Controllers\Admin\BoqSubItemController;
use App\Http\Controllers\Admin\BoqVersionController;
use App\Http\Controllers\Admin\BoqVersionDetailsController;
use App\Http\Controllers\Admin\BoqVersionExportImportController;
use App\Http\Controllers\Admin\ContractorController;
use App\Http\Controllers\Admin\ContractorUserController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SchemeController;
use App\Http\Controllers\Admin\SchemeOptionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BuyersController;
use App\Http\Controllers\CretificationController;
use App\Http\Controllers\Common\DistrictController;
use App\Http\Controllers\Common\RegionController;
use App\Http\Controllers\Common\UnionController;
use App\Http\Controllers\Common\UpazilaController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductGroupController;
use App\Http\Controllers\ProductSubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\WebsiteSettingController;
use App\Models\product;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

        Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
        Route::get('/product-group/{slug}', [ProductGroupController::class, 'getProductByGroup'])->name('frontend.product_group');
        Route::get('/product-category/{slug}', [ProductCategoryController::class, 'getProductByCategory'])->name('frontend.product_category');

        Route::get('/product-sub-category/{slug}', [ProductSubCategoryController::class, 'getProductBySubCategory'])->name('frontend.product_sub_category');

// Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin'], function () {

    Route::get('/login', [LoginController::class, 'admin_login'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'admin_login_post'])->name('admin.login_post');

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/logout', [LoginController::class, 'admin_logout'])->name('admin.logout');
        
        Route::resource('designation', DesignationController::class)->names('admin.designation');
        Route::resource('department', DepartmentController::class)->names('admin.department');
        Route::resource('pages', PagesController::class)->names('admin.pages');
        Route::resource('sliders', SliderController::class)->names('admin.sliders');
        Route::resource('country', CountryController::class)->names('admin.country');
        Route::resource('buyer', BuyersController::class)->names('admin.buyer');
        Route::resource('team', TeamController::class)->names('admin.team');
        Route::resource('certification', CretificationController::class)->names('admin.certification');
        Route::resource('product-group', ProductGroupController::class)->names('admin.product_group');
        Route::resource('product-category', ProductCategoryController::class)->names('admin.product_category');
        Route::resource('product-sub-category', ProductSubCategoryController::class)->names('admin.product_sub_category');
        Route::resource('product', ProductController::class)->names('admin.product');
        Route::resource('speciality', SpecialityController::class)->names('admin.speciality');


        Route::resource('website-settings',WebsiteSettingController::class)->names('admin.website_settings');




        Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home');
        Route::get('/check-existing-boq-version-details', [BoqVersionDetailsController::class, 'existingBoqVersionDetails'])->name('admin.check_existing_boq_version_details');
        Route::get('/boq-version-details/copy/{id}', [BoqVersionDetailsController::class, 'copy'])->name('admin.boq_version_details.copy');
        Route::get('/boq-version-export-import', [BoqVersionExportImportController::class, 'index'])->name('admin.boq_version_export_import.index');
        Route::get('/boq-version-export-import/export/{version_id}', [BoqVersionExportImportController::class, 'export'])->name('admin.boq_version_export_import.export');
        Route::get('/contractors/add-package/{contractor_id}', [ContractorController::class, 'add_package'])->name('admin.contractors.add_package');
        Route::post('/contractors/add-package/{contractor_id}', [ContractorController::class, 'store_package'])->name('admin.contractors.store_package');
        Route::resource('regions', RegionController::class)->names('admin.regions');
        Route::resource('projects', ProjectController::class)->names('admin.projects');
        Route::resource('packages', PackageController::class)->names('admin.packages');
        Route::resource('scheme-options', SchemeOptionController::class)->names('admin.scheme_options');
        Route::resource('schemes', SchemeController::class)->names('admin.schemes');
        Route::resource('units', UnitController::class)->names('admin.units');
        Route::resource('boq-parts', BoqPartController::class)->names('admin.boq_parts');
        Route::resource('boq-items', BoqItemController::class)->names('admin.boq_items');
        Route::resource('boq-sub-items', BoqSubItemController::class)->names('admin.boq_sub_items');
        Route::resource('boq-versions', BoqVersionController::class)->names('admin.boq_versions');
        Route::resource('boq-version-details', BoqVersionDetailsController::class)->names('admin.boq_version_details');
        Route::resource('contractors', ContractorController::class)->names('admin.contractors');
        Route::resource('contractor-users', ContractorUserController::class)->names('admin.contractor_users');
    });
});



Route::group(['prefix' => 'common'], function () {
    Route::get('/get-category-by-group/{group_id}', [ProductCategoryController::class, 'get_category_by_group'])->name('common.get_category_by_group');
    Route::get('/get-sub-category-by-category/{category_id}', [ProductSubCategoryController::class, 'get_sub_category_by_category'])->name('common.get_sub_category_by_category');

    Route::get('/get-districts-by-division/{division_id}', [DistrictController::class, 'getDistrictsByDivision'])->name('common.get_districts_by_division');
    Route::get('/get-upazilas-by-district/{district_id}', [UpazilaController::class, 'getUpazilasByDistrict'])->name('common.get_upazilas_by_district');
    Route::get('/get-unions-by-upazila/{upazila_id}', [UnionController::class, 'getUnionsByUpazila'])->name('common.get_unions_by_upazila');
    Route::get('/get-boq-items-by-part/{boq_part_id}', [BoqItemController::class, 'getBoqItemsByPart'])->name('common.get_boq_items_by_part');
    Route::get('/get-boq-sub-item-by-boq-items/{boq_item_id}', [BoqSubItemController::class, 'getBoqSubItemsByBoqItem'])->name('common.get_boq_sub_items_by_boq_item');
    Route::get('/get-boq-version-by-boq-package/{package_id}', [BoqVersionController::class, 'getBoqVersionsByPackage'])->name('common.get_boq_versions_by_package');
    Route::get('/get-unit-by-boq-item/{boq_item_id}', [UnitController::class, 'getUnitByBoqItem'])->name('common.get_unit_by_boq_item');
    Route::get('/get-unit-by-boq-sub-item/{boq_sub_item_id}', [UnitController::class, 'getUnitByBoqSubItem'])->name('common.get_unit_by_boq_sub_item');
});


Route::group(['prefix' => 'user'], function () {
    Route::get('/login', [LoginController::class, 'user_login'])->name('user.login');
    Route::post('/login', [LoginController::class, 'user_login_post'])->name('user.login_post');
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/logout', [LoginController::class, 'user_logout'])->name('user.logout');
        Route::get('/', [UserHomeController::class, 'index'])->name('user.home');
    });
});
