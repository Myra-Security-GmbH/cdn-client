<?php

namespace Myracloud\CdnClient\VO;

class ListingResponseVO
{
    /**
     * @var bool
     */
    protected $error = false;

    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * @var ListingItemVO[]
     */
    protected $result = [];

    /**
     * @var int
     */
    protected $count = 0;

    /**
     * @var string
     */
    protected $cursorNext;

    /**
     * @var string
     */
    protected $cursorPrev;

    /**
     * ListingResponseVO constructor.
     * @param bool $error
     * @param string $errorMessage
     * @param ListingItemVO[] $result
     * @param int $count
     * @param string $cursorNext
     * @param string $cursorPrev
     */
    public function __construct(array $result = [], $count = 0, $error = false, $errorMessage = '', $cursorNext = '', $cursorPrev = '')
    {
        $this->error = $error;
        $this->errorMessage = $errorMessage;
        $this->result = $result;
        $this->count = $count;
        $this->cursorNext = $cursorNext;
        $this->cursorPrev = $cursorPrev;
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
     * @return ListingItemVO[]
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param ListingItemVO[] $result
     */
    public function setResult(array $result)
    {
        $this->result = $result;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return string
     */
    public function getCursorNext()
    {
        return $this->cursorNext;
    }

    /**
     * @param string $cursorNext
     */
    public function setCursorNext($cursorNext)
    {
        $this->cursorNext = $cursorNext;
    }

    /**
     * @return string
     */
    public function getCursorPrev()
    {
        return $this->cursorPrev;
    }

    /**
     * @param string $cursorPrev
     */
    public function setCursorPrev($cursorPrev)
    {
        $this->cursorPrev = $cursorPrev;
    }
}
