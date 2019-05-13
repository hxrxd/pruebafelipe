<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Municipality;

use Maatwebsite\Excel\Facades\Excel;

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

// Authentication routes...

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login','Auth\AuthController@postLogin');

Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');





Route::get('/diagnostics/cohort/{current_cohort}', 'DxController@getDxByCohort');

Route::get('/information/create/ajax-state',function()
{
    $id_departament = Input::get('id_departament');
    $subcategories = Municipality::where('id_departament','=', $id_departament)->get();
    return $subcategories;

});

Route::resource('municipality', 'MunicipalityController');
Route::resource('supervisore','SupervisorE');
Route::resource('users','UserController');
Route::resource('teams','TeamController');
Route::resource('headquarters','HeadquartersController');
Route::resource('student','StudentController');
Route::resource('cohortes','CohorteController');
Route::resource('references','ReferenciasController');
Route::resource('studentg','StudentGestorController');
Route::resource('agreement','AgreementController');
Route::resource('log','LogController');
Route::resource('contract','ContratosController');
Route::resource('engagement','EngagementController');
Route::resource('gestor','GestorController');
Route::resource('payments','PaymentsController');
Route::resource('supervisorstudent','SupervisorStudentController');
Route::resource('statuses','StatusesController');
Route::resource('pays','PayController');
Route::resource('check','CheckController');
Route::resource('appraisals','AppraisalsController');
Route::resource('partnerrating','PartnerRatingController');
Route::resource('correlatives', 'CorrelativesController');
Route::resource('inbox', 'InboxController');
Route::resource('settlement', 'SettlementController');

Route::get('massiveedit','CheckController@massiveEdit')->name('massiveedit');
Route::put('updatemassiveedit','CheckController@updateMassiveEdit')->name('updatemassiveedit');

Route::get('massivestatus','StatusesController@massiveStatus')->name('massivestatus');
Route::put('updatemassivestatus','StatusesController@updateMassiveStatus')->name('updatemassivestatus');

Route::get('infostudent','StudentController@studentData');
Route::get('infopay','StudentController@infoPay');

Route::get('genficha','StudentController@getFicha');
Route::get('gencarta','StudentController@getCarta');
Route::get('gencontrato','StudentController@getContrato');

//contactos
Route::get('padre','ReferenciasController@editPadre');
Route::get('madre','ReferenciasController@editMadre');
Route::get('supervisoru','ReferenciasController@editSupervisorU');
Route::get('supervisorh','ReferenciasController@editSupervisorH');

Route::put('updatep/{id}','ReferenciasController@updateP')->name('references.updatep');
Route::put('updatem/{id}','ReferenciasController@updateM')->name('references.updatem');
Route::put('updatesu/{id}','ReferenciasController@updateSU')->name('references.updatesu');
Route::put('updatesh/{id}','ReferenciasController@updateSH')->name('references.updatesh');


Route::get('gcontract/{id}/download', 'GestorController@genContract')->name('gcontract.download');
Route::get('gengagement/{id}/download', 'GestorController@genEngagement')->name('gengagement.download');
Route::get('gpayment/{id}/download', 'PaymentsController@genPayment')->name('gpayment.download');
Route::get('forms05/{id}/download', 'GestorController@genForm05')->name('forms05.download');


Route::get('forms02/{id}/download', 'GestorController@genForm02')->name('forms02.download');

Route::get('ficha/{id}/download', 'StudentGestorController@getFicha')->name('ficha.download');

Route::get('settlement/{id}/view', 'SupervisorStudentController@Settlement')->name('settlement.view');
Route::get('settlement/{id}/download', 'SettlementController@createSettlement')->name('settlement.download');
Route::get('settlement/{id}/redownload', 'SettlementController@recreateSettlement')->name('settlement.redownload');
//eliminar estudiante
Route::get('sdelete/{id}/student', 'SettlementController@deleteStudent')->name('sdelete.student');


//contratos
Route::get('gcontrato1/{id}/download', 'GestorController@genContract130')->name('gcontrato1.download');

Route::get('gcontrato15/{id}/download', 'GestorController@genContract1515')->name('gcontrato15.download');

Route::get('gcontrato1530/{id}/download', 'GestorController@genContract1530')->name('gcontrato1530.download');



Route::get('gform31/{id}/download', 'GestorController@genForm3130')->name('gform31.download');
Route::get('gform315/{id}/download', 'GestorController@genForm31515')->name('gform315.download');
Route::get('gform3131/{id}/download', 'GestorController@genForm3130')->name('gform3131.download');
Route::get('gform31531/{id}/download', 'GestorController@genForm31530')->name('gform31531.download');
Route::get('gform315d/{id}/download', 'GestorController@genForm315d')->name('gform315d.download');
Route::get('gform3en/{id}/download', 'GestorController@genForm3en')->name('gform3en.download');
Route::get('gform3mes/{id}/download', 'GestorController@genForm3mes')->name('gform3mes.download');



