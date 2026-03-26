<?php

namespace framework\contracts;

interface ExtensionInterface extends ComponentInterface
{
    public function bootstrap(ApplicationInterface $app): void;
}