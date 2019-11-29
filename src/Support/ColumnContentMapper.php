<?php
namespace AflCrawler\Support;

use AflCrawler\Contracts\Mapper;
use AflCrawler\Util\PlayerName;

class ColumnContentMapper implements Mapper
{
    public function __invoke($val, string $key)
    {
        if ($key === 'player') {
            return PlayerName::make($val);
        }
        
        if (is_numeric($val)) {
            return (float) $val;
        }
        
        if (!preg_match('/\w|\d/', $val)) {
            return 0;
        }
        return trim($val);
    }
}
