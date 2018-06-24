<?php

namespace App\Repos\Concretes\Eloquent\Models ;

use Illuminate\Database\Eloquent\Model ;

abstract class Base extends Model
{

	public function getCreatedAtTimestampOrNull ()
	{
		if ( $this -> created_at )
		{
			return
				$this
				-> created_at
				-> timestamp
			;
		}

		return NULL ;
	}

	public function getDeletedAtTimestampOrNull ()
	{
		if ( $this -> deleted_at )
		{
			return
				$this
				-> deleted_at
				-> timestamp
			;
		}

		return NULL ;
	}

	public function getUpdatedAtTimestampOrNull ()
	{
		if ( $this -> updated_at )
		{
			return
				$this
				-> updated_at
				-> timestamp
			;
		}

		return NULL ;
	}

}
