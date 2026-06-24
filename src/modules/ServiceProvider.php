<?php

namespace framework\contracts\modules;

use framework\contracts\ApplicationInterface;

abstract class ServiceProvider {
    public abstract function install();

    public abstract function boot(ApplicationInterface $app);
}