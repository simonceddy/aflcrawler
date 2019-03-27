<?php
namespace AflCrawler\Factory;

use AflCrawler\Model\ModelInterface;

interface FactoryInterface
{
    public function build(array $data): ModelInterface;
}
