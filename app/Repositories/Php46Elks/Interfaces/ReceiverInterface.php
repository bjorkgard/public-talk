<?php

namespace App\Repositories\Php46Elks\Interfaces;

interface ReceiverInterface
{
    public function handleRequest(callable $fnc, array $request = null);
}
