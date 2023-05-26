<?php

namespace app\core\middlewares;

use app\core\Application;
use app\core\exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{
    public array $action = [];

    public function __construct(array $actions = [])
    {
        $this->action = $actions;
    }

    public function execute()
    {
        if (Application::isGuest()) {
            if (empty($this->action) || in_array(Application::$app->controller->action, $this->action)) {
                throw new ForbiddenException();
            }
        }
    }
}