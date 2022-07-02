<?php

namespace Saperemarketing\Tests\SCart\Fixtures;

class ProductModel
{
    public $someValue = 'Some value';

    public function find($id)
    {
        return $this;
    }
}