<?php

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

use Illuminate\Http\Request;
use App\Mail\NotificacaoPagamentoMail;

//Route::get('/migrate', function(){
//	return Artisan::call('migrate');
//});

//Route::get('/config', function(){
//	return Artisan::call('config:cache');
//});

Route::get('/certificado', function(){

	$user_infos = \App\UserInfos::where('user_id', Auth::user()->id)->first();
	$assinatura = \App\Assinatura::where('tipo', 'premium')->where('ativa', 1)->where('user_id', Auth::user()->id)->with('rec_alocado')->first();

	$data['nome'] = Auth::user()->name;
	$data['site_empresa'] = $user_infos->site_empresa;
	$data['recs_alocados'] = $assinatura->rec_alocado->quantidade;
	$data['data_emissao'] = $assinatura->created_at->format('d/m/Y');
	$data['validade'] = Helper::dateTimeCreate($assinatura->validade)->format('d/m/Y');

	PDF::setOptions(['dpi' => 300, 'defaultFont' => 'sans-serif', 'defaultPaperSize' => 'a4', 'orientation' => 'landscape']);
	$pdf = PDF::loadView('certificado', $data)->setPaper('a4', 'landscape');
	return $pdf->download('certificado.pdf');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/simule/{quantidade}', 'HomeController@simule')->name('simule');
Route::post('/create/user', 'HomeController@create')->name('create');
Route::get('/crie-sua-senha/{token}/{email}', 'HomeController@criarSenha')->name('criar-senha');
Route::post('/crie-sua-senha/', 'HomeController@reset')->name('action-criar-senha');
Auth::routes();

Route::get('logout', function (){

	if (Auth::user()->hasRole('usuario'))
	{

	    $log = new \App\Log;
	    $log->user_id = Auth::user()->id;
	    $log->mensagem = 'logout';
	    $log->save();
	}
	
	Auth::logout();
	return redirect('/');
})->name('logout');

Route::post('/painel/usuario/adicionar-logotipo', 'UsersDashboardController@adicionar_logotipo')->name('adicionar_logotipo');

Route::get('/painel/usuario', 'UsersDashboardController@index');

Route::get('/painel/usuario/produtos', 'UsersDashboardController@produtos');

Route::get('/painel/usuario/origem', 'UsersDashboardController@origem');

Route::get('/painel/usuario/faq', 'UsersDashboardController@faq');

Route::get('/painel/usuario/contato', 'UsersDashboardController@contato');
Route::post('/painel/usuario/contato', 'UsersDashboardController@contato_action')->name('contato_action');
Route::get('/painel/usuario/contato/resposta/{id}', 'UsersDashboardController@resposta')->name('resposta');

Route::get('/painel/usuario/minha-conta', 'UsersDashboardController@minhaConta');

Route::put('/painel/usuario/minha-conta/atualizar-dados', 'UsersDashboardController@atualizar_dados')->name('atualizar_dados');

Route::get('/painel/usuario/minha-conta/ativar-premium', 'UsersDashboardController@ativar_premium')->name('ativar_premium');

Route::post('/painel/usuario/remove-notificacao', 'UsersDashboardController@removeNotificacao')->name('remove_notificacao');

Route::post('/painel/usuario/ativar-conta-premium', 'UsersDashboardController@ativar_conta_premium')->name('ativar_conta_premium');

Route::get('/simule-admin/{quantidade}', 'UsersDashboardController@simule_admin')->name('simule_admin');

Route::post('/painel/usuario/minha-conta/ativar-premium/enviar_solicitacao', 'UsersDashboardController@enviar_solicitacao')->name('enviar_solicitacao');

Route::put('/painel/usuario/minha-conta/pagar-solicitacao/{id}', 'UsersDashboardController@pagar_solicitacao')->name('pagar_solicitacao');

Route::get('/painel/usuario/minha-conta/revisar-solicitacao/{id}', 'UsersDashboardController@revisar_solicitacao')->name('revisar_solicitacao');

Route::put('/painel/usuario/minha-conta/atualizar-solicitacao', 'UsersDashboardController@atualizar_solicitacao')->name('atualizar_solicitacao');

// ###### ADMIN ###### //

Route::get('/painel/administrador', 'AdminDashboardController@index');

Route::get('/painel/administrador/clientes', 'AdminDashboardController@clientes');
Route::get('/painel/administrador/clientes/{id}', 'AdminDashboardController@visualizar_cliente')->name('visualizar_cliente');
Route::get('/painel/administrador/clientes/logs/{id}', 'AdminDashboardController@visualizar_logs')->name('visualizar_logs');

Route::get('/painel/administrador/usinas', 'AdminDashboardController@usinas');
Route::get('/painel/administrador/usinas/cadastro', 'AdminDashboardController@cadastro_usinas');
Route::post('/painel/administrador/usinas/cadastro', 'AdminDashboardController@cadastro_usinas_action')->name('cadastro_usinas_action');
Route::get('/painel/administrador/usinas/visualizar/{id}', 'AdminDashboardController@visualizar_usinas');
Route::put('/painel/administrador/usinas/atualizar/{id}', 'AdminDashboardController@atualizar_usinas')->name('atualizar_usinas_action');
Route::put('/painel/administrador/usinas/inativar/{id}', 'AdminDashboardController@inativar_usinas')->name('inativar_usinas_action');
Route::put('/painel/administrador/usinas/ativar/{id}', 'AdminDashboardController@ativar_usinas')->name('ativar_usinas_action');
Route::get('/painel/administrador/usinas/cadastro-recs/{id}', 'AdminDashboardController@cadastro_recs');
Route::post('/painel/administrador/usinas/cadastro-recs/{id}', 'AdminDashboardController@cadastro_recs_action')->name('cadastro_recs_action');
Route::delete('/painel/administrador/usinas/excluir-recs/{id_rec}/{id_usina}', 'AdminDashboardController@excluir_recs_action')->name('excluir_recs_action');
Route::get('/painel/administrador/mensagens', 'AdminDashboardController@mensagens');
Route::get('/painel/administrador/mensagens/visualizar/{id}', 'AdminDashboardController@visualizar_mensagens');
Route::delete('/painel/administrador/mensagens/excluir/{id}', 'AdminDashboardController@excluir_mensagem_action')->name('excluir_mensagem_action');
Route::get('/painel/administrador/configuracoes', 'AdminDashboardController@configuracoes');
Route::get('/painel/administrador/configuracoes/criar-usuario', 'AdminDashboardController@criar_usuario')->name('criar_usuario');
Route::get('/painel/administrador/configuracoes/visualizar-usuario/{id}', 'AdminDashboardController@visualizar_usuario')->name('visualizar_usuario');
Route::delete('/painel/administrador/configuracoes/excluir-usuario', 'AdminDashboardController@excluir_usuario_action')->name('excluir_usuario_action');
Route::post('/painel/administrador/configuracoes/criar-usuario', 'AdminDashboardController@criar_usuario_action')->name('criar_usuario_action');
Route::get('/painel/administrador/configuracoes/visualizar-logotipo/{id}', 'AdminDashboardController@visualizar_logotipo')->name('visualizar_logotipo');
Route::put('/painel/administrador/configuracoes/atualizar-logotipo', 'AdminDashboardController@atualizar_logotipo')->name('atualizar_logotipo');
Route::get('/painel/administrador/faq', 'AdminDashboardController@faq');
Route::get('/painel/administrador/faq/cadastro', 'AdminDashboardController@cadastro_faq');
Route::post('/painel/administrador/faq/cadastro', 'AdminDashboardController@cadastro_faq_action')->name('cadastro_faq_action');
Route::get('/painel/administrador/faq/atualizar/{id}', 'AdminDashboardController@atualizar_faq');
Route::put('/painel/administrador/faq/atualizar/{id}', 'AdminDashboardController@atualizar_faq_action')->name('atualizar_faq_action');
Route::delete('/painel/administrador/faq/excluir/{id}', 'AdminDashboardController@excluir_faq_action')->name('excluir_faq_action');

Route::post('/painel/administrador/configuracoes', 'AdminDashboardController@fator_medio_anual_action')->name('fator_medio_anual_action');

Route::get('/painel/administrador/solicitacao/{id}', 'AdminDashboardController@visualizar_solicitacao')->name('visualizar_solicitacao');

Route::put('/painel/administrador/solicitacao/aprovar/{id}', 'AdminDashboardController@aprovar_solicitacao')->name('aprovar_solicitacao');

Route::put('/painel/administrador/solicitacao/reprovar/{id}', 'AdminDashboardController@reprovar_solicitacao')->name('reprovar_solicitacao');

Route::put('/painel/administrador/aprovar-mes', 'AdminDashboardController@aprovar_mes');

Route::put('/painel/administrador/reprovar-mes', 'AdminDashboardController@reprovar_mes');

Route::post('/painel/administrador/atualizar-boleto-extra', 'AdminDashboardController@atualizar_boleto');

Route::put('/painel/administrador/faq/atualizar-posicao', 'AdminDashboardController@atualizar_posicao');

Route::put('/painel/usuario/desativar-cliente', 'AdminDashboardController@desativar_cliente')->name('desativar_cliente');

Route::put('/painel/usuario/ativar-cliente', 'AdminDashboardController@ativar_cliente')->name('ativar_cliente');

Route::post('/painel/administrador/responder-cliente', 'AdminDashboardController@responder_cliente')->name('responder_cliente');

// ###### JSON ###### //

Route::get('/widget/initial', 'HomeController@widget' );


// Pagseguro

Route::get('/transaction/obrigado', function(){

	return redirect()->url('/');

})->name('pagseguro.redirect');

Route::post('/transaction/notification', function(Request $request){
	
	$email = "pagamento@ziitbusiness.com.br";
	$token = "9058DA97916548C1B0AF20BBB5BD4948";
	// $token = "8C7A4DE9CD28414BBACFAC1A5776415C";
	$notificationCode = $request->notificationCode;

	// dd($notificationCode);

	$url = "https://ws.pagseguro.uol.com.br/v2/transactions/notifications/".$notificationCode."?email=".$email."&token=".$token;

	$curl = curl_init($url);
	   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	   $response = curl_exec($curl);
	   $http = curl_getinfo($curl);

	    if($response == 'Unauthorized'){
	               print_r($response);
	               exit;
	      }

	    $response_xml = simplexml_load_string($response);

	    if(count($response_xml->error) > 0){
	        print_r($response);
	        exit;
	    }

	    $items = $response_xml->items;
	    $obj_item = new \stdClass();
	    $obj_item->status = (int)$response_xml->status;

	    foreach ($items->item as $item) {
	        
	        $obj_item->item_id = (int)$item->id;
	    }

	    $solicitacao = \App\Solicitacao::find($obj_item->item_id);    
	    $solicitacao->pagamento_status = $obj_item->status;
	    $solicitacao->save();
	    $solicitacao_id = $solicitacao->id;
	    $user = \App\User::find($solicitacao->user_id);

	    switch ($solicitacao->pagamento_status) {
	        case 0:
	            $mensagem = 'Aguardando Pagamento';
	            break; 

	        case 1:
	            $mensagem = 'Aguardando Pagamento';
	            break;   

	        case 2:
	            $mensagem = 'Pagamento em Análise';
	            break;

	        case 3:
	            $mensagem = 'Pagamento Aprovado';
	            break;

	        case 7:
	            $mensagem = 'Pagamento Cancelado';
	            break;                                  
	    }

	    // $emails = ['thimholanda@gmail.com'];
	    $emails = ['contato@ziitbusiness.com.br', 'mikelopes@idealista.net.br'];	    

	    \Mail::to($emails)->send( new NotificacaoPagamentoMail($user->name, $solicitacao_id, 'Status de Pagamento', $mensagem) );

	    return 'success';

	    



})->name('pagseguro.notification');
