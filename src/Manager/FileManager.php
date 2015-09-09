<?php

namespace Myracloud\CdnClient\Manager;

use GuzzleHttp\RequestOptions;
use Myracloud\CdnClient\VO\BucketVO;
use Myracloud\CdnClient\VO\FileDeleteQueryVO;
use Myracloud\CdnClient\VO\ListingItemVO;
use Myracloud\CdnClient\VO\ListingQueryVO;
use Myracloud\CdnClient\VO\ListingResponseVO;
use Myracloud\CdnClient\VO\ResultVO;
use Psr\Http\Message\StreamInterface;

/**
 * Class FileManager
 *
 * @package Myracloud\CdnClient\Manager
 */
class FileManager extends AbstractManager
{
    /**
     * @param string $domain
     * @param BucketVO|string $bucket
     * @param string $path
     * @param StreamInterface|resource|string $content
     * @param bool $unzip
     * @return ResultVO
     */
    public function create($domain, $bucket, $path, $content, $unzip = false)
    {
        return $this->request('PUT', "upload/$domain/$bucket/" . ltrim($path, '/'), [
            RequestOptions::BODY    => $content,
            RequestOptions::HEADERS => [
                'X-Myra-Unzip' => (int)$unzip,
            ],
        ]);
    }

    /**
     * @param $domain
     * @param ListingQueryVO $listing
     * @return ListingResponseVO
     */
    public function all($domain, ListingQueryVO $listing)
    {
        $response = $this->request('POST', "list/$domain", [
            RequestOptions::JSON => $listing,
        ], false);

        $files = [];

        foreach ($response['result'] as $file) {
            $files[] = new ListingItemVO(
                $file['type'],
                $file['path'],
                $file['basename'],
                $file['size'],
                $file['hash'],
                new \DateTime($file['modified']),
                $file['contentType']
            );
        }

        return new ListingResponseVO(
            $files,
            $response['count'],
            $response['error'],
            isset($response['errorMessage']) ? $response['errorMessage'] : '',
            isset($response['cursorNext']) ? $response['cursorNext'] : '',
            isset($response['cursorPrev']) ? $response['cursorPrev'] : ''
        );
    }

    /**
     * @param $domain
     * @param FileDeleteQueryVO $delete
     * @return ResultVO
     */
    public function delete($domain, FileDeleteQueryVO $delete)
    {
        return $this->request('DELETE', "delete/$domain", [
            RequestOptions::JSON => $delete,
        ]);
    }
}
