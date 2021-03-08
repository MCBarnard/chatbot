<?php

namespace App\Services;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotmanService {

    /**
     * Asks for the user's name and  replies nice to meet you {$Name}
     */
    public function askName($botman)
    {
        $botman->ask('Hello! What is your Name?', function(Answer $answer) {
            $name = $answer->getText();
            $this->say('Nice to meet you '.$name);
        });
    }

    /**
     * Sends back a list of options regarding the signature
     * @param $botman
     */
    public function giveSignatureOptions($botman)
    {
        $signatureDescription = "The PayFast signature is used to encrypt your data and ensure the " .
        "authenticity of the payload, this is further strengthened by adding a passphrase. Read about the passphrase "
            . "<a href='https://developers.payfast.co.za/docs#step_2_signature' target='_blank'>here!</a> <br><br>"
            . 'What do you need help with regarding the signature?';

        $signatureMismatchAnswer = $this->explainSignatureMismatch();
        $signatureGenerationAnswer = $this->explainSignatureGeneration();
        $endConversation = $this->endConversation();

        $botman->ask($signatureDescription, function(Answer $answer)
        use ($signatureMismatchAnswer, $signatureGenerationAnswer, $endConversation) {
            $issue = $answer->getText();
            switch ($issue) {
                case 'mismatch':
                    $this->say($signatureMismatchAnswer);
                    break;
                case 'generate':
                    $this->say($signatureGenerationAnswer);
                    break;
            }
            $this->say($endConversation);
        });

    }

    /**
     * Explains why the merchant key might nor be valid
     * @param $botman
     */
    public function explainMerchantKeyInvalid($botman)
    {
        $merchantKeyInvalidExplanation = "Have you recently been testing in the sandbox environment? " .
        "If so, please ensure that you are using the correct merchant_id and merchant_key combination from your "
            . "<a href='https://www.payfast.co.za/user/login' target='_blank'>PayFast Dashboard</a>";

        $endConversation = $this->endConversation();

        $botman->reply($merchantKeyInvalidExplanation);
        $botman->reply($endConversation);

    }

    /**
     * Explains a Signature mismatch
     */
    public function explainSignatureMismatch()
    {
        $explanation = "<a target='_blank' href='https://support.payfast.co.za/portal/en/kb/articles/common-causes-of-a-failed-integration-signature-mismatch'>".
                        "This</a> article explains in good detail why you are experiencing signature mismatches.";
        return $explanation;
    }

    /**
     * Explains how to generate Signature
     */
    public function explainSignatureGeneration()
    {
        $explanation = "<a target='_blank' href='https://developers.payfast.co.za/docs#step_2_signature'>".
            "This</a> will walk you through generating your signature";
        return $explanation;
    }

    /**
     * Explains how to generate Signature
     */
    public function endConversation()
    {
        $text = "Please feel free to ask something else...";
        return $text;
    }
}
