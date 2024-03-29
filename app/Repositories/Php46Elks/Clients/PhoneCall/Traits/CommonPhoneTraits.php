<?php

namespace App\Repositories\Php46Elks\Clients\PhoneCall\Traits;

use App\Repositories\Php46Elks\Clients\PhoneCall\Resources\PhoneCallAction;
use App\Repositories\Php46Elks\Exceptions\InvalidSenderIdException;
use App\Repositories\Php46Elks\Utils\Helper;

trait CommonPhoneTraits
{
    /**
     * @param string $senderId
     * @return $this
     * @throws InvalidSenderIdException
     */
    public function from(string $senderId): self
    {
        Helper::validateSenderID($senderId);

        return $this->setOption('from', $senderId);
    }

    /**
     * URL to send call data to when call ends.
     * @param $url
     * @return $this
     */
    public function whenHangup($url): self
    {
        $url = Helper::url($url);
        return $this->setOption('whenhangup', $url);
    }


    /**
     * A webhook URL that returns the first action to execute. See Call actions for details. It is also possible to add a JSON struct for direct call actions without any logic
     * @param PhoneCallAction|callable $action
     * @return mixed
     */
    public function voiceStart($action)
    {
        if ($action instanceof PhoneCallAction) {
            $payload = $action->toJson();
        } else {
            $payload = $action(new PhoneCallAction)->toJson();
        }

        return $this->setOption('voice_start', $payload);
    }


    /**
     * @param int $timeout
     * @return mixed
     */
    public function timeout($timeout = 60)
    {
        return $this->setOption('timeout', $timeout);
    }
}
