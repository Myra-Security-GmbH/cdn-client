<?php

namespace Myracloud\CdnClient\Manager;

use GuzzleHttp\RequestOptions;
use Myracloud\CdnClient\Exception\BucketWaitTimeoutException;
use Myracloud\CdnClient\VO\BucketDeleteQueryVO;
use Myracloud\CdnClient\VO\BucketStatsVO;
use Myracloud\CdnClient\VO\BucketVO;
use Myracloud\CdnClient\VO\LinkVO;
use Myracloud\CdnClient\VO\ResultVO;

/**
 * Class BucketManager
 * @package Myracloud\CdnClient\Manager
 */
class BucketManager extends AbstractManager
{
    const STATUS_AVAILABLE = 0;
    const STATUS_DELETED = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_UNKNOWN = 4;

    /**
     * @param $domain
     * @return BucketVO
     */
    public function create($domain)
    {
        $result = $this->request('PUT', "bucket/create/$domain")->getResult();

        return new BucketVO(
            $result['bucket'],
            $result['linkedDomains']
        );
    }

    /**
     * @param string $domain
     * @param BucketVO|string $bucket
     * @return ResultVO
     * @throws BucketWaitTimeoutException
     */
    public function wait($domain, $bucket)
    {
        $result = null;

        for ($i = 0; $i < 10; $i++) {
            $result = $this->status($domain, $bucket);

            if (!$result->hasError() && $result->getStatusCode() === static::STATUS_AVAILABLE) {
                return $result;
            }

            sleep(2);
        }

        throw new BucketWaitTimeoutException(
            $result->getStatus() ?: "Bucket $bucket is not available",
            $result->getStatusCode()
        );
    }

    /**
     * @param string $domain
     * @param BucketVO|string $bucket
     * @return ResultVO
     */
    public function status($domain, $bucket)
    {
        return $this->request('GET', "bucket/status/$domain/$bucket");
    }

    /**
     * @param string $domain
     * @param BucketVO|string $bucket
     * @return BucketStatsVO
     */
    public function statistics($domain, $bucket)
    {
        $response = $this->request('GET', "bucket/statistics/$domain/$bucket")->getResult();

        return new BucketStatsVO(
            $response['files'],
            $response['folders'],
            $response['storageSize'],
            $response['contentSize']
        );

    }

    /**
     * @param $domain
     * @return ResultVO
     */
    public function all($domain)
    {
        $response = $this->request('GET', "bucket/list/$domain");
        $buckets = [];

        foreach ($response->getResult() as $bucket) {
            $buckets[] = new BucketVO(
                $bucket['bucket'],
                $bucket['linkedDomains']
            );
        }

        $response->setResult($buckets);

        return $response;
    }

    /**
     * @param $domain
     * @param LinkVO $link
     * @return ResultVO
     */
    public function link($domain, LinkVO $link)
    {
        return $this->request(
            'PUT',
            "bucket/link/$domain",
            [
                RequestOptions::JSON => $link,
            ]
        );
    }

    /**
     * @param $domain
     * @param LinkVO $link
     * @return ResultVO
     */
    public function unlink($domain, LinkVO $link)
    {

        return $this->request(
            'DELETE',
            "bucket/link/$domain",
            [
                RequestOptions::JSON => $link,
            ]
        );
    }

    /**
     * @param $domain
     * @param BucketDeleteQueryVO $delete
     * @return ResultVO
     */
    public function delete($domain, BucketDeleteQueryVO $delete)
    {
        return $this->request(
            'DELETE',
            "bucket/delete/$domain",
            [
                RequestOptions::JSON => $delete,
            ]
        );
    }
}
