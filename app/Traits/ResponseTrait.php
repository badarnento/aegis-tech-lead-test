<?php

namespace App\Traits;

trait ResponseTrait
{
	public function successResponse($messages = "", $data = null, $code = 200)
	{
		$respone = [
			'type'    => 'success',
			'message' => $messages,
			'data'    => $data
		];

		return response()->json($respone, $code);
	}

	public function errorResponse($messages = "", $data = null, $code = 500)
	{
		$respone = [
			'type'    => 'error',
			'message' => $messages,
			'data'    => $data
		];

		return response()->json($respone, $code);
	}

	public function paginationResource($paginateData = null, $dataKey = 'data')
	{
		$paginateData = $paginateData->toArray();

		$respone = [
			"page"       => $paginateData['current_page'],
			"per_page"   => $paginateData['per_page'],
			"total_page" => $paginateData['total'],
			$dataKey     => $paginateData['data']
		];

		return $respone;
	}
}
