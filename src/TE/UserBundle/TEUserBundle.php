<?php

namespace TE\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TEUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
