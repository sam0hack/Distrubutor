<?php


namespace sam0hack\Distributor;

use Illuminate\Database\Eloquent\Model;
use sam0hack\Distributor\Traits\LevelScopes;

class DistributorLevelTwo extends Model
{
    protected $guarded = [];
    protected $table = 'distributor_level_two';
    use LevelScopes;



}