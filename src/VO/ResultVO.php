<?php

namespace Myracloud\CdnClient\VO;

class ResultVO
{
    /**
     * @var string
     */
    protected $status = '';

    /**
     * @var int
     */
    protected $statusCode = 0;

    /**
     * @var bool
     */
    protected $error = false;

    /**
     * @var string
     */
    protected $errorMessage = '';

    /**
     * @var array
     */
    protected $result = [];

    /**
     * ResultVO constructor.
     * @param string $status
     * @param int $statusCode
     * @param bool $error
     * @param string $errorMessage
     * @param mixed $result
     */
    public function __construct(
        $status = '',
        $statusCode = 0,
        $error = false,
        $errorMessage = '',
        $result = null
    ) {
        $this->status = $status;
        $this->statusCode = $statusCode;
        $this->error = $error;
        $this->errorMessage = $errorMessage;
        $this->result = $result;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return boolean
     */
    public function hasError()
    {
        return $this->error;
    }

    /**
     * @param boolean $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }
}