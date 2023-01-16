<?php

namespace App\Dto;

use Illuminate\Http\JsonResponse;
use Throwable;

class ExceptionDto extends Dto
{
    public string $name;
    public string $message;
    public array $trace;
    public int $statusCode;
    public JsonResponse $response;
    public array $array;

    public function __construct(Throwable $exception, int $statusCode)
    {
        $this->name = $exception::class;
        $this->message = $exception->getMessage();
        $this->trace = $exception->getTrace();
        $this->statusCode = $statusCode;
        $this->response = response()->json(['message' => $this->message], $statusCode);

        $this->array = parent::transformToArray($this);
    }
}
