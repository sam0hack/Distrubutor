<?php


namespace sam0hack\Distributor;

use Illuminate\Database\Eloquent\Model;
use sam0hack\Distributor\Traits\LevelScopes;

class DistributorLevelThree extends Model
{
    protected $guarded = [];
    protected $table = 'distributor_level_three';
    use LevelScopes;






}