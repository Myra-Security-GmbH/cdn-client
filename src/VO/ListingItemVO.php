<?php

namespace Myracloud\CdnClient\VO;

class ListingItemVO
{
    const TYPE_FILE = 0;
    const TYPE_DIRECTORY = 1;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $basename;

    /**
     * @var int
     */
    protected $size;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var \DateTime
     */
    protected $modified;

    /**
     * @var string
     */
    protected $contentType;

    /**
     * ListingItemVO constructor.
     *
     * @param int $type
     * @param string $path
     * @param string $basename
     * @param int $size
     * @param string $hash
     * @param \DateTime $modified
     * @param string $contentType
     */
    public function __construct($type, $path, $basename, $size, $hash, \DateTime $modified, $contentType)
    {
        $this->type        = $type;
        $this->path        = $path;
        $this->basename    = $basename;
        $this->size        = $size;
        $this->hash        = $hash;
        $this->modified    = $modified;
        $this->contentType = $contentType;
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
     * @return string
     */
    public function getBasename()
    {
        return $this->basename;
    }

    /**
     * @param string $basename
     */
    public function setBasename($basename)
    {
        $this->basename = $basename;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param \DateTime $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }
}
