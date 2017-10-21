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

Route::get('/', 'BootController@bootInit');

route::get('/qui-sommes-nous', 'BootController@about');

Route::get('/mentions-legales', 'BootController@legal');

Route::get('/cgu', 'BootController@cgu');

Route::get('/comment-ca-marche', 'BootController@ccm');

Route::get('/contact', 'BootController@contact');

Route::get('/register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('/register', ['as' => 'register', 'uses' => 'AccountApiController@register']);
Route::get('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLoginWrapper']);
Route::post('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLoginWrapper']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogoutWrapper']);
Route::get('/recover_password', ['as' => 'forgot', 'uses' => 'Auth\PasswordController@getEmail']);
Route::post('/recover_password', ['as' => 'forgot', 'uses' => 'Auth\PasswordController@postEmail']);
Route::get('/password/reset/{token}', ['as' => 'forgot', 'uses' => 'Auth\PasswordController@getReset']);
Route::post('/password/reset', ['as' => 'forgot', 'uses' => 'Auth\PasswordController@postReset']);
Route::get('/user/confirm/{code}', 'UserController@confirm');

//Route::auth();

Route::group(['middleware' => 'auth'], function () {

    Route::get('dashboard', ['as' => 'dashboard', 'uses'  => 'DashboardController@index']);

    Route::get('profile', ['as' => 'profile', 'uses'  => 'DashboardController@getProfile']);

    Route::get('achats', ['as' => 'achats', 'uses'  => 'DashboardController@getAchats']);

    Route::get('prospects', ['as' => 'prospects', 'uses'  => 'DashboardController@getProspects']);

    Route::get('tarifs', ['as' => 'tarifs', 'uses'  => 'TarifsController@index']);

    Route::get('faqs', ['as' => 'faqs', 'uses'  => 'DashboardController@getFaqs']);

    Route::get('prospects/{type}/{id}', [
      'as'    => 'Prospect.show', 
      'uses'  => 'DashboardController@showProspect'
    ]);

    Route::get('achats-prospect', [
      'as'    => 'Prospect.achats', 
      'uses'  => 'CartController@achatProspects'
    ]);

    Route::get('profile/edit-profile/{id}', [
      'as'    => 'Profile.edit', 
      'uses'  => 'DashboardController@editProfile'
    ]);

    Route::post('profile/update-profile', [
      'as'    => 'Profile.update', 
      'uses'  => 'DashboardController@updateProfile'
    ]);

    Route::get('profile/activite-profile', [
      'as'    => 'Profile.activite', 
      'uses'  => 'DashboardController@recenteActicite'
    ]);

    Route::get('messagerie', [
      'as'    => 'messagerie.inbox', 
      'uses'  => 'DashboardController@messagerie'
    ]);

    Route::get('add-prospect-to-cart', [
      'as'    => 'Prospect.add', 
      'uses'  => 'CartController@addCart'
    ]);

    Route::get('cart-view', [
      'as'    => 'Prospect.CartView', 
      'uses'  => 'CartController@CartView'
    ]);

    Route::get('cart-pay-bay-cart', [
      'as'    => 'Prospect.PayByCard', 
      'uses'  => 'CartController@cartCheckout'
    ]);

    Route::get('cart-pay-by-credit', [
      'as'    => 'Prospect.PayByCredits', 
      'uses'  => 'CartController@paiementByCredit'
    ]);

    Route::get('cart-checkout-pay', [
      'as'    => 'Prospect.CartCheckoutPay', 
      'uses'  => 'CartController@CartCheckoutPay'
    ]);

    /*Route::get('cart-checkout-review', [
      'as'    => 'Prospect.CartCheckoutReview', 
      'uses'  => 'CartController@cartCheckoutReview'
    ]);*/

    /*Route::get('cart-checkout-complete', [
      'as'    => 'Prospect.CartCheckoutComplete', 
      'uses'  => 'CartController@cartPayComplete'
    ]);*/

    Route::get('cart-view-remove/{id}', [
      'as'    => 'Prospect.CartRemove', 
      'uses'  => 'CartController@removeCart'
    ]);

    Route::get('credit-achats', [
      'as'    => 'Credit.achatsCredit', 
      'uses'  => 'CreditController@achatsCredit'
    ]);

    Route::get('credit-payment/{id}', [
      'as'    => 'Credit.Pay', 
      'uses'  => 'CreditController@getPack'
    ]);

    Route::get('payment-credit/{montant}', [
      'as'    => 'Payment.Credit', 
      'uses'  => 'CreditController@paymentCredit'
    ]);

    Route::get('achats-credit', [
      'as'    => 'Credits.achats', 
      'uses'  => 'CreditController@achatCredits'
    ]);

    Route::get('commandes', [
      'as'    => 'Commandes.index', 
      'uses'  => 'CommandeController@index'
    ]);

    Route::get('mes-commandes', [
      'as'    => 'Commande.commande', 
      'uses'  => 'CommandeController@commandes'
    ]);

    Route::get('download-file/{id}', [
      'as'    => 'Download', 
      'uses'  => 'CartController@dowloadFile'
    ]);

    Route::group(['prefix' => 'messages'], function () {

        Route::get('/', [
            'as' => 'messages', 
            'uses' => 'MessagesController@index'
        ]);

        Route::get('create', [
            'as' => 'messages.create', 
            'uses' => 'MessagesController@create'
        ]);

        Route::post('/', [
            'as' => 'messages.store', 
            'uses' => 'MessagesController@store'
        ]);

        Route::get('{id}', [
            'as' => 'messages.show', 
            'uses' => 'MessagesController@show'
        ]);

        Route::put('{id}', [
            'as' => 'messages.update', 
            'uses' => 'MessagesController@update'
        ]);
    });

    Route::get('pay-effectue-cre', [
        'as' => 'pay-effectue', 
        'uses'  => 'CreditController@transAccepte'
    ]);

     Route::get('pay-effectue-cart', [
        'as' => 'pay-effectue', 
        'uses'  => 'CartController@transAccepte'
    ]);

    Route::get('pay-annule', [
        'as' => 'pay-annule',
         'uses'  => 'PaiementController@transAnnule'
    ]);

    Route::get('pay-refuse', [
        'as' => 'pay-refuse', 
        'uses'  => 'PaiementController@transAnnule'
    ]);

    Route::get('invoice-pack-credits/{id}', [
        'as' => 'Invoice.PackCredit', 
        'uses'  => 'CreditController@getInvoicePackCredit'
    ]);



});


