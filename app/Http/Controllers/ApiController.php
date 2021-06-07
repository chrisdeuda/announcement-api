<?php


namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;


class ApiController extends Controller
{
    protected $statusCode = 200;

    const STATUS_NOT_FOUND_CODE = 404;
    const STATUS_OK_CODE = 200;
    const STATUS_OK_CREATED_CODE = 201;
    const STATUS_INTERNAL_SERVER_ERROR = 500;

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return ApiController
     */
    public function setStatusCode($statusCode): ApiController
    {
        $this->statusCode = $statusCode;
        return $this;
    }


    /**
     * @param string $message
     * @return JsonResponse
     */
    public function responseNotFound($message = 'Not Found'){

        return $this->setStatusCode(self::STATUS_NOT_FOUND_CODE)->respondWithError($message);

    }

    /**
     * @param $data
     * @param $headers
     * @return JsonResponse
     */
    public function respond($data, $headers = []){

        return response()->json($data,
        $this->getStatusCode(), $headers);

    }

    /**
     * @param $message
     * @return JsonResponse
     */
    public function respondWithError($message){
        return response()->json([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ], $this->getStatusCode());
    }
    /**
     * @param $message
     * @return JsonResponse
     */
    public function respondWithMessage($message){
        return response()->json([
            'data' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ], $this->getStatusCode());
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function respondInternalError($message = "Internal Error"){
        return $this->setStatusCode(self::STATUS_INTERNAL_SERVER_ERROR)->respondWithError($message);

    }

    /**
     * @param $message
     * @return JsonResponse
     */
    public function respondCreated($message){
        return $this
            ->setStatusCode(self::STATUS_OK_CREATED_CODE)
            ->respond($message);
    }

}
