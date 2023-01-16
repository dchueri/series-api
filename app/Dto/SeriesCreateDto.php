<?php

namespace App\Dto;

class SeriesCreateDto extends Dto
{
    public string $name;
    public array $array;

    public function __construct($name)
    {
        $this->name = $name;
        $this->array = parent::transformToArray($this);
    }
}
