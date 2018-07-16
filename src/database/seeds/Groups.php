<?php

use App\Repos\Concretes\Eloquent\Models\EloquentGroup;
use Illuminate\Database\Seeder;

class Groups extends Seeder
{

    public function run()
    {
        $groups = [
            [
                'name' => 'vehicles',
                'parent_id' => null,
                'ref' => 'vehicles',
            ],
            [
                'name' => 'vacancies',
                'parent_id' => null,
                'ref' => 'vacancies',
            ],
//			[
//				'name' => '' ,
//				'parent_id' => NULL ,
//				'ref' => NULL ,
//			] ,
        ];

        foreach ($groups as $group) {
            $eloquentGroup = new EloquentGroup();

            $eloquentGroup -> name = $group['name'];
            $eloquentGroup -> parent_id = $group['parent_id'];
            $eloquentGroup -> ref = $group['ref'];

            $eloquentGroup -> save();
        }
    }

}
