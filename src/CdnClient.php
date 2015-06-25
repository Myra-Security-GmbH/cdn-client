<?php

namespace Myracloud\CdnClient;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\PrepareBodyMiddleware;
use Myracloud\CdnClient\Manager\BucketManager;
use Myracloud\CdnClient\Manager\FileManager;
use Psr\Http\Message\RequestInterface;

class CdnClient
{
    /**
     * @var string
     */
    protected $apiKey = '';

    /**
     * @var string
     */
    protected $secret = '';

    /**
     * @var string
     */
    protected $url = '';

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var BucketManager
     */
    protected $bucketManager;

    /**
     * @var FileManager
     */
    protected $fileManager;

    /**
     * @param string $apiKey
     * @param string $secret
     * @param string $url
     * @param ClientInterface|null $client
     * @param BucketManager $bucketManager
     * @param FileManager $fileManager
     */
    public function __construct(
        $apiKey,
        $secret,
        $url = 'https://myracloud-upload.local/v2/',
        ClientInterface $client = null,
        BucketManager $bucketManager = null,
        FileManager $fileManager = null
    ) {
        $this->apiKey = $apiKey;
        $this->secret = $secret;
        $this->url = $url;

        if ($client === null) {
            $stack = new HandlerStack();
            $stack->setHandler(new CurlHandler());
            $stack->push(Middleware::prepareBody());
            $stack->push(
                Middleware::mapRequest(
                    function (RequestInterface $request) use ($secret, $apiKey) {
                        return $request->withHeader(
                            'Authorization',
                            "MYRA ${apiKey}:".(
                            new Authentication\Signature(
                                $request->getMethod(),
                                $request->getRequestTarget(),
                                $secret,
                                $request->getHeaders(),
                                $request->getBody()
                            )
                            )
                        );
                    }
                )
            );

            $client = new Client(
                [
                    'base_uri' => $this->url,
                    'handler' => $stack,
                ]
            );
        }

        $this->client = $client;

        $this->bucketManager = $bucketManager ?: new BucketManager(
            $this->client
        );

        $this->fileManager = $fileManager ?: new FileManager(
            $this->client
        );
    }

    /**
     * @return BucketManager
     */
    public function getBucketManager()
    {
        return $this->bucketManager;
    }

    /**
     * @param BucketManager $bucketManager
     */
    public function setBucketManager($bucketManager)
    {
        $this->bucketManager = $bucketManager;
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param ClientInterface $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return FileManager
     */
    public function getFileManager()
    {
        return $this->fileManager;
    }

    /**
     * @param FileManager $fileManager
     */
    public function setFileManager($fileManager)
    {
        $this->fileManager = $fileManager;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}
