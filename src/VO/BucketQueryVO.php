<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 11/13/15
 * Time: 3:13 PM
 */

namespace Myracloud\CdnClient\VO;

/**
 * Class BucketQueryVO
 *
 * @package Myracloud\CdnClient\VO
 */
class BucketQueryVO implements \JsonSerializable
{
    use SerializableVOTrait;

    /**
     * @var string
     */
    private $name = '';

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param BucketVO|string $bucket
     */
    function __construct($bucket)
    {
        $this->name = (string)$bucket;
    }
}