//contratos estudiante
Route::get('contrato1','ContratosController@getContrato1');
Route::get('contrato15','ContratosController@getContrato15');
Route::get('contrato131','ContratosController@getContrato131');
Route::get('contrato1531','ContratosController@getContrato1531');
Route::get('contrato115','ContratosController@getContrato115');

Route::get('contrato15e','ContratosController@getContrato15e');
Route::get('contrato31e','ContratosController@getContrato31e');

//Pagos
Route::get('pay/{id}/index', 'PaymentsController@inicio')->name('pay.index');
Route::get('pay/{id}/createp', 'PaymentsController@createP')->name('pay.createp');
Route::get('forms06/{id}/download', 'PaymentsController@genForm06')->name('forms06.download');
Route::get('forms04/{id}/download', 'PaymentsController@genForm04')->name('forms04.download');

//Gestiones
Route::get('enga/{id}/index', 'EngagementController@inicio')->name('enga.index');
Route::get('enga/{id}/createe', 'EngagementController@createE')->name('enga.createe');

//Inbox
Route::get('gen/{id}/inbox', 'InboxController@genInbox')->name('gen.inbox');

//Excel
Route::get('supervisorexcel','ExcelController@getStudentBySupervisor');
Route::get('gestorexcel','ExcelController@getStudent');
Route::get('getacuerdo','ExcelController@getAcuerdo');
Route::get('logexcel','ExcelController@getSucesos');
Route::get('logexcelsupervisors','ExcelController@getSucesosSupervisors');
Route::get('logexpediente','ExcelController@getExpediente');
Route::get('getchecks','ExcelController@getCheques');
Route::get('getpay','ExcelController@getPagos');
Route::get('getpayinfo','ExcelController@getPagosinfo');
Route::get('getallinfo','ExcelController@getAllInfo');
Route::get('getcontract','ExcelController@getContracts');
Route::get('getgestion','ExcelController@getGestion');
Route::get('getInvRegs','ExcelController@getInventoryRegs');
Route::get('getAppraisals','ExcelController@getAppraisals');



//Cheques
Route::get('check/{id}/index', 'CheckController@inicio')->name('check.index');
Route::get('check/{id}/createp', 'CheckController@createP')->name('check.createp');


Route::get('studentcreate',function(){
	# code...
	return view('student.wellcome');
});

Route::get('studentficha',function(){
	# code...

	return view('student.ficha');
});

Route::get('studentcarta',function(){
	# code...

	return view('student.carta');
});




Route::get('studentws','StudentController@studentFromServer');
Route::get('contractstudent','ContratosController@findStudent');
Route::get('createcontract','ContratosController@createContract');



Route::get('pdfget',function()
{
	# code...


	$templateWord = new PhpOffice\PhpWord\TemplateProcessor('ficha.docx');


	$templateWord->setValue('name','Kevin Hared');
	$templateWord->setValue('fsurname','Gonzalez');
	$templateWord->setValue('lsurname','Cardona');

	$templateWord->saveAs('FichadeBeca.docx');
	header("Content-Disposition: attachment; filename=FichadeBeca.docx; charset=iso-8859-1");
    echo file_get_contents('FichadeBeca.docx');

});

Route::get('sendemail',function(){
	$user = null;
	 Mail::send('emails.newcheck',['user' => $user], function($msj) {
            $msj->subject('[EPSUM] Cheque listo para recoger');
            $msj->to('kevhar10@gmail.com');
     });

});

Route::get('getxlsx',function(){

	#code..

	Excel::create('Laravel Excel', function($excel) {

    $excel->sheet('Excel sheet', function($sheet) {
    	$array = Municipality::All();
        $sheet->fromArray($array);

    });

})->export('xlsx');
});


Route::get('map', 'MapController@index')->name('map');
Route::get('teams/get/{departament}', 'MapController@filterTeams')->name('teams.get');
Route::get('teams/info/{team}/{cohort}', 'MapController@getInfo')->name('teams.info');
Route::get('teams/projects/{team}/{cohort}', 'MapController@getTeamProjects')->name('teams.project');
Route::get('teams/pj/{id}', 'MapController@getDetailProject')->name('teams.pj');
Route::get('teams/student/{id}', 'MapController@getDetail')->name('teams.student');
Route::get('teams/location/{team}', 'MapController@getLocation')->name('teams.location');
Route::get('teams/name/{team}', 'MapController@getName')->name('teams.name');
Route::get('teams/dx/{team}/{cohort}', 'MapController@getDxTeam');
Route::get('teams/download/dx/{team}/{cohort}', 'DxController@getReport');
Route::get('test', 'MapController@test');

