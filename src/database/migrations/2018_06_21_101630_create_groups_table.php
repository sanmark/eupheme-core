<?php

use Illuminate\Support\Facades\Schema ;
use Illuminate\Database\Schema\Blueprint ;
use Illuminate\Database\Migrations\Migration ;

class CreateGroupsTable extends Migration
{

	public function up ()
	{
		Schema::create ( 'groups' , function (Blueprint $t)
		{
			$t -> increments ( 'id' ) ;
			$t -> string ( 'name' ) ;
			$t
				-> integer ( 'parent_id' )
				-> nullable ()
				-> unsigned ()
			;
			$t -> string ( 'ref' ) ;
			$t -> softDeletes () ;
			$t -> timestamps () ;

			$t
				-> foreign ( 'parent_id' )
				-> references ( 'id' )
				-> on ( 'groups' )
				-> onUpdate ( 'cascade' )
				-> onDelete ( 'cascade' )
			;
		} ) ;
	}

	public function down ()
	{
		Schema::dropIfExists ( 'groups' ) ;
	}

}
