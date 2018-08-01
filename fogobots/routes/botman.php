<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('ajuda', function ($bot) {
    $status = "Envie uma mensagem privada com as palavras: \r\n estado - actual situação operacional \r\n lista <concelho> - lista de incêndio no concelho \r\n estatisticas - estatistica do dia \r\n risco <concelho> - risco de incêndio \r\n aereos - distritos com incêndios ativos/nº de meios aereos";
    $bot->reply($status);
});

$botman->hears('help', function ($bot) {
    $status = "Send a private message with the words: \r\n status - current operational situation \r\n list <county> - list of fire in the county\r\n stats - daily stats \r\n risk <county> - fire risk \r\n aerial - districts with active fires/number of airways";
    $bot->reply($status);
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');

$botman->hears('activos', function ($bot, $concelho) {
    $status = \App\Lib\LegacyApi::getActive()['data'];
    $bot->reply($status);
});

$botman->hears('risco {concelho}', function ($bot, $concelho) {
    $status = \App\Lib\LegacyApi::getDangerLocation($concelho)['data'];
    $bot->reply($status);
});

$botman->hears('risk {concelho}', function ($bot, $concelho) {
    $status = \App\Lib\LegacyApi::getDangerLocation($concelho)['data'];
    $bot->reply($status);
});

$botman->hears('lista {concelho}', function ($bot, $concelho) {
    $status = \App\Lib\LegacyApi::getListLocation($concelho)['data'];
    $bot->reply($status);
});

$botman->hears('list {concelho}', function ($bot, $concelho) {
    $status = \App\Lib\LegacyApi::getListLocation($concelho)['data'];
    $bot->reply($status);
});

$botman->hears('status', function ($bot) {
    $status = \App\Lib\LegacyApi::getStatus()['data'];
    $bot->reply($status);
});

$botman->hears('estado', function ($bot) {
    $status = \App\Lib\LegacyApi::getStatus()['data'];
    $bot->reply($status);
});

$botman->hears('aereos', function ($bot) {
    $status = \App\Lib\LegacyApi::getAerial()['data'];
    $bot->reply($status);
});

$botman->hears('aéreos', function ($bot) {
    $status = \App\Lib\LegacyApi::getAerial()['data'];
    $bot->reply($status);
});

$botman->hears('aerial', function ($bot) {
    $status = \App\Lib\LegacyApi::getAerial()['data'];
    $bot->reply($status);
});

$botman->hears('stats', function ($bot) {
    $status = \App\Lib\LegacyApi::getStats()['data'];
    $bot->reply($status);
});

$botman->hears('estatisticas', function ($bot) {
    $status = \App\Lib\LegacyApi::getStats()['data'];
    $bot->reply($status);
});

$botman->hears('estatísticas', function ($bot) {
    $status = \App\Lib\LegacyApi::getStats()['data'];
    $bot->reply($status);
});