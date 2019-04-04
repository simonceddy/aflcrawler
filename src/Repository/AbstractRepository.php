<?php
namespace AflCrawler\Repository;

use AflCrawler\Storage\StorageInterface;

abstract class AbstractRepository
{
    protected $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }
}
