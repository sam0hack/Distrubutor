<?php


namespace sam0hack\Distributor;

use Illuminate\Database\Eloquent\Model;
use sam0hack\Distributor\Traits\LevelScopes;

class DistributorLevelSix extends Model
{
    protected $guarded = [];
    protected $table = 'distributor_level_six';
    use LevelScopes;





}