<?php

namespace Myracloud\CdnClient\Authentication;

/**
 * Class Signature
 * @package Myracloud\CdnClient\Authentication
 */
class Signature
{
    /**
     * @var array|null
     */
    private $headers;

    /**
     * @var null|string
     */
    private $content;

    /**
     * @var null|string
     */
    private $uri;

    /**
     * @var null|string
     */
    private $secret;

    /**
     * @var string
     */
    private $method;

    /**
     * @param string $method
     * @param null|string $uri
     * @param null|string $secret
     * @param array|null $headers
     * @param null|string $content
     */
    public function __construct(
        $method,
        $uri = null,
        $secret = null,
        array $headers = null,
        $content = null
    ) {
        $this->content = $content;
        $this->uri = $uri;
        $this->secret = $secret;
        $this->method = $method;
        $this->headers = $headers;
    }

    /**
     * Returns always the last set header data.
     *
     * @param string $data Headername to look for.
     * @param mixed $default Default is returned when header is not set.
     * @return mixed
     */
    private function getHeaderData($data, $default = '')
    {
        if (!isset($this->headers[$data])) {
            return $default;
        }

        if (is_array($this->headers[$data])) {
            if (isset($this->headers[$data][0])) {
                return $this->headers[$data][0];
            }

            return $default;
        }

        return $this->headers[$data];
    }

    /**
     * Return unsigned string representation of the signature data
     *
     * @return string
     */
    public function getStringToSign()
    {
        return md5((string)$this->content)
        .'#'.$this->method
        .'#'.$this->uri
        .'#'.$this->getHeaderData('Content-Type')
        .'#'.$this->getHeaderData('Date');
    }

    /**
     * Return signature as string
     *
     * @return string
     */
    public function __toString()
    {
        $signingString = $this->getStringToSign();

        $key = hash_hmac('sha256', $this->getHeaderData('Date'), 'MYRA'.$this->secret);
        $key = hash_hmac('sha256', 'myra-api-request', $key);

        return base64_encode(hash_hmac('sha512', $signingString, $key, true));
    }
}