Route::resource('dx/index', 'DxController@index');
Route::resource('dx/territory', 'DxTerritoryController@index');
Route::resource('dx/demography', 'DxDemographyController@index');
Route::resource('dx/economy', 'DxEconomyController@index');
Route::resource('dx/health', 'DxHealthController@index');
Route::resource('dx/education', 'DxEducationController@index');
Route::resource('dx/enviroment', 'DxEnviromentController@index');
Route::resource('dx/municipalmanagement', 'DxMunicipalManagementController@index');

Route::get('dx/all', 'DxController@getDxs');
Route::get('dx/detail/{team}/{cohort}', 'DxController@getDxDetail');
Route::get('dx/edit/{edit_flag}', 'DxController@goToEdit');
Route::get('dx/close', 'DxController@closeEdit');
Route::get('dx/edit', 'DxController@editDx');
Route::get('dx/1/edit', 'DxTerritoryController@editTerritory');
Route::get('dx/2/edit', 'DxDemographyController@editDemography');
Route::get('dx/3/edit', 'DxEconomyController@editEconomy');
Route::get('dx/4/edit', 'DxHealthController@editHealth');
Route::get('dx/5/edit', 'DxEducationController@editEducation');
Route::get('dx/6/edit', 'DxEnviromentController@editEnviroment');
Route::get('dx/7/edit', 'DxMunicipalManagementController@editMunicipalManagement');
Route::post('dx/upload/file', 'DxController@upload');

Route::resource('dx','DxController');
Route::resource('dx/territory','DxTerritoryController');
Route::resource('dx/demography','DxDemographyController');
Route::resource('dx/economy','DxEconomyController');
Route::resource('dx/health','DxHealthController');
Route::resource('dx/education','DxEducationController');
Route::resource('dx/enviroment','DxEnviromentController');
Route::resource('dx/municipalmanagement','DxMunicipalManagementController');

Route::get('project/edit', 'ProjectController@editProject');
Route::resource('project', 'ProjectController');
Route::resource('workplan', 'WorkplanController');
Route::resource('project/create', 'ProjectController@create');
Route::resource('project/cat', 'ProjectController@getProject');
Route::get('project/{id}/workplan', 'WorkplanController@create');
Route::post('add/wp', 'WorkplanController@addWorkplan');
Route::post('add/activity', 'ActivityController@addActivity');
Route::post('add/activity-from-project', 'ActivityController@addActivityFromProject');
Route::post('editact', 'ActivityController@editItem');
Route::get('project/line/{id}', 'ProjectController@getIntervLines');
Route::get('check/activity/{id}', 'ProjectController@activityDone');
Route::get('uncheck/activity/{id}', 'ProjectController@activityUndone');
Route::get('projects/all','ProjectController@getAllProjects');
Route::get('showpj/{id}','ProjectController@showReport');
Route::get('gotoproject/{id}/{team}/{cohort}/{type}', 'ProjectController@getProjectDetail');
Route::post('rmvAct', 'ActivityController@delete');
Route::post('edtobj', 'WorkplanController@editObjective');
Route::post('changeEditDxStatus', 'DxController@changeEditDxStatus');

Route::resource('inform', 'FinalInformController');
//Route::resource('inform/project/{type}', 'FinalInformController@toInform');
Route::resource('inform/project', 'FinalInformController@toInform');
Route::get('results/report', 'FinalInformController@getReport');


Route::get('inventory/providers','InventoryProviderController@allProviders');
Route::get('inventory/articles','InventoryArticleController@allArticles');
Route::get('inventory/regs','InventoryController@index');
Route::get('inventory/purchases','InventoryController@allPurchases');
Route::get('inventory/provider/edit/{id}','InventoryProviderController@edit');
Route::get('inventory/article/edit/{id}','InventoryArticleController@edit');
Route::get('inventory/provider/dismiss/{id}','InventoryProviderController@dismiss');
Route::get('inventory/register/{id}','InventoryController@register');
Route::get('regis/fill/{id}','InventoryController@fillArticleFields');
Route::post('reg/article','InventoryController@regArticle');

Route::resource('inventory/provider','InventoryProviderController');
Route::resource('inventory/article','InventoryArticleController');
Route::resource('inventory','InventoryController');

Route::get('rep/providers', 'InventoryProviderController@getReport');
Route::get('rep/arts', 'InventoryArticleController@getReport');
Route::get('rep/purs', 'InventoryController@getPurchasesReport');
Route::get('repgeneral', 'InventoryController@getReport');

