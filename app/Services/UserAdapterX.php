<?php

namespace App\Services;

use App\Services\UserAdapter;
use App\Services\UserAdapterInterface;
use App\User;

class UserAdapterX extends UserAdapter implements UserAdapterInterface
{
	const STATUS_CODES = [
		1 => 'authorised',
		2 => 'declined',
		3 => 'refunded',
	];

	public function normalize():array
	{
		return [
			'provider' => 'DataProviderX',
			'amount' => $this->user_data->parentAmount,
			'currency' => $this->user_data->Currency,
			'email' => $this->user_data->parentEmail,
			'status_code' => self::STATUS_CODES[$this->user_data->statusCode],
			'created_at' => $this->user_data->registerationDate,
			'provider_id' => $this->user_data->parentIdentification,
		];
	}
}