<?php
namespace AflCrawler\Util;

final class PlayerName
{
    public static function make(string $value)
    {
        [$surname, $givenNames] = explode(', ', $value, 2);

        return [
            'surname' => $surname,
            'givenNames' => $givenNames,
        ];
    }
}
