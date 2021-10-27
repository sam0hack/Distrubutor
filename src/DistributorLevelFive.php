<?php


namespace sam0hack\Distributor;

use Illuminate\Database\Eloquent\Model;
use sam0hack\Distributor\Traits\LevelScopes;

class DistributorLevelFive extends Model
{
    protected $guarded = [];
    protected $table = 'distributor_level_five';
    use LevelScopes;




}