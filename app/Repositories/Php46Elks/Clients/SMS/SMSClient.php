<?php

namespace App\Repositories\Php46Elks\Clients\SMS;

use App\Repositories\Php46Elks\Clients\BaseClient;
use App\Repositories\Php46Elks\Clients\SMS\Services\SMSDispatcherService;
use App\Repositories\Php46Elks\Clients\SMS\Services\SMSDLRService;
use App\Repositories\Php46Elks\Clients\SMS\Services\SMSHistoryService;
use App\Repositories\Php46Elks\Clients\SMS\Services\SMSReceiverService;
use App\Repositories\Php46Elks\Clients\SMS\Traits\CommonSmsTraits;
use App\Repositories\Php46Elks\Traits\QueryOptionTrait;

class SMSClient extends BaseClient
{
    use CommonSmsTraits;
    use QueryOptionTrait;

    /**
     * type can be set to "sms" or "mms"
     * @param string $type
     * @return SMSDispatcherService
     * @throws InvalidSMSClientTypeException
     */
    public function dispatcher($type = 'sms'): SMSDispatcherService
    {
        return new SMSDispatcherService($this, $type);
    }

    /**
     * @return SMSDispatcherService
     * @throws InvalidSMSClientTypeException
     */
    public function SMSDispatcher(): SMSDispatcherService
    {
        return $this->dispatcher('sms');
    }

    /**
     * @return SMSDispatcherService
     * @throws InvalidSMSClientTypeException
     */
    public function MMSDispatcher(): SMSDispatcherService
    {
        return $this->dispatcher('mms');
    }

    /**
     * @return SMSReceiverService
     */
    public function receiver(): SMSReceiverService
    {
        return new SMSReceiverService;
    }

    /**
     * @return SMSDLRService
     */
    public function dlr(): SMSDLRService
    {
        return new SMSDLRService;
    }

    /**
     * @param string $type
     * @return SMSHistoryService
     * @throws InvalidSMSClientTypeException
     */
    public function history($type = 'sms'): SMSHistoryService
    {
        return new SMSHistoryService($this, $type);
    }
}
