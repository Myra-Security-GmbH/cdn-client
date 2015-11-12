<?php

/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 11/12/15
 * Time: 2:20 PM
 */

namespace Myracloud\CdnClient\VO;

/**
 * Class LinkBulkVO
 *
 * @package Myracloud\CdnClient\VO
 */
class LinkBulkVO implements \JsonSerializable
{
    use SerializableVOTrait;

    private $operations = [];

    /**
     * @return array
     */
    public function getOperations()
    {
        return $this->operations;
    }

    /**
     * @param LinkVO $link
     */
    public function addOperation(LinkVO $link)
    {
        $this->operations[] = $link;
    }

    /**
     * @param LinkVO $link
     * @return bool
     */
    public function removeOperation(LinkVO $link)
    {
        $i = array_search($link, $this->operations);

        if($i === false) {
            return false;
        }

        unset($this->operations[$i]);
        sort($this->operations);
        return true;
    }
}