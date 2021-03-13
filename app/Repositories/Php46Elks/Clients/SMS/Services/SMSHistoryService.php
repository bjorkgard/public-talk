<?php

namespace App\Repositories\Php46Elks\Clients\SMS\Services;

use App\Repositories\Php46Elks\Clients\SMS\Resources\Message;
use App\Repositories\Php46Elks\Clients\SMS\SMSServiceBase;
use App\Repositories\Php46Elks\Exceptions\InvalidE164PhoneNumberFormatException;
use App\Repositories\Php46Elks\Interfaces\DataResourceInterface;
use App\Repositories\Php46Elks\Traits\DataResourceFilterTrait;
use App\Repositories\Php46Elks\Traits\QueryOptionTrait;
use App\Repositories\Php46Elks\Utils\Paginator;
use App\Repositories\Php46Elks\Utils\Helper;
use GuzzleHttp\RequestOptions as GuzzleHttpRequestOptions;


class SMSHistoryService extends SMSServiceBase implements DataResourceInterface
{
    use QueryOptionTrait, DataResourceFilterTrait;

    /**
     * Filter on recipient.
     * @param $e164PhoneNumber
     * @return $this
     * @throws InvalidE164PhoneNumberFormatException
     */
    public function to($e164PhoneNumber): self
    {
        Helper::validateE164PhoneNumber($e164PhoneNumber);

        $this->setOption('to', $e164PhoneNumber);

        return $this;
    }


    /**
     * @return Paginator
     */
    public function get(): Paginator
    {
        //  request with optional options
        $request = $this->getSMSClient()->getGuzzleClient()->get($this->getMediaType(), [
            GuzzleHttpRequestOptions::QUERY => $this->getOptions()
        ]);

        // grab response
        $response = $request->getBody()->getContents();

        // deserialize
        $assoc = json_decode($response, true);

        // create payload
        $payload = [
            'next' => isset($assoc['next']) ? $assoc['next'] : null,
            'data' => array_map(function ($row) {
                return new Message($row);
            }, $assoc['data'])
        ];

        // return our pagination object
        return new Paginator($payload);
    }


    /**
     * @param string $id
     * @return Message
     */
    public function getById(string $id): Message
    {
        $request = $this->SMSClient->getGuzzleClient()->get(sprintf('%s/%s', $this->getMediaType(), $id));

        // grab response
        $response = $request->getBody()->getContents();

        // deserialize
        $assoc = json_decode($response, true);

        // return SMS object
        return new Message($assoc);
    }
}
