<?php

namespace App\Services;

use App\Entity\User;

class SendMail
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMailAfterRegistration(User $user)
    {
        $message = (new \Swift_Message('Welcome'))
            ->setFrom('admin@example.com')
            ->setTo($user->getEmail()) //User renvoyé par le getter de RegisterEvent
            ->setBody('Félicitations, vous venez de vous inscrire sur Library.')
        ;

        $this->mailer->send($message);
    }

    public function sendMailBeforeReturn()
    {
        $message = (new \Swift_Message('Information'))
            ->setFrom('send@example.com')
            ->setTo($this->getUser()->getEmail())
            ->setBody('Félicitations, vous venez de vous inscrire sur Library.')

        ;

        $this->mailer->send($message);

    }

}

?>