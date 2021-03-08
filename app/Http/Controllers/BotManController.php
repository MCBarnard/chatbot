<?php
namespace App\Http\Controllers;

use App\Services\BotmanService;
use BotMan\BotMan\Middleware\Dialogflow;

class BotManController extends Controller
{
    /**
     * Botman view.
     */
    public function show() {
        return view('botman.index');
    }

    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function($botman, $message) {
            $botmanService = new BotmanService();

            $cleanMessage = "";
            // ToDo:: Run through some AI to clean the response
            if (strpos($message, "hi") !== false) {
                $cleanMessage = "intro";
            } elseif (strpos($message, "signature mismatch") !== false) {
                $cleanMessage = 'signature-mismatch';
            } elseif (strpos($message, "Invalid merchant key") !== false) {
                $cleanMessage = 'invalid-merchant-key';
            }

            switch ($cleanMessage) {
                case 'intro':
                    $botmanService->askName($botman);
                    break;
                case 'signature-mismatch':
                    $botmanService->giveSignatureOptions($botman);
                    break;
                case 'invalid-merchant-key':
                    $botmanService->explainMerchantKeyInvalid($botman);
                    break;
                default:
                    $botman->reply("I dont seem to follow that request, please try something like 'signature mismatch");
            }

        });

        $botman->listen();
    }
}
