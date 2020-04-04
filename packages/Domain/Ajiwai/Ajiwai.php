<?php

namespace Ajiwai\Domain\Ajiwai;

class Ajiwai
{

    /** @var BrandName */
    private $brandName;

    private $image;

    /** @var Comment */
    private $comment;

    public function __construct(BrandName $brandName, $image, Comment $comment)
    {
        $this->brandName = $brandName;
        $this->image = $image;
        $this->comment = $comment;
    }
}
