<?php

namespace App\Validators\Concretes\Laravel\Validators ;

use App\Validators\Concretes\Laravel\Constants\ConstantsRules ;
use App\Validators\Constants\ConstantsResponses ;
use App\Validators\Contracts\ValidatorGroups ;

class ConcreteValidatorGroups extends Base implements ValidatorGroups
{

	public function create ( array $data )
	{
		$rules = [
			'name' => [
				ConstantsRules::Required => ConstantsResponses::Required ,
			] ,
			'parentId' => [
				ConstantsRules::Integer => ConstantsResponses::MustBeInteger ,
			] ,
			'ref' => [
				ConstantsRules::Required => ConstantsResponses::Required ,
			]
			] ;

		$this -> process ( $data , $rules ) ;
	}

	public function update ( array $data )
	{
		$rules = [
			'name' => [
				ConstantsRules::Required => ConstantsResponses::Required ,
			] ,
			'parentId' => [
				ConstantsRules::Integer => ConstantsResponses::MustBeInteger ,
			] ,
			'ref' => [
				ConstantsRules::Required => ConstantsResponses::Required ,
			]
			] ;

		$this -> process ( $data , $rules ) ;
	}

}
