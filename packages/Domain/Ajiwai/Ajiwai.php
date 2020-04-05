<?php

namespace Ajiwai\Domain\Ajiwai;

class Ajiwai
{
    /** @var AjiwaiId */
    private $ajiwaiId;

    /** @var BrandName */
    private $brandName;

    private $image;

    /** @var Comment */
    private $comment;

    public function __construct(AjiwaiId $ajiwaiId=null,BrandName $brandName, $image, Comment $comment)
    {
        $this->ajiwaiId = $ajiwaiId;
        $this->brandName = $brandName;
        $this->image = $image;
        $this->comment = $comment;
    }

    public function setId(AjiwaiId $ajiwaiId)
    {
        return new Ajiwai($ajiwaiId,$this->brandName,$this->image,$this->comment);
    }

    public function hasId()
    {
        return $this->ajiwaiId != null;
    }
}