Route::get('stats/', 'StudentController@toIndexStats');
Route::get('stats/students', 'StudentController@getStats');
Route::get('stats/financing', 'StudentController@getFinancingStats');
Route::get('stats/teams', 'TeamController@getStats');
Route::get('stats/chart/team/general', 'TeamController@chartTeamGeneral');
Route::get('stats/teams/{cohort}', 'TeamController@findTeamsByCohort');
Route::get('stats/diagnostics', 'DxController@getStats');
Route::get('stats/projects', 'ProjectController@getStats');
Route::get('stats/chart/projs/line/{type}', 'ProjectController@chartsProjByLine');
Route::get('stats/chart/budget/au/{type}', 'ProjectController@chartsBudgetByAU');
Route::get('stats/chart/budget/cohort', 'ProjectController@chartBudgetByCohort');
Route::get('stats/chart/budget/career', 'ProjectController@chartBudgetByCareer');
Route::get('stats/chart/projects/directusers/{type}', 'ProjectController@chartProjectsTop');
Route::get('stats/chart/dx/masl', 'DxController@chartMasl');
Route::get('stats/chart/dx/masl/higher', 'DxController@chartMaslHigher');
Route::get('stats/chart/dx/masl/lower', 'DxController@chartMaslLower');
Route::get('stats/chart/dx/population/{cat}', 'DxController@chartPopulation');
Route::get('/stats/chart/dx/economy/{cat}/{order}', 'DxController@chartEconomy');
Route::get('/stats/chart/dx/health/{cat}/{order}', 'DxController@chartHealth');
Route::get('/stats/chart/dx/municipalmanagement/{order}', 'DxController@chartMM');
Route::get('reprojects', 'ProjectController@getGeneralReport');


//doit
Route::get('doitappraisal','AppraisalsController@doIt')->name('appraisals.doit');
Route::get('doitpartnerrating','PartnerRatingController@doIt')->name('partnerrating.doit');

//Informs
Route::resource('plan', 'PlanController');
Route::post('add/plan', 'PlanController@newPlan');
Route::post('add/obj', 'ObjectiveController@addObjective');
Route::post('assign/obj', 'ObjectiveController@addObjectiveToPlan');
Route::post('assign/result', 'ObjectiveController@addObjectiveResult');
Route::post('remove/obj', 'ObjectiveController@delete');
Route::post('remove/result', 'ObjectiveController@removeObjectiveResult');
Route::post('unasign/obj', 'ObjectiveController@unassignObjective');
Route::post('update/obj', 'ObjectiveController@update');
Route::post('update/res', 'ObjectiveController@updateResults');
Route::get('list/objectives/{plan}', 'ObjectiveController@listObjectives');
Route::get('list/shared/objectives/{plan}', 'ObjectiveController@listSharedObjectives');
Route::get('list/followed/objectives/{plan}', 'ObjectiveController@listFollowedObjectives');
Route::get('list/results/{objective}', 'ObjectiveController@listObjectiveResults');
Route::get('get/obj/{id}', 'ObjectiveController@getObjective');
Route::get('plan/month/{m}', 'PlanController@createPlan');
Route::get('plan/monthly/all', 'PlanController@getAllPlans');
Route::get('plan/{month}/{student}/', 'PlanController@getStudentPlan');
Route::get('finished/objs/{plan}', 'ObjectiveController@finishedObjectivesCount');
Route::post('update/experiences', 'PlanController@updateExperiences');
Route::post('update/expcorrections', 'PlanController@updateExperiencesCorrections');
Route::post('update/plan/status', 'PlanController@updateStatus');
Route::post('validated', 'PlanController@updateValidateStatus');
Route::post('add/objcorrection', 'ObjectiveController@addObjectiveCorrection');
Route::post('send/notification', 'NotificationController@notify');
Route::get('notifications/{email}', 'NotificationController@getNotifications');
Route::post('notifications/{email}/{id}', 'NotificationController@markAsSeen');
Route::post('notifications/{email}/delete/{id}', 'NotificationController@delete');
Route::post('log/obj', 'LogTeamsController@addLog');
Route::get('record/{id}', 'LogTeamsController@getRecord');
Route::post('add/result', 'ObjectiveController@addResult');
Route::post('remove/result', 'ObjectiveController@removeResult');
Route::get('list/results/{objective}', 'ObjectiveController@listResults');
Route::post('update/num_correction', 'PlanController@updateNumCorrection');

Route::get('monthly/report/{id}', 'PlanController@reportToReview');
Route::get('monthly/report/reviewed/{m}', 'PlanController@reportReviewed');
Route::get('monthly/report/preview/{m}', 'PlanController@reportPreview');
Route::get('report/download/{id}', 'PlanController@downloadReport');

Route::get('report/workplan', 'WorkingPlanController@workspace');
Route::post('add/matrix/level', 'WorkingPlanController@addMatrixPlanningLevel');

Route::get('report/dx','DxController@dxWorkspace');

Route::get('create/notification','NotificationController@createNotification');
