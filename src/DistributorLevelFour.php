<?php


namespace sam0hack\Distributor;

use Illuminate\Database\Eloquent\Model;
use sam0hack\Distributor\Traits\LevelScopes;

class DistributorLevelFour extends Model
{
    protected $guarded = [];
    protected $table = 'distributor_level_four';
    use LevelScopes;







}