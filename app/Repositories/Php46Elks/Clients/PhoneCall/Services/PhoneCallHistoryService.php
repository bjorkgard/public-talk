<?php

namespace App\Repositories\Php46Elks\Clients\PhoneCall\Services;

use App\Repositories\Php46Elks\Clients\PhoneCall\PhoneCallClient;
use App\Repositories\Php46Elks\Clients\PhoneCall\Resources\CallHistory;
use App\Repositories\Php46Elks\Interfaces\DataResourceInterface;
use App\Repositories\Php46Elks\Traits\DataResourceFilterTrait;
use App\Repositories\Php46Elks\Traits\QueryOptionTrait;
use App\Repositories\Php46Elks\Utils\Paginator;
use GuzzleHttp\RequestOptions as GuzzleHttpRequestOptions;

/**
 * @property PhoneCallClient phoneCallClient
 */
class PhoneCallHistoryService implements DataResourceInterface
{
    use DataResourceFilterTrait, QueryOptionTrait;

    protected $phoneCallClient;

    public function __construct(PhoneCallClient $client)
    {
        $this->phoneCallClient = $client;
    }

    /**
     * @inheritDoc
     */
    public function get(): Paginator
    {
        //  request with optional options
        $request = $this->phoneCallClient->getGuzzleClient()->get('calls', [
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
                return new CallHistory($row);
            }, $assoc['data'])
        ];

        // return our pagination object
        return new Paginator($payload);
    }

    /**
     * @inheritDoc
     * @return CallHistory
     */
    public function getById(string $id): CallHistory
    {
        $request = $this->phoneCallClient->getGuzzleClient()->get(sprintf('calls/%s', $id));

        // grab response
        $response = $request->getBody()->getContents();

        // deserialize
        $assoc = json_decode($response, true);

        // return SMS object
        return new CallHistory($assoc);
    }
}
