<?php

namespace App\Session;

use Illuminate\Session\Store;

class FlashMessage
{
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function success($message)
    {
        $this->message($message, 'is-primary');
    }

    public function info($message)
    {
        $this->message($message, 'is-info');
    }

    public function warn($message)
    {
        $this->message($message, 'warning');
    }

    public function error($message)
    {
        $this->message($message, 'is-danger');
    }

    public function message($message, $level = 'info')
    {
        $this->session->flash('flash_notification.message', $message);
        $this->session->flash('flash_notification.level', $level);
    }
}
