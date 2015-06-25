<?php

namespace Myracloud\CdnClient\VO;

class FileDeleteQueryVO implements \JsonSerializable
{
    use SerializableVOTrait;

    /**
     * @var string
     */
    protected $bucket;

    /**
     * @var string
     */
    protected $path;

    /**
     * @param string|BucketVO $bucket
     * @param string $path
     */
    function __construct($bucket, $path)
    {
        $this->bucket = (string)$bucket;
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getBucket()
    {
        return $this->bucket;
    }

    /**
     * @param string $bucket
     */
    public function setBucket($bucket)
    {
        $this->bucket = $bucket;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }
}