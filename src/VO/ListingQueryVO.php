<?php

namespace Myracloud\CdnClient\VO;

class ListingQueryVO implements \JsonSerializable
{
    use SerializableVOTrait;

    const TYPE_FILES = 0;
    const TYPE_DIRECTORIES = 1;

    /**
     * @var string
     */
    protected $bucket;

    /**
     * @var string
     */
    protected $cursor;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var int
     */
    protected $limit ;

    /**
     * @var int
     */
    protected $type;

    /**
     * ListingQueryVO constructor.
     * @param BucketVO|string $bucket
     * @param int $type
     * @param string $path
     * @param int $limit
     * @param string $cursor
     */
    public function __construct($bucket, $type = self::TYPE_FILES, $path = '/', $limit = 100, $cursor = null)
    {
        $this->bucket = (string)$bucket;
        $this->type = $type;
        $this->path = $path;
        $this->limit = $limit;
        $this->cursor = $cursor;
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
    public function getCursor()
    {
        return $this->cursor;
    }

    /**
     * @param string $cursor
     */
    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
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

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
