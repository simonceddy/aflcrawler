<?php
namespace AflCrawler\Factory\Eloquent;

use AflCrawler\Model\ModelInterface;
use AflCrawler\Model\Eloquent\Player;
use AflCrawler\Factory\FactoryInterface;

class PlayerFactory implements FactoryInterface
{
    public function build(array $data): ModelInterface
    {
        $player = new Player;
        $name = isset($data['player'])
            ? explode(',', $data['player'], 2)
            : null;
        if (is_array($name)) {
            $player->surname = $name[0];
            !isset($name[1]) ?: $player->given_names = $name[1];
        }
        return $player;
    }
}
