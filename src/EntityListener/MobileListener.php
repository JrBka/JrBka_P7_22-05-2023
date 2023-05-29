<?php

namespace App\EntityListener;

use App\Entity\Mobile;

class MobileListener
{
    public function preUpdate(Mobile $mobile) : Mobile
    {
        return $mobile->setUpdatedAt(new \DateTimeImmutable());
    }
}