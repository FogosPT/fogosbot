<?php
/**
 * Created by PhpStorm.
 * User: tomahock
 * Date: 17/08/2018
 * Time: 23:40
 */

namespace App\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class HelpConversation extends Conversation
{
    /**
     * First question
     */
    public function help()
    {
        $question = Question::create("Escolha uma opção abaixo ou envie uma mensagem com a palavra *comandos* para ver todas as opções.")
            ->fallback('Opps tente outra vez...')
            ->callbackId('ask_help')
            ->addButtons([
                Button::create('Incêndios activos')->value('active'),
                Button::create('Estatísticas')->value('stats'),
                Button::create('Estado')->value('status'),
                Button::create('Meios Aéreos')->value('aereal'),
//                Button::create('Risco')->value('risk')->additionalParameters(['concelho']),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                switch ($answer->getValue()) {
                    case 'active':
                        $this->getActive();
                        break;
                    case 'stats':
                        $this->say($this->getStats());
                        break;
                    case 'aereal':
                        $this->say($this->getAereal());
                        break;
                    case 'status':
                        $this->say($this->getStatus());
                        break;
                    default:
                        if (preg_match('/risk/', $answer->getValue())) {
                            $concelho = str_replace('risk ', '', $answer->getValue());

                            $status = \App\Lib\LegacyApi::getDangerLocation($concelho)['data'] ? \App\Lib\LegacyApi::getDangerLocation($concelho)['data'] : $concelho;
                            $this->say($status);
                        } else {
                            $this->say('Ooopppss ocorreu um erro.');
                        }
                }
            }
        });
    }

    private function getActive()
    {
        $fires = \App\Lib\LegacyApi::getActive()['data'];

        if (!empty($fires)) {
            foreach ($fires as $f) {
                $status = $f['location'] . ':%0A 👨‍🚒: ' . $f['man'] . '%0A 🚒: ' . $f['terrain'] . '%0A 🚁: ' . $f['aerial'] . '%0A ➡️ ' . $f['status'] . '%0A  ➡️' . $f['natureza'] . ' %0A  https://fogos.pt/fogo/' . $f['id'] . ' %0A #FogosPT';
                $this->say($status);
            }
        } else {
            $date = date("H:i");
            $status = "{$date} - Sem registo de incêndios ativos https://fogos.pt #FogosPT #Status";
        }

        return $status;
    }

    private function getStats()
    {
        $status = \App\Lib\LegacyApi::getStats()['data'];

        return $status;
    }

    private function getAereal()
    {
        $status = \App\Lib\LegacyApi::getAerial()['data'];

        return $status;
    }

    private function getStatus()
    {
        $status = \App\Lib\LegacyApi::getStatus()['data'];

        return $status;
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->help();
    }
}
