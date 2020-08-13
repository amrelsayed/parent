<?php 

namespace App\Services;

interface UserAdapterInterface
{
	public function normalize():array;
}