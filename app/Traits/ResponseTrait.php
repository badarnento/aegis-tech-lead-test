<?php

namespace App\Traits;

trait ResponseTrait
{
	public function successResponse($messages = [], $data = [], $code = 200)
	{
		$respone = [
			'type'    => 'success',
			'message' => $messages,
			'data'    => $data
		];

		return response()->json($respone, $code);
	}

	public function errorResponse($messages = [], $data = [], $code = 500)
	{
		$respone = [
			'type'    => 'error',
			'message' => $messages,
			'data'    => $data
		];

		return response()->json($respone, $code);
	}

}
