<?php

namespace App\Repositories\Php46Elks\Clients\PhoneCall;

use App\Repositories\Php46Elks\Clients\BaseClient;
use App\Repositories\Php46Elks\Clients\PhoneCall\Services\PhoneCallRouterService;
use App\Repositories\Php46Elks\Clients\PhoneCall\Services\PhoneCallDispatcherService;
use App\Repositories\Php46Elks\Clients\PhoneCall\Services\PhoneCallHistoryService;
use App\Repositories\Php46Elks\Clients\PhoneCall\Services\PhoneCallReceiverService;
use App\Repositories\Php46Elks\Clients\PhoneCall\Traits\CommonPhoneTraits;
use App\Repositories\Php46Elks\Traits\QueryOptionTrait;

class PhoneCallClient extends BaseClient
{
    use QueryOptionTrait, CommonPhoneTraits;

    /**
     * @return PhoneCallDispatcherService
     */
    public function dispatcher()
    {
        return new PhoneCallDispatcherService($this);
    }

    /**
     * @return PhoneCallReceiverService
     */
    public function receiver()
    {
        return new PhoneCallReceiverService;
    }

    /**
     * @return PhoneCallRouterService
     */
    public function router(): PhoneCallRouterService
    {
        return new PhoneCallRouterService;
    }

    /**
     * @return PhoneCallHistoryService
     */
    public function history()
    {
        return new PhoneCallHistoryService($this);
    }
}
