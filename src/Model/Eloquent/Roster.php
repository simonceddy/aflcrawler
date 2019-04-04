<?php
namespace AflCrawler\Model\Eloquent;

use Illuminate\Database\Eloquent\Model;
use AflCrawler\Model\ModelInterface;

class Roster extends Model implements ModelInterface
{
    protected $fillable = [
        'team_id',
        'season'
    ];
}
