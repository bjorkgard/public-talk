<?php

namespace App\Repositories\Php46Elks\Clients\SMS\Services;

use App\Repositories\Php46Elks\Clients\SMS\Resources\DeliveryReport;
use App\Repositories\Php46Elks\Interfaces\ReceiverInterface;

class SMSDLRService implements ReceiverInterface
{
    /**
     * @param callable $fnc
     * @param array|null $request
     * @return mixed
     */
    public function handleRequest(callable $fnc, array $request = null)
    {

        if (is_null($request)) {
            $request = $_REQUEST;
        }

        return $fnc(new DeliveryReport($request));
    }
}
