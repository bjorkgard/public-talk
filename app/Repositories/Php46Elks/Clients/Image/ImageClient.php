<?php

namespace App\Repositories\Php46Elks\Clients\Image;

use App\Repositories\Php46Elks\Clients\BaseClient;
use App\Repositories\Php46Elks\Clients\Image\Resources\Image;
use App\Repositories\Php46Elks\Traits\DataResourceFilterTrait;
use App\Repositories\Php46Elks\Traits\QueryOptionTrait;
use App\Repositories\Php46Elks\Utils\FileResource;
use App\Repositories\Php46Elks\Utils\Paginator;

class ImageClient extends BaseClient
{
    use QueryOptionTrait, DataResourceFilterTrait;

    /**
     * Get MMS Image History
     *
     * @return Paginator
     */
    public function get(): Paginator
    {
        // perform request
        $request = $this->getGuzzleClient()->get('images');

        // catch result
        $response = $request->getBody()->getContents();

        // deserialize
        $assoc = json_decode($response, true);

        // create payload
        $payload = [
            'next' => isset($assoc['next']) ? $assoc['next'] : null,
            'data' => array_map(function ($row) {
                return new Image($row, $this);
            }, $assoc['data'])
        ];

        // return new pagination object
        return new Paginator($payload);
    }

    /**
     * Get MMS Image History by id
     *
     * @return Paginator
     */
    public function getById(string $id): Image
    {
        // perform request
        $request = $this->getGuzzleClient()->get("images/$id");

        // catch result
        $response = $request->getBody()->getContents();

        // deserialize
        $assoc = json_decode($response, true);

        // return image object
        return new Image($assoc, $this);
    }

    /**
     * Returns the image file of the image with the specified ID.
     *
     * @param string $id
     * @param string $format
     * @return FileResource
     */
    public function getFileById(string $id, string $format = 'jpg'): FileResource
    {

        // perform request
        $res = $this->getGuzzleClient()->get("images/$id.$format", $this->getOptions(true));

        // return file resource
        return new FileResource($res->getBody()->getContents(), $this);
    }
}
