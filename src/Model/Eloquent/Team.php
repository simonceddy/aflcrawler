<?php
namespace AflCrawler\Model\Eloquent;

use Illuminate\Database\Eloquent\Model;
use AflCrawler\Model\ModelInterface;

class Team extends Model implements ModelInterface
{
    protected $fillable = [
        'name',
        'city',
        'short'
    ];

    public function rosters()
    {
        return $this->hasMany(Roster::class);
    }
}
