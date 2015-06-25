<?php

namespace Myracloud\CdnClient\VO;

class BucketVO
{
    /**
     * @var string
     */
    protected $bucket = '';

    /**
     * @var string[]
     */
    protected $linkedDomains = [];

    /**
     * @param string $bucket
     * @param string[] $linkedDomains
     */
    public function __construct($bucket = '', array $linkedDomains = [])
    {
        $this->bucket = $bucket;
        $this->linkedDomains = $linkedDomains;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->bucket;
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
     * @return string[]
     */
    public function getLinkedDomains()
    {
        return $this->linkedDomains;
    }

    /**
     * @param string[] $linkedDomains
     */
    public function setLinkedDomains(array $linkedDomains)
    {
        $this->linkedDomains = $linkedDomains;
    }
}