<?php

namespace Api\V1\Model;

abstract class Media extends Base
{
    public string $title = '';
    public string $description = '';
    public float $rating = 0.0;
    public array $generes = [];

}