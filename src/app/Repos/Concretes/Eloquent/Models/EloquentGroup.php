<?php

namespace App\Repos\Concretes\Eloquent\Models ;

use Illuminate\Database\Eloquent\SoftDeletes ;

class EloquentGroup extends Base
{

	use SoftDeletes ;

	protected $table = 'groups' ;

}
