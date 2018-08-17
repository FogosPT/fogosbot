<?php
/**
 * Created by PhpStorm.
 * User: tomahock
 * Date: 17/08/2018
 * Time: 23:40
 */

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
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
        $question = Question::create("O que precisa de saber?")
            ->fallback('Opps tente outra vez...')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Incêndios activos')->value('active'),
                Button::create('Estatísticas')->value('stats'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                switch ($answer->getValue()){
                    case 'active':
                        $this->say($this->getActive());
                        break;
                    case 'stats':
                        $this->say($this->getStats());
                        break;
                    default:
                        $this->say('Ooopppss ocorreu um erro.');
                }
            }
        });
    }

    private function getActive()
    {
        $fires = \App\Lib\LegacyApi::getActive()['data'];

        if (!empty($fires)) {
            foreach ($fires as $f) {
                $status = $f['location'] . ' - MH: ' . $f['man'] . ' MT: ' . $f['terrain'] . ' MA: ' . $f['aerial'] . ' - ' . $f['status'] . ' - ' . $f['natureza'] . ' https://fogos.pt/fogo/' . $f['id'] . ' #FogosPT';
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

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->help();
    }
}