if (!defined('CONTACT_EMAIL')) {
    define('CONTACT_EMAIL', Config::get('mail.from.address'));
    define('CONTACT_NAME', Config::get('mail.from.name'));
    define('SITE_URL', Config::get('app.url'));

    define('HELLOASSULOGIN', 'hello@api.fr');
    define('HELLOASSUPASS', 'api@X86');

    define('URL_API', env('URL_API', 'http://api.leadsassurance.com/api/v1/detail/'));
    define('URL_API_UPDATE', env('URL_API', 'http://api.leadsassurance.com/api/v1/update/'));
    
    define('URL_LABEL', env('URL_LABEL', 'http://api.leadsassurance.com/api/v1/label'));
    
    define('ALL_PROSPECTS_URL', env('ALL_PROSPECTS_URL', 'http://api.leadsassurance.com/api/v1/all'));
    define('MOTO_URL', env('MOTO_URL', 'http://api.leadsassurance.com/api/v1/motos'));
    define('AUTO__URL', env('AUTO__URL', 'http://api.leadsassurance.com/api/v1/autos'));
    define('SANTE_URL', env('SANTE_URL', 'http://api.leadsassurance.com/api/v1/santes'));
    define('HABITATION__URL', env('HABITATION__URL','http://api.leadsassurance.com/api/v1/habitations'));

    define('ENV_DEVELOPMENT', 'local');
    define('SESSION_COUNTER', 'sessionCounter');
    define('SESSION_LOCALE', 'sessionLocale');
    define('SESSION_USER_ACCOUNTS', 'userAccounts');
    define('SESSION_LAST_REQUEST_PAGE', 'SESSION_LAST_REQUEST_PAGE');
    define('SESSION_LAST_REQUEST_TIME', 'SESSION_LAST_REQUEST_TIME');

    define('SITE', '1552522');
    define('RANG', '01');
    define('Identifiant', '654628713');
    define('PBX_EFFECTUE_CRE', 'http://dev.leadsassurance.com/pay-effectue-cre');
    define('PBX_EFFECTUE_CART', 'http://dev.leadsassurance.com/pay-effectue-cart');
    define('PBX_ANNULE', 'http://dev.leadsassurance.com/pay-annule');
    define('PBX_REFUSE', 'http://dev.leadsassurance.com/pay-refuse');
    // Paramétrage de l'url de retour back office site
    define('PBX_REPONDRE_A', 'http://www.leadsassurance.com'); 

    define('KEY_TEST',trim('83f0625cad0ed0615136b1aa0c3ad2878ac00f963e4763f862ef358e263e3f53956d4da1225cd823b1bd5620d9a404f927699a7582e7350f12b80226e75ba91c'));

    define('SOCIAL_GOOGLE', 'Google');
    define('SOCIAL_FACEBOOK', 'Facebook');
    define('SOCIAL_GITHUB', 'GitHub');
    define('SOCIAL_LINKEDIN', 'LinkedIn');
    define('API_SERIALIZER_ARRAY', 'array');
    define('API_SERIALIZER_JSON', 'json');
    define('RANDOM_KEY_LENGTH', 32);
    define('MAX_FAILED_LOGINS', 10);

    define('TEST_USERNAME', 'test_nom');

    define('ACCOUNT_USER_DETAILS', 'user_details');
    define('ACCOUNT_LOCALIZATION', 'localization');
    

    define('CARD', 'CARG');
    define('CREDIT', 'CREDIT');
    define('PAIEMENT_CART_MSG', 'Carte bancaire');
    define('PAIEMENT_CREDIT_MSG', 'Compte prépayer par credit');
    
    
    
    function uctrans($text)
    {
        return ucwords(trans($text));
    }

    function otrans($text)
    {
        $locale = Session::get(SESSION_LOCALE);
        if ($locale == 'fr') {
            return trans($text);
        } else {
            $string = trans($text);
            $english = trans($text, [], 'fr');
            return $string != $english ? $string : '';
        }
    }
}
