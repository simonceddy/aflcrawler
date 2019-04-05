<?php
namespace AflCrawler\Support\Traits;

trait CurrentTeamAware
{
    /**
     * The current team (if applicable)
     *
     * @var AflCralwer\Model\ModelInterface
     */
    protected $currentTm;

    /**
     * Internal helper for quickly accessing the short name of the current Team.
     *
     * @return false|string
     */
    protected function tm()
    {
        return !$this->currentTm ? false : $this->currentTm->getShortName();
    }
}
