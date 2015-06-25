<?php

namespace Myracloud\CdnClient\VO;

class LinkVO implements \JsonSerializable
{
    use SerializableVOTrait;

    /**
     * @var string
     */
    protected $bucket;

    /**
     * @var string
     */
    protected $subDomainName;

    /**
     * @param BucketVO|string $bucket
     * @param string $subDomainName
     */
    public function __construct($bucket, $subDomainName)
    {
        $this->bucket = (string)$bucket;
        $this->subDomainName = $subDomainName;
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
    public function getSubDomainName()
    {
        return $this->subDomainName;
    }

    /**
     * @param string $subDomainName
     */
    public function setSubDomainName($subDomainName)
    {
        $this->subDomainName = $subDomainName;
    }

}