<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;    
use App\Http\Controllers\UserController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\LideresController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\RelatorioController;

// Route::get('/', [HomeController::class, 'show']);
// 

Route::get('/',  [LoginController::class, 'show'])->name('login');

Route::get('/gerar-token/{id}', [LideresController::class, 'gerarToken'])->name('gerar.token');
Route::get('/public-link/{token}', [LideresController::class, 'linkpublico'])->name('publico.link');
Route::post('cadastro_publico',	[LideresController::class,'cadastro_publico']);

Route::get('/public-link/lideranca/oH6ZQs9rd8P2-7iH-pavhqGbsihvqF-b7w1gdYeYq7A',	[LideresController::class, 'linkpublicocreatelider']);
Route::post('storalideranca',			    [LideresController::class, 'storelideranca']);
Route::get('/public-link/lideranca/sucesso', [LideresController::class, 'sucesso']);


Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');

Route::group(['middleware' => 'auth'], function () {
	
	Route::get ('/alterasenha',		[UserController::class, 'AlteraSenha']);
	Route::post('/salvasenha',   	[UserController::class, 'SalvarSenha']);

	Route::get('/home', 		[HomeController::class, 'index'])->name('home');
	Route::post('logout', 		[LoginController::class, 'logout'])->name('logout');

	Route::get('/register', 	[RegisterController::class, 'create'])->name('register');
	Route::post('/register', 	[RegisterController::class, 'store'])->name('register.perform');

	
	Route::get('colaboradores/{id}', 	 [LideresController::class,'colaboradores']);
	Route::get('mapacolaboradores/{id}', [LideresController::class,'mapacolaboradores']);
	
	Route::post('/grupo/import_excel', 	[GrupoController::class, 'importExcel'])->name('grupo.import_excel');
	Route::get('/grupo/export_excel', 	[GrupoController::class, 'exportExcel'])->name('grupo.export_excel');	
	Route::get('/grupo/export_colaboradores_lider_excel/{id}', 	[GrupoController::class, 'exportColaboradoresLiderancaExcel'])->name('grupo.export_colaboradores_lider_excel');	
	Route::get('/grupo/export_colaboradores_lider_pdf/{id}', 	[GrupoController::class, 'exportColaboradoresLiderancaPDF'])->name('grupo.export_colaboradores_lider_pdf');	

	Route::get('/qrcode',				[LideresController::class, 'baixarqrcode']);
	

	Route::get('servicogrupoindex/{id}', 		[ServicoController::class, 'servicoGrupoIndex']);
	Route::post('servicogrupostore',     		[ServicoController::class, 'servicoGrupoStore'])->name('servicogrupo.store');
	Route::put('servicogrupoupdate',     		[ServicoController::class, 'servicoGrupoUpdate'])->name('servicogrupo.update');
	Route::delete('servicogrupodelete/{id}',	[ServicoController::class, 'servicoGrupoDelete']);
	Route::get('servicogrupoedit/{id}/edit',	[ServicoController::class, 'servicoGrupoEdit']);
	Route::get('/api/subServicos', 		 		[ServicoController::class, 'getSubservicos']);

	Route::get('relatorio/grupo', [RelatorioController::class, 'grupo'])->name('relatorioGrupo');
	Route::get('relatorio/lideranca', [RelatorioController::class, 'liderancas'])->name('relatorioLiderancas');
	Route::get('relatorio/servicos', [RelatorioController::class, 'servicos'])->name('relatorioServicos');

	Route::get('/zonas', [RelatorioController::class, 'getZonas']);
	Route::get('/secoes/{zona}', [RelatorioController::class, 'getSecoes']);
	Route::get('/secoesFromZonas', [RelatorioController::class, 'getSecoesFromZonas']);
	Route::get('/locaisFromZonasSecoes', [RelatorioController::class, 'getLocaisFromZonasSecoes']);
	Route::get('/relatorio/resultado', [RelatorioController::class, 'relatorioGrupo']);
	
	Route::resources([
		'user'		  => UserController::class,
		'grupo'		  => GrupoController::class,
		'lideres'     => LideresController::class,
		'agenda'		  => AgendaController::class,
		'dashboard'   => DashboardController::class,
		'servico'	  => ServicoController::class,
		'relatorio'   => RelatorioController::class,
	]);
});
