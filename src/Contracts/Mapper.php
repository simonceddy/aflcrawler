<?php
namespace AflCrawler\Contracts;

interface Mapper
{
    public function __invoke($val, string $key);
}
