<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Class MailerController
 * @package AppBundle\Controller
 *
 * Мой класс для отправки сообщений по почте
 * В данном случае используется отправка через gmail
 * Для настройки надо задать в файле app/config/parameters.yml
 * параметры, следуя инструкциям в этом файле
 * Также в настройках gmail нужно включить разрешение
 * для ненадежных приложений
 */
class MailerController extends Controller
{
    /**
     * @Route("/mailer", name="_mailer")
     */
    public function mailAction(Request $request)
    {
        $name = "Женя";
        $message = \Swift_Message::newInstance()
            ->setSubject('Мое письмо из Symfony')
            ->setFrom('paratagas@gmail.com')
            ->setTo('partagas@mail.ru')
            // простая фраза
            //->setBody('message');
            // шаблон
            ->setBody(
                $this->renderView(
                    'mailer/mailer.html.twig',
                    array('name' => $name)
                ),
                'text/html'
            )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;
        $this->get('mailer')->send($message);

        return new Response(
            "<html><body>
            <p>Email <b>send</b></p>
            </body></html>"
        );
    }
}