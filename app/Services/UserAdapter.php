<?php 

namespace App\Services;

class UserAdapter
{
	protected $user_data;

	public function __construct($user_data)
	{
		$this->user_data = $user_data;	
	}
}