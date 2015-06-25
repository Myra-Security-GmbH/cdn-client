<?php

namespace Myracloud\CdnClient\Exception;

use Exception;

/**
 * Class AccessDeniedException
 * @package Myracloud\CdnClient\Exception
 */
class AccessDeniedException extends \RuntimeException {

    /**
     * {@inheritdoc}
     */
    public function __construct($message = "Access Denied", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}