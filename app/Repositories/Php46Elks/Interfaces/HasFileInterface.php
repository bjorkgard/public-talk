<?php

namespace App\Repositories\Php46Elks\Interfaces;

use App\Repositories\Php46Elks\Utils\FileResource;

interface HasFileInterface
{

    public function withFile(): FileResource;
}
