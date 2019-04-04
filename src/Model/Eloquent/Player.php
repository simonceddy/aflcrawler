<?php
namespace AflCrawler\Model\Eloquent;

use Illuminate\Database\Eloquent\Model;
use AflCrawler\Model\ModelInterface;

class Player extends Model implements ModelInterface
{
    protected $fillable = [
        'surname',
        'given_names'
    ];
}
