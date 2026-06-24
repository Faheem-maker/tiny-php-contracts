<?php

namespace framework\contracts\routing;

use framework\contracts\ApplicationInterface;
use framework\contracts\routing\RouterInterface;

class Route
{
    protected $middlewares = []; // Renamed to plural for clarity

    public function __construct(
        public mixed $action,
        public string $fullPath,
        public string|null $name,
        public RouterInterface $router,
    ) {
    }

    public function middleware(callable|array|string $middleware)
    {
        // Support both single strings and arrays
        if (is_array($middleware)) {
            $this->middlewares = array_merge($this->middlewares, $middleware);
        } else {
            $this->middlewares[] = $middleware;
        }
        return $this; // Return $this for chaining
    }

    public function execute(array $params, ApplicationInterface $app)
    {
        // Define the core action based on the action type
        if (is_callable($this->action)) {
            // Direct callback
            $coreAction = function () use ($params) {
                return \call_user_func($this->action, $params);
            };
        } else {
            // Controller string
            if (\is_string($this->action)) {
                $this->action = explode('@', $this->action);
                $this->action[0] = 'app\\http\\controllers\\' . $this->action[0];
            }

            $controller = $this->action[0];
            $action = $this->action[1];

            // This is the final destination: the actual controller logic
            $coreAction = function () use ($params, $controller, $action, $app) {
                $controller = $app->di->make($controller);
                return $app->di->invoke($controller, $action, $params);
            };
        }

        // If no middleware, just run the core
        if (empty($this->middlewares)) {
            return $coreAction();
        }

        // Wrap the core action in the middleware layers (running in reverse)
        $pipeline = array_reduce(
            array_reverse($this->middlewares),
            function ($next, $middleware) use ($app) {
                return function () use ($next, $middleware, $app) {
                    if ($app->registry->has($middleware)) {
                        $middleware = $app->registry->get($middleware);
                    }
                    // We resolve the middleware class and call its 'handle' method
                    $instance = $app->di->make($middleware);
                    return $app->di->invoke($instance, 'handle', [
                        'next' => $next,
                    ]);
                };
            },
            $coreAction
        );

        return $pipeline();
    }

    public function rename(string $to)
    {
        $this->name($to);
    }

    public function name(string $name)
    {
        if (!empty($this->name)) {
            $this->router->rename($this->name, $name);
        }

        $this->name = $name;
        $this->router->name($this->name, $this);
    }
}