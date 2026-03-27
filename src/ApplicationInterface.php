<?php

namespace framework\contracts;

interface ApplicationInterface
{
    public function run();

    /**
     * Register a component in the container
     */
    public function registerComponent(string $name, $component): void;

    public function registerExtension(string $name, ExtensionInterface $extension): void;
}