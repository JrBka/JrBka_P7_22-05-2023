<?php

namespace App\EntityListener;

use App\Entity\Mobile;

class MobileListener
{
    /**
     * This function applies a dateTime before the entity update
     */
    public function preUpdate(Mobile $mobile) : Mobile
    {
        return $mobile->setUpdatedAt(new \DateTimeImmutable());
    }
}
