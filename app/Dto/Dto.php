<?php

namespace App\Dto;

abstract class Dto
{
    public function transformToArray(Dto $dto)
    {
        return get_object_vars($dto);
    }
}
