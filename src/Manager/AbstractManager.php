<?php

namespace Myracloud\CdnClient\Manager;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Myracloud\CdnClient\Exception\AccessDeniedException;
use Myracloud\CdnClient\Exception\CdnException;
use Myracloud\CdnClient\Exception\UnexpectedResponseFormatException;
use Myracloud\CdnClient\VO\ResultVO;

abstract class AbstractManager
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $method HTTP method to use
     * @param string $uri Full request URI
     * @param array $options Additional guzzle request options
     * @param bool $map If true the plain JSON response will be mapped to a ResultVO object
     * @param bool $decode True to handle default json response
     * @throws UnexpectedResponseFormatException
     * @throws AccessDeniedException
     * @throws CdnException
     * @return ResultVO|array
     */
    protected function request($method, $uri, array $options = [], $map = true, $decode = true)
    {
        $options  = $this->addDateToHeaders($options);

        $response = $this->client->request(
            $method,
            $uri,
            $options
        );

        if ($response->getStatusCode() === 403) {
            throw new AccessDeniedException((string)$response->getBody());
        }

        if (!$decode) {
            return $response->getBody();
        }

        $content = @json_decode($response->getBody(), true);

        if ($content === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new UnexpectedResponseFormatException('Unable to decode response');
        }

        if (isset($content['error']) && $content['error'] === true) {
            throw new CdnException(isset($content['errorMessage']) ? $content['errorMessage'] : '');
        }

        if (!$map) {
            return $content;
        }

        return new ResultVO(
            isset($content['status']) ? $content['status'] : '',
            isset($content['statusCode']) ? $content['statusCode'] : 0,
            $content['error'],
            isset($content['errorMessage']) ? $content['errorMessage'] : '',
            isset($content['result']) ? $content['result'] : null
        );
    }

    /**
     * @param array $options
     * @return array
     */
    private function addDateToHeaders(array $options): array
    {
        if (!array_key_exists(RequestOptions::HEADERS, $options)) {
            $options[RequestOptions::HEADERS] = [];
        }

        $options[RequestOptions::HEADERS]['Date'] = date('c');

        return $options;
    }
}
