<?php 

namespace App\Actions;

use App\User;

class ListUserData
{
	public function execute($request)
	{
		$query = User::query();

        if ($request->filled('provider'))
            $query->where('provider', $request->provider);

        if ($request->filled('statusCode'))
            $query->where('status_code', $request->statusCode);

        if ($request->filled('balanceMin') && $request->filled('balanceMax'))
            $query->whereBetween('amount', [$request->balanceMin, $request->balanceMax]);

        if ($request->filled('currency'))
            $query->where('currency', $request->currency);

        return $query->paginate();
	}
}