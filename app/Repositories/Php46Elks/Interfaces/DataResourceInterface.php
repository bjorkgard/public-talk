<?php

namespace App\Repositories\Php46Elks\Interfaces;

use App\Repositories\Php46Elks\Utils\Paginator;

interface DataResourceInterface
{
    /**
     * @return Paginator
     */
    public function get(): Paginator;

    /**
     * @param string $id
     * @return mixed
     */
    public function getById(string $id);
}
