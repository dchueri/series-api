<?php

namespace App\Dto;

class EpisodeUpdateDto extends Dto
{
    public bool $watched;
    public array $array;

    public function __construct($watched)
    {
        $this->watched = $watched;
        $this->array = parent::transformToArray($this);
    }
}
