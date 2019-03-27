<?php
namespace AflCrawler\Factory;

use AflCrawler\Model\ModelInterface;
use AflCrawler\Model\Player;

class PlayerFactory implements FactoryInterface
{
    public function build(array $data): ModelInterface
    {
        $player = new Player;
        $name = isset($data['player'])
            ? explode(',', $data['player'], 2)
            : null;
        if (is_array($name)) {
            $player->setSurname($name[0]);
            !isset($name[1]) ?: $player->setGivenNames($name[1]);
        }
        return $player;
    }
}
