<?php


namespace Islami\Shared\Exceptions;


use Exception;
use Illuminate\Support\MessageBag;
use Islami\Shared\HttpCode;

class DomainException extends Exception
{

    protected $httpCode;
    protected $success = false;
    protected $errors;
    protected $headers;
    protected $data;

    public function __construct(
        $httpCode = HttpCode::HTTP_BAD_REQUEST,
        $message = "Bad Request",
        MessageBag $errors = null,
        $data = null,
        Exception $previous = null,
        array $headers = [],
        $code = 0)
    {

        parent::__construct($message, $code, $previous);
        $this->httpCode = $httpCode;
        $this->message = $message;
        $this->errors = $errors;
        $this->headers = $headers;
        $this->data = $data;

    }

    /**
     * @return mixed
     */
    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    /**
     * @return array
     */
    public function getErrors(): ?MessageBag
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getData()
    {
        return $this->data;
    }


}
