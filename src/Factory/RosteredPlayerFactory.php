<?php
namespace AflCrawler\Factory;

use AflCrawler\Model\ModelInterface;
use AflCrawler\Model\RosteredPlayer;

class RosteredPlayerFactory implements FactoryInterface
{
    public function build(array $data): ModelInterface
    {
        $rPlayer = new RosteredPlayer;
        !isset($data['model']) ?: $rPlayer->setPlayer($data['model']);
        !isset($data['number']) ?: $rPlayer->setNumber($data['number']);
        return $rPlayer;
    }
}