<?php
namespace AflCrawler\Util;

class TableHeading
{
    public const REGEX_PATTERN = <<<EOT
/(\[Players\sGame\sby\sGame\]\[Team\sGame\sby\sGame\]\#PlayerGMKIMKHBDIDAGLBHHOTKRBIFCLCGFFFABRCPUPCMMI1\%BOGA\%PSU)$/
EOT;

    public static function matches(string $text): bool
    {
        return preg_match(self::REGEX_PATTERN, $text);
    }

    public static function extractFrom(string $text)
    {
        return trim(preg_replace(self::REGEX_PATTERN, '', $text));
    }
}
