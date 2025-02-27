<?php

namespace Api\V1\Model;

use Api\ApiBase;

abstract class Base extends ApiBase
{
    public int $id = 0;
    protected ?\DateTime $deletedOn = null;
}