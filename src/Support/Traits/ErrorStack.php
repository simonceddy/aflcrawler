<?php
namespace AflCrawler\Support\Traits;

trait ErrorStack
{
    protected $errors = [];

    public function hasErrors()
    {
        return !empty($this->errors);
    }
}
