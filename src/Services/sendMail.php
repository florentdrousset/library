<?php

namespace App\Services;

class sendMail
{
    public function sendMailAfterRegistration(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Welcome'))
            ->setFrom('send@example.com')
            ->setTo($this->getUser()->getEmail())
            ->setBody('Félicitations, vous venez de vous inscrire sur Library.')

        ;

        $mailer->send($message);
    }

    public function sendMailBeforeReturn(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Information'))
            ->setFrom('send@example.com')
            ->setTo($this->getUser()->getEmail())
            ->setBody('Félicitations, vous venez de vous inscrire sur Library.')

        ;

        $mailer->send($message);

    }

}

?>