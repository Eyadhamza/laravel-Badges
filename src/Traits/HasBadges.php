<?php

namespace Eyadh\MyFirstPackage\Traits;

use Eyadh\MyFirstPackage\Models\Badge;

trait HasBadges
{
    public function badges()
    {
        return $this->morphToMany(Badge::class,'model','badgeables');
    }

}
