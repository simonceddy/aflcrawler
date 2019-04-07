<?php
namespace AflCrawler\Model;

abstract class BaseModel implements ModelInterface
{
    protected $fields;

    protected $values = [];

    protected $original = [];

    public function toArray()
    {
        return [];
    }
}
