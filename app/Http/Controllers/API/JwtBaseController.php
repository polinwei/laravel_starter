<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class JwtBaseController extends Controller
{

    /**
     * sendResponse
     * 以 JSON 格式回傳成功訊息
     * @param  mixed $result
     * @param  mixed $message
     * @return JsonResponse
     */
    public function sendResponse($result, $message): JsonResponse
    {
    	$response = [
            'success' => true,
            'result'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * sendError
     * 以 JSON 格式回傳失敗訊息
     * @param  mixed $error
     * @param  mixed $errorMessages
     * @param  mixed $code
     * @return JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 404): JsonResponse
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
