<?php

namespace Jaxon\App\Test;

use Jaxon\App\CallableClass as JaxonClass;
use Twig\Environment as TemplateEngine;

class Bts extends JaxonClass
{
    protected $twig;

    public function __construct(TemplateEngine $twig)
    {
        $this->twig = $twig;
    }

    public function sayHello($isCaps, $bNotify = true)
    {
        // $html = $this->view()->render('test/hello', ['isCaps' => $isCaps]);
        $html = (($isCaps) ? 'HELLO WORLD!' : 'Hello World!');
        $this->response->assign('div2', 'innerHTML', $html);
        if(($bNotify))
        {
            // Show last command, and save this one in the session.
            $this->cl(Session::class)->command('sayHello');
            // Show a success notification.
            $message = $this->view()->render('test/message', [
                'element' => 'div2',
                'attr' => 'text',
                'value' => $html,
            ]);
            $this->response->dialog->success($message, $this->session()->get('DialogTitle', 'No title'));
        }

        return $this->response;
    }

    public function setColor($sColor, $bNotify = true)
    {
        $this->response->assign('div2', 'style.color', $sColor);
        $this->response->dialog->hide();
        if(($bNotify))
        {
            // Show last command, and save this one in the session.
            $this->cl(Session::class)->command('setColor');
            // Show a success notification.
            $message = $this->view()->render('test/message', [
                'element' => 'div2',
                'attr' => 'color',
                'value' => $sColor,
            ]);
            $this->response->dialog->success($message . '', $this->session()->get('DialogTitle', 'No title'));
        }

        return $this->response;
    }

    public function showDialog()
    {
        $buttons = array(
            array(
                'title' => 'Clear session',
                'class' => 'btn',
                'click' => $this->cl('.Session')->rq()->reset()
            ),
            array(
                'title' => 'Close',
                'class' => 'btn',
                'click' => 'close'
            )
        );
        $width = 300;
        $html = $this->view()->render('test/credit', ['library' => 'Twitter Bootstrap']);
        $this->response->dialog->show("Modal Dialog", $html, $buttons, compact('width'));

        return $this->response;
    }
}
