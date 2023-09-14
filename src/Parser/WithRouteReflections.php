<?php

namespace Jimanx2\LumenSwaggerGenerator\Parser;

use Illuminate\Routing\Route;

/**
 * Trait WithRouteReflections
 */
trait WithRouteReflections
{
    use WithReflections;

    /**
     * Get route method reflection
     *
     * @param  Route $route
     * @return \ReflectionMethod|\ReflectionFunction
     */
    protected function routeReflection(Route $route): \ReflectionMethod|\ReflectionFunction
    {
        if ($route->getActionMethod() === 'Closure') {
            if (is_callable($closure = $route->getAction('uses'))) {
                return $this->reflectionClosure($closure);
            } else {
                list($controller, $method) = explode("@", $closure);
            }
        } else {
            $controller = $route->getControllerClass();
            $method = $route->getActionMethod();
        }

        return $this->reflectionMethod($controller, $method);
    }
}
