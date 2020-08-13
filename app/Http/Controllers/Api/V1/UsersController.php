<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\AddUserData;
use App\Actions\ListUserData;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $addUserData;
    protected $listUserData;

    public function __construct(AddUserData $addUserData, ListUserData $listUserData)
    {
        $this->addUserData = $addUserData;
    	$this->listUserData = $listUserData;
    }

    public function index(Request $request)
    {
        $users = $this->listUserData->execute($request);

        return response()->Json($users);
    }

    public function addData()
    {
    	$this->addUserData->execute('DataProviderX.json', 'UserAdapterX');
    	
    	$this->addUserData->execute('DataProviderY.json', 'UserAdapterY');

    	return 'done';
    }
}
