<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/accounts',       ['uses' => 'Account\AccountListController@toList']);
$router->post('/accounts',      ['uses' => 'Account\AccountSaveController@toCreate']);
$router->put('/accounts/{id}',  ['uses' => 'Account\AccountSaveController@toUpdate']);

$router->post(
    '/account-group-calculate', ['uses' => 'AccountGroup\AccountGroupCalculatorController@toCalculate']);

$router->get('/customers',      ['uses' => 'Customer\CustomerListController@toList']);
$router->post('/customers',     ['uses' => 'Customer\CustomerSaveController@toCreate']);
$router->put('/customers/{id}', ['uses' => 'Customer\CustomerSaveController@toUpdate']);

$router->get('/document-types', ['uses' => 'DocumentType\DocumentTypeListController@toList']);

$router->get('/main-accounts',  ['uses' => 'MainAccount\MainAccountListController@toList']);

$router->get('/money-types',    ['uses' => 'MoneyType\MoneyTypeListController@toList']);

$router->get('/months',         ['uses' => 'Month\MonthListController@toList']);

$router->get('/parameters',     ['uses' => 'Parameter\ParameterListController@toList']);

$router->get('/records',        ['uses' => 'Record\RecordListController@toList']);
$router->post('/records',       ['uses' => 'Record\RecordSaveController@toCreate']);
$router->put('/records/{id}',   ['uses' => 'Record\RecordSaveController@toUpdate']);

$router->get('/voucher-types',  ['uses' => 'VoucherType\VoucherTypeListController@toList']);


