<?php

namespace Myracloud\CdnClient\VO;

class BucketStatsVO
{
    /**
     * @var int
     */
    protected $files = 0;

    /**
     * @var int
     */
    protected $folders = 0;

    /**
     * @var int
     */
    protected $storageSize = 0;

    /**
     * @var int
     */
    protected $contentSize = 0;

    /**
     * BucketStatsVO constructor.
     * @param int $files
     * @param int $folders
     * @param int $storageSize
     * @param int $contentSize
     */
    public function __construct($files = 0, $folders = 0, $storageSize = 0, $contentSize = 0)
    {
        $this->files = $files;
        $this->folders = $folders;
        $this->storageSize = $storageSize;
        $this->contentSize = $contentSize;
    }

    /**
     * @return int
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param int $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }

    /**
     * @return int
     */
    public function getFolders()
    {
        return $this->folders;
    }

    /**
     * @param int $folders
     */
    public function setFolders($folders)
    {
        $this->folders = $folders;
    }

    /**
     * @return int
     */
    public function getStorageSize()
    {
        return $this->storageSize;
    }

    /**
     * @param int $storageSize
     */
    public function setStorageSize($storageSize)
    {
        $this->storageSize = $storageSize;
    }

    /**
     * @return int
     */
    public function getContentSize()
    {
        return $this->contentSize;
    }

    /**
     * @param int $contentSize
     */
    public function setContentSize($contentSize)
    {
        $this->contentSize = $contentSize;
    }
}