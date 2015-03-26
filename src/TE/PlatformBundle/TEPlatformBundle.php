<?php

namespace TE\PlatformBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TEPlatformBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
