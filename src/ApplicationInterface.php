<?php

namespace framework\contracts;

interface ApplicationInterface
{
    public function run();

    /**
     * Register a component in the container
     */
    public function registerComponent(string $name, $component): void;

    /**
     * Attempts to automatically scan and install all modules
     * available within the current scope
     * @return void
     */
    public function scanModules();

    /**
     * These methods provide boilerplates for registration of routes, controllers and views
     */

    /**
     * Registers all routes within the specified folder
     * 
     * The specified folder must contain a "routes.php" file that exports a single `$router` variable.
     * The variable will be mounted on the app.
     * @param string $dir The path to the folder
     * @return void
     */
    public function registerRoutes(string $dir): void;

    /**
     * Registers "resources" directory for the provider
     * 
     * @param string $namespace Can be empty, to signify global namespace
     * @param string $dir The path to the resources folder
     * @return void
     */
    public function registerResources(string $namespace, string $dir): void;
    
    public function registerMigrations(string $namespace, string $dir): void;
}