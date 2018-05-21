<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('fogos', function ($bot) {
    $bot->reply('cenas!');
});

$botman->hears('ajuda', function ($bot) {
    $status = "Envie uma mensagem parivada com as palavras: \r\n estado - actual situação operacional \r\n lista <concelho> - lista de incêndio no concelho \r\n stats - estatistica do dia \r\n risco <concelho> - risco de incêndio \r\n aereos - distritos com incêndios ativos/nº de meios aereos";
    $bot->reply($status);
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');

$botman->hears('risco {concelho}', function ($bot, $concelho) {
    $status = \App\Lib\LegacyApi::getDangerLocation($concelho)['data'];
    $bot->reply($status);
});

$botman->hears('lista {concelho}', function ($bot, $concelho) {
    $status = \App\Lib\LegacyApi::getListLocation($concelho)['data'];
    $bot->reply($status);
});

$botman->hears('status', function ($bot) {
    $status = \App\Lib\LegacyApi::getStatus()['data'];
    $bot->reply($status);
});

$botman->hears('aereos', function ($bot) {
    $status = \App\Lib\LegacyApi::getAerial()['data'];
    $bot->reply($status);
});

$botman->hears('stats', function ($bot) {
    $status = \App\Lib\LegacyApi::getStats()['data'];
    $bot->reply($status);
});