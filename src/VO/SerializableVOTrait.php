<?php

namespace Myracloud\CdnClient\VO;

trait SerializableVOTrait
{
    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}