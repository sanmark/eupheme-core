<?php

namespace App\Validators\Concretes\Laravel\Validators ;

use App\Validators\Exceptions\InvalidInputException ;
use function validator ;

abstract class Base
{

	protected function process ( array $data , array $mixedRulesAndMessages )
	{
		$rulesAndMessages = $this -> rearrangeMixedRulesAndMessages ( $mixedRulesAndMessages ) ;
		$rules = $rulesAndMessages[ 'rules' ] ;
		$messages = $rulesAndMessages[ 'messages' ] ;

		$messagesLaravelStyle = $this -> generateLaravelStyleMessages ( $messages ) ;

		$validator = validator ( $data , $rules , $messagesLaravelStyle ) ;

		if ( $validator -> fails () )
		{
			$errors = $validator
				-> errors ()
				-> toArray ()
			;

			throw new InvalidInputException ( $errors ) ;
		}
	}

	/**
	 * Generate Laravel style validator messages array from a validator message
	 * array style specific to this system.
	 * 
	 * System style:
	 * 
	 * [
	 *     'field_n' => [
	 *         'rule_m' => 'message_m',
	 *         'rule_m+1' => 'message_m+1',
	 *     ],
	 *     'field_n+1' => [
	 *         'rule_l' => 'message_l',
	 *         'rule_l+1' => 'message_l+1',
	 *     ],
	 * ]
	 * 
	 * Laravel Style:
	 * 
	 * [
	 *     'field_n.rule_m' => 'message_m',
	 *     'field_n.rule_m+1' => 'message_m+1',
	 *     'field_n+1.rule_l' => 'message_l',
	 *     'field_n+1.rule_l+1' => 'message_l+1',
	 * ]
	 * 
	 * @param array $messages System style messages array.
	 */
	private function generateLaravelStyleMessages ( array $messages ): array
	{
		$laravelMessages = [] ;

		foreach ( $messages as $field => $rulesAndMessage )
		{
			foreach ( $rulesAndMessage as $rule => $message )
			{
				$fieldRuleCombo = $field . '.' . $rule ;

				$laravelMessages[ $fieldRuleCombo ] = $message ;
			}
		}

		return $laravelMessages ;
	}

	private function rearrangeMixedRulesAndMessages ( array $mixedRulesAndMessages ): array
	{
		$rules = [] ;
		$messages = [] ;

		foreach ( $mixedRulesAndMessages as $field => $ruleAndMessage )
		{
			$rule = array_keys ( $ruleAndMessage )[ 0 ] ;
			$message = array_values ( $ruleAndMessage )[ 0 ] ;

			$rules[ $field ][] = $rule ;
			$messages[ $field ][ $rule ] = $message ;
		}

		$return = [
			'rules' => $rules ,
			'messages' => $messages ,
			] ;

		return $return ;
	}

}
