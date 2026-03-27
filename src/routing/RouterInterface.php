<?php

namespace framework\contracts\routing;

interface RouterInterface
{
    // Handle Grouping
    public function group($prefix, $callback);

    public function route($route, $action, $method, $name = null);

    public function get($route, $action, $name = null);

    public function post($route, $action, $name = null);

    public function patch($route, $action, $name = null);

    public function put($route, $action, $name = null);

    public function delete($route, $action, $name = null);

    public function resolve($uri, $method);

    public function resolveName($name, $params = []);

    public function rename($from, $to);

    public function mount(string $prefix, RouterInterface $router);

    public function routes(): array;
    public function namedRoutes(): array;
}