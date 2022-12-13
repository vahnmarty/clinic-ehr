<?php

declare(strict_types=1);

use App\Http\Livewire\InputVitalSign;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Station\CheckIn;
use App\Http\Controllers\PdfController;
use App\Http\Livewire\Patient\EditParent;
use App\Http\Livewire\Patient\EditPatient;
use App\Http\Livewire\Patient\ShowPatient;
use App\Http\Livewire\Station\EditResearch;
use App\Http\Livewire\Station\ResearchForms;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Station\PatientDetails;
use App\Http\Livewire\Pharmacy\ManageProducts;
use App\Http\Livewire\Station\PatientVitalSign;
use App\Http\Livewire\Station\ClinicalEncounter;
use App\Http\Livewire\Pharmacy\ManageLaboratories;
use App\Http\Livewire\Research\IntermittentHealthForm;
use App\Http\Livewire\Station\Research\ViewResearchForm;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {


    Route::get('/', function () {
        return redirect()->route('login');
    });

    require __DIR__.'/auth.php';

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    
    Route::group(['middleware' => ['auth']], function(){

        Route::get('patient/{id}', ShowPatient::class)->name('patient.show');
        Route::get('patient/{id}/edit', EditPatient::class)->name('patient.edit');
        Route::get('patient/{id}/vital-sign', InputVitalSign::class)->name("patient.vital-sign");
        Route::get('patient/{id}/parent/{parentId}', EditParent::class)->name('patient.edit-parent');
        
    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'station'], function(){

        Route::get('check-in', CheckIn::class)->name('station.checkin');
        Route::get('patient-details', PatientDetails::class)->name('station.patient-details');
        Route::get('vital-sign', PatientVitalSign::class)->name('station.vital-sign');
        Route::get('clinical-encounter', ClinicalEncounter::class)->name('station.clinical-encounter');


        // Research Forms
        Route::get('research/{patientId?}', ResearchForms::class)->name('station.research');
        Route::get('research/{patientId}/view/{researchId}', ViewResearchForm::class)->name('station.research.show');
        Route::get('research/{patientId}/IntermittentHealthForm', IntermittentHealthForm::class)->name('station.research.intermittent-health-form');
        Route::get('research/{researchId}/edit', EditResearch::class);
        Route::get('research/{patientId}/IntermittentHealthForm/{researchId?}/edit', IntermittentHealthForm::class)->name('station.research.intermittent-health-form.edit');
        
    });

    Route::get('pdf/research/{id}', [PdfController::class, 'research']);


    Route::get('pharmacy/products', ManageProducts::class);
    Route::get('pharmacy/laboratories', ManageLaboratories::class);


});
