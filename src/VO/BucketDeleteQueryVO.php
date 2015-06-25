<?php

namespace Myracloud\CdnClient\VO;

class BucketDeleteQueryVO implements \JsonSerializable
{
    use SerializableVOTrait;

    /**
     * @var string
     */
    protected $bucket;

    /**
     * @param BucketVO|string $bucket
     */
    function __construct($bucket)
    {
        $this->bucket = (string)$bucket;
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
}