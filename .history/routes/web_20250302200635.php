<?php

use App\Http\Controllers\ApplyController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetReportController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\AuditReportController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\ComposeController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentRequestController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReadController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ReservationVehicleController;
use App\Http\Controllers\SubcontractorAttachmentController;
use App\Http\Controllers\SubcontractorController;
use App\Http\Controllers\SubcontractorRequirementController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierFinancialHealthController;
use App\Http\Controllers\SupplierLegalComplianceController;
use App\Http\Controllers\SupplierProductsServicesController;
use App\Http\Controllers\SupplierReferenceController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\SupplyReportController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleReleaseController;
use App\Http\Controllers\VehicleReservationController;
use App\Http\Controllers\VendorCertificationController;
use App\Http\Controllers\VendorConsentController;
use App\Http\Controllers\VendorContactController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorInvoicingController;
use App\Http\Controllers\VendorReviewController;
use App\Http\Controllers\VendorServiceController;
use App\Models\Asset;
use App\Models\Supply;
use Illuminate\Support\Facades\Route;


// Redirect the root URL to the login page
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'rolemanager:admin'])->name('dashboard');

Route::get('/user/dashboard', function () {
    return view('user');
})->middleware(['auth', 'verified', 'rolemanager:customer'])->name('user');

Route::get('/vendor/dashboard', function () {
    return view('vendor');
})->middleware(['auth', 'verified', 'rolemanager:vendor'])->name('vendor');

Route::get('/superadmin/dashboard', function () {
    return view('superadmin');
})->middleware(['auth', 'verified', 'rolemanager:superadmin'])->name('superadmin');



Route::get('/map', [MapController::class, 'index'])->name('map');


// Route::get('/base', function () {
//     return view('base');
// })->middleware('is_admin:admin');

// Define the login route
Route::get('login', function () {
    return view('auth.login');
})->name('login');


