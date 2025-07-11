<?php 
namespace App\Service;

class MessageGenerator
{
    public function getHappyMessage(): string
    {
        $messages = [
            'Vive les glaces',
            'J\'aime les glaces à tout les goût et aucun ne me dégoute',
            'C\'est froid bordel',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }
}