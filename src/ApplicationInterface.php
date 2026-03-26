<?php

namespace framework\contracts;

interface ApplicationInterface
{
    public function run($method);

    /**
     * Register a component in the container
     */
    public function registerComponent(string $name, ComponentInterface $component): void;

    public function registerExtension(string $name, ExtensionInterface $extension): void;
}