<?php

namespace App\Services;

use App\Entity\User;
use App\Entity\Booking;

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
            ->setFrom('register@example.com')
            ->setTo($user->getEmail()) //User renvoyé par le getter de RegisterEvent
            ->setBody('Félicitations, vous venez de vous inscrire sur Library.')
        ;

        $this->mailer->send($message);
    }

    public function sendMailAfterBooking(User $user)
    {
        $message = (new \Swift_Message('Votre commande'))
            ->setFrom('booking@example.com')
            ->setTo($user->getEmail())
            ->setBody('Vous avez bien loué votre livre')
            ;
    }

    public function sendMailBeforeReturn(Booking $booking)
    {        
        $message = (new \Swift_Message('Info fin de réservation'))
            ->setFrom('returnbook@example.com')
            ->setTo($booking->getUser()->getEmail())
            ->setBody('<html>' .
                    ' <head></head>' .
                    ' <body>' .
                    ' Votre réservation du livre "'.$booking->getBook()->getTitle().'" se termine dans 3 jours.<br>Cliquez sur le lien ci-dessous pour prolonger votre réservation de 15 jours.<br>' .
                    '<a href="http://localhost/library/public/prolongation/'.$booking->getId().'">Prolonger ma réservation</a>'.
                    ' </body>' .
                    '</html>',
                    'text/html'
            );

        $this->mailer->send($message);

        var_dump($booking->getUser()->getEmail());
        
    }

}

?>