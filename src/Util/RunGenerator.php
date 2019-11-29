<?php
namespace AflCrawler\Util;

class RunGenerator
{
    public static function run(\Generator $generator)
    {
        $data = [];
        foreach ($generator as $process) {
            if (!$process) {
                continue;
            }
            $data[] = $process;
        }

        return $data;
    }
}
