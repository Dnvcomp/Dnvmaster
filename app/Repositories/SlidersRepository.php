<?php

namespace Dnvmaster\Repositories;

use Dnvmaster\Slider;

class SlidersRepository extends Repository
{
    public function __construct(Slider $slider)
    {
        $this->model = $slider;
    }
}