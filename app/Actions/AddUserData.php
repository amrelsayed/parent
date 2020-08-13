<?php 

namespace App\Actions;

use App\User;

class AddUserData
{
	public function execute($file_name, $adapter)
	{
		$data = file_get_contents(public_path('jsons/' . $file_name));

    	$users = json_decode($data)->users;

    	foreach ($users as $user) {
    		$class_name = "\App\Services\\$adapter";
    		$userAdapter = new $class_name($user);
    		User::create($userAdapter->normalize());
    	}
	}
}