// Vendor Portal
Route::middleware(['auth', 'rolemanager:admin'])->group(function () {
    Route::resource('vendor', VendorController::class);
    Route::resource('auction', AuctionController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('subcontractor', SubcontractorController::class);
    Route::resource('bid', BidController::class);

    // Specific routes for bids
    Route::get('/bids/create/{auction_id}', [BidController::class, 'create'])->name('bid.create');
    Route::post('/bid/store/{auction_id}', [BidController::class, 'store'])->name('bid.store');
});

Route::middleware(['auth', 'rolemanager:admin'])->group(function () {
    
    // Show a specific vendor
    Route::get('/vendor/{id}', [VendorController::class, 'show'])->name('vendor.show');

    // Edit a specific vendor
    Route::get('/vendor/{id}/edit', [VendorController::class, 'edit'])->name('vendor.edit');

    // Update a vendor
    Route::put('/vendor/{id}', [VendorController::class, 'update'])->name('vendor.update');
});

Route::get('/vendor/create', [VendorController::class, 'create'])->name('vendor.create');
Route::post('/vendor', [VendorController::class, 'store'])->name('vendor.store');


Route::get('contacts', [VendorContactController::class, 'index'])->name('vendorcontact.index');
Route::get('vendor/{vendorId}/contact/create', [VendorContactController::class, 'create'])->name('vendorcontact.create');
Route::post('/vendor/{vendorId}/contact', [VendorContactController::class, 'store'])->name('vendorcontact.store');
Route::get('contact/{contact}', [VendorContactController::class, 'show'])->name('vendorcontact.show');
Route::get('contact/{contact}/edit', [VendorContactController::class, 'edit'])->name('vendorcontact.edit');
Route::put('contact/{contact}', [VendorContactController::class, 'update'])->name('vendorcontact.update');
Route::delete('contact/{contact}', [VendorContactController::class, 'destroy'])->name('vendorcontact.destroy');



// Route to display the create form
Route::get('/vendor/{vendorId}/service/create', [VendorServiceController::class, 'create'])->name('vendorservice.create');
    
// Route to store the vendor service
Route::post('/vendor/{vendorId}/service', [VendorServiceController::class, 'store'])->name('vendorservice.store');
    

// Route to display the create form for vendor consent
Route::get('/vendor/{vendorId}/consent/create', [VendorConsentController::class, 'create'])->name('vendorconsent.create');

// Route to store the vendor consent
Route::post('/vendor/{vendorId}/consent', [VendorConsentController::class, 'store'])->name('vendorconsent.store');


Route::get('/vendor/{vendorId}/certification', [VendorCertificationController::class, 'index'])->name('vendorcertification.index');
Route::get('/vendor/{vendorId}/certification/create', [VendorCertificationController::class, 'create'])->name('vendorcertification.create');
Route::post('/vendor/{vendorId}/certification', [VendorCertificationController::class, 'store'])->name('vendorcertification.store');
Route::get('/vendor/{vendorId}/certification/{certificationId}', [VendorCertificationController::class, 'show'])->name('vendorcertification.show');
Route::get('/vendor/{vendorId}/certification/{certificationId}/edit', [VendorCertificationController::class, 'edit'])->name('vendorcertification.edit');
Route::put('/vendor/{vendorId}/certification/{certificationId}', [VendorCertificationController::class, 'update'])->name('vendorcertification.update');
Route::delete('/vendor/{vendorId}/certification/{certificationId}', [VendorCertificationController::class, 'destroy'])->name('vendorcertification.destroy');

// Route to display the create form for vendor invoicing
Route::get('/vendor/{vendorId}/invoicing/create', [VendorInvoicingController::class, 'create'])->name('vendorinvoicing.create');

// Route to store the vendor invoicing
Route::post('/vendor/{vendorId}/invoicing', [VendorInvoicingController::class, 'store'])->name('vendorinvoicing.store');
Route::post('/vendor/{vendorId}/invoicing/store', [VendorInvoicingController::class, 'store'])->name('vendorinvoicing.store');


Route::get('/vendor/{vendorId}/review/create', [VendorReviewController::class, 'create'])->name('vendorreview.create');

// Route for handling the form submission (POST request with vendor_id as a parameter)
Route::post('/vendor/{vendorId}/review/store', [VendorReviewController::class, 'store'])->name('vendorreview.store');



// GET route for displaying the form to create a new supplier
Route::get('supplier/create', [SupplierController::class, 'create'])->name('supplier.create');

// POST route for storing a new supplier in the database
Route::post('supplier', [SupplierController::class, 'store'])->name('supplier.store');

// Additional routes for other resourceful actions can be defined similarly:
Route::get('supplier', [SupplierController::class, 'index'])->name('supplier.index'); // GET: Show all suppliers
Route::get('supplier/{supplier}', [SupplierController::class, 'show'])->name('supplier.show'); // GET: Show single supplier
Route::get('supplier/{supplier}/edit', [SupplierController::class, 'edit'])->name('supplier.edit'); // GET: Edit a supplier
Route::put('supplier/{supplier}', [SupplierController::class, 'update'])->name('supplier.update'); // PUT: Update a supplier
Route::delete('supplier/{supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy'); // DELETE: Delete a supplier



// Routes for Supplier Legal Compliance
Route::get('/legalcompliance/create/{supplier_id}', [SupplierLegalComplianceController::class, 'create'])
    ->name('legalcompliance.create');   
Route::post('/legalcompliance', [SupplierLegalComplianceController::class, 'store'])
    ->name('legalcompliance.store');

    Route::get('/productservice/create/{supplier_id}', [SupplierProductsServicesController::class, 'create'])
    ->name('productservice.create');
Route::post('/productservice', [SupplierProductsServicesController::class, 'store'])
    ->name('productservice.store');

// Route for showing the form to create supplier financial health
Route::get('/financialhealth/create/{supplier_id}', [SupplierFinancialHealthController::class, 'create'])->name('financialhealth.create');

// Route for handling the POST request to store supplier financial health
Route::post('/financialhealth', [SupplierFinancialHealthController::class, 'store'])->name('financialhealth.store');
// GET route to show the form for creating a new supplier reference


// GET route to show the form for creating a new supplier reference
Route::get('supplierreference/create/{supplier_id}', [SupplierReferenceController::class, 'create'])->name('supplierreference.create');

// POST route to store the new supplier reference in the database
Route::post('/supplierreference', [SupplierReferenceController::class, 'store'])->name('supplierreference.store');


Route::get('subcontractor/create', [SubcontractorController::class, 'create'])->name('subcontractor.create'); // Show form to create a subcontractor
Route::post('subcontractor', [SubcontractorController::class, 'store'])->name('subcontractor.store'); // Store a new subcontractor


// Subcontractor Requirements Routes
Route::get('/requirements/create/{subcontractor_id}', [SubcontractorRequirementController::class, 'create'])->name('requirements.create');
Route::post('/requirements/store', [SubcontractorRequirementController::class, 'store'])->name('requirements.store');

// Route to handle creating attachments for a subcontractor
Route::get('/attachments/create/{subcontractor_id}', [SubcontractorAttachmentController::class, 'create'])->name('attachments.create');
Route::post('/attachments/store', [SubcontractorAttachmentController::class, 'store'])->name('attachments.store');


Route::get('/audit-reports', [AuditReportController::class, 'index'])->name('audit.index');
Route::get('/audit-reports/{auditReport}', [AuditReportController::class, 'show'])->name('audit.show');
Route::patch('/audit-reports/{auditReport}', [AuditReportController::class, 'update'])->name('audit.update');

//Audit Management
Route::resource('supply', SupplyController::class);
Route::put('/supply/{supply}', [SupplyController::class, 'update'])->name('supply.update');

Route::get('/api/stock-distribution', function () {
    $stocks = Supply::select('supply_name', 'remaining_stock')->get();

    return response()->json([
        'labels' => $stocks->pluck('supply_name'),
        'data' => $stocks->pluck('remaining_stock'),
    ]);
});

Route::get('/api/asset-distribution', function () {
    $assets = Asset::select('asset_category', \DB::raw('count(*) as total'))->groupBy('asset_category')->get();

    return response()->json([
        'labels' => $assets->pluck('asset_category'),
        'data' => $assets->pluck('total'),
    ]);
});


Route::put('/reservation/{reservation}', [VehicleReservationController::class, 'update'])->name('reservation.update');

Route::get('/reservation/count', [VehicleReservationController::class, 'getReservationCount'])->name('reservation.count');

Route::get('/bid-rate', [BidController::class, 'getBidRate'])->name('bid.rate');

Route::resource('supplyreport', SupplyReportController::class);
Route::put('/supplyreport/{supplyReport}', [SupplyReportController::class, 'update'])->name('supplyreport.update');

Route::resource('assets', AssetController::class);
Route::resource('assetreport', AssetReportController::class);


Route::resource('record', RecordController::class);


//Fleet Management
Route::resource('vehicle', VehicleController::class);
Route::resource('driver', DriverController::class);
Route::put('/drivers/{driver}', [DriverController::class, 'update'])->name('driver.update');

Route::resource('trip', TripController::class);
Route::resource('maintenance', MaintenanceController::class);
Route::resource('fuel', FuelController::class);


//Document Tracking
Route::resource('document', DocumentController::class);
Route::resource('request', DocumentRequestController::class);


//Vehicle Reservation
Route::resource('reservation', VehicleReservationController::class);
Route::resource('release', VehicleReleaseController::class);


Route::get('/event', [EventController::class, 'index'])->name('event');
Route::get('/inbox', [InboxController::class, 'index'])->name('inbox');
Route::get('/compose', [ComposeController::class,'index'])->name('compose');
Route::get('/read', [ReadController::class,'index'])->name('read');
Route::get('/condition', [ConditionController::class,'index'])->name('condition');
Route::get('/apply', [ApplyController::class,'index'])->name('apply');

Route::get('/dashboard', function () { 
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';





Route::get('/unauthorized', function () {
    return response()->view('errors.unauthorized', [], 403);
})->name('unauthorized');







// // Admin Routes
// Route::middleware(['usertype:admin'])->group(function () {
//     Route::get('/admin/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard'); // Define the route name
// });

// // User Routes
// Route::middleware(['usertype:user'])->group(function () {
//     Route::get('/user/dashboard', function () {
//         return view('user.dashboard');
//     })->name('user.dashboard'); // Define the route name
// });


// // Unauthorized Route
// Route::get('/unauthorized', function () {
//     return "You are not authorized to access this page.";
// });


// Route::middleware(['auth', 'usertype:user'])->group(function () {
//     Route::get('/user/vendor/auction', function () {
//         return view('Vendor.Auction.index');
//     })->name('user.vendor.auction');
// });



// Route::middleware(['auth', 'userMiddleware'])->group ( function(){

// Route::get('dashboard',[UserController::class])->name('dashboard');

// });