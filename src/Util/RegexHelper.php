<?php
namespace AflCrawler\Util;

class RegexHelper
{
    private static $tableHeading = <<<EOT
/(\[Game by Game\]\#PlayerGMKIMKHBDIDAGLBHHOTKRBIFCLCGFFFABRCPUPCMMI1\%BOGA\%PSU)$/
EOT;

    public static function isTableHeading(string $text): bool
    {
        return preg_match(self::$tableHeading, $text);
    }

    public static function getTeamFromHeading(string $text)
    {
        return trim(preg_replace(self::$tableHeading, '', $text));
    }
}
