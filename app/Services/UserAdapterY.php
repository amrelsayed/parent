<?php

namespace App\Services;

use App\Services\UserAdapter;
use App\Services\UserAdapterInterface;
use App\User;
use Carbon\Carbon;

class UserAdapterY extends UserAdapter implements UserAdapterInterface
{
	const STATUS_CODES = [
		100 => 'authorised',
		200 => 'declined',
		300 => 'refunded',
	];
	
	public function normalize():array
	{
		return [
			'provider' => 'DataProviderY',
			'amount' => $this->user_data->balance,
			'currency' => $this->user_data->currency,
			'email' => $this->user_data->email,
			'status_code' => self::STATUS_CODES[$this->user_data->status],
			'created_at' => Carbon::createFromFormat('d/m/Y', $this->user_data->created_at)->toDateString(),
			'provider_id' => $this->user_data->id,
		];
	}
}