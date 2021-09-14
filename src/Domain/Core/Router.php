<?php

namespace Andile\Domain\Core;

/**
 * Class to handle Routes of the application
 * It has 4 Request types:
 * 1. GET
 * 2. POST
 * 3. PUT
 * 4. DELETE
 */

class Router {

    public $routes;

    public function __construction() {

        $this->routes = null;

    }
    
    /**
     * @method void get()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function registers a path and action to a Request Method on the routes array
     */

    public function get($path, $action) {

        $this->validate_route($path, $action);

        $this->routes['GET'][$path] = $action;

        $this->resolve();

    }

    /**
     * @method void post()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function registers a path and action to a Request Method on the routes array
     */

    public function post($path, $action) {

        $this->validate_route($path, $action);

        $this->routes['POST'][$path] = $action;

    }

    /**
     * @method void post()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function registers a path and action to a Request Method on the routes array
     */

    public function put($path, $action) {

        $this->validate_route($path, $action);

        $this->routes['PUT'][$path] = $action;

    }

    /**
     * @method void post()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function registers a path and action to a Request Method on the routes array
     */

    public function delete($path, $action) {

        $this->validate_route($path, $action);

        $this->routes['DELETE'][$path] = $action;

    }

    /**
     * @method void validate_route()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that validate the path and action prior to registering it to the routes array
     */

    private function validate_route($path, $action) {

        if (count(func_get_args()) !== 2) die("ERROR: path and action callback required for route.");

        if (!isset($action)) die("ERROR: action callback required for route.");

    }

    /**
     * @method void is_route_exist()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that validate the existence of the uri and method on the routes array
     */

    private function is_route_exist(string $uri = null, string $method = null) {

        if ($uri === null || $method === null ) die("ERROR: URI and Method are Required");

        if (!empty($this->routes[$method][$uri]))
            return true;
        else
            return false;

    }

    /**
     * @method void resolve()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that returns the html to the user
     */

    public function resolve() {

        $request = new Request();
        $response = new Response();

        $uri = $request->get_request_uri();
        $request_method = $request->get_request_method();

        if (!$this->is_route_exist($uri, $request_method)) die("ERROR: Route Doesnt not Exist");

        $action = $this->routes[$request_method][$uri];

        if (!empty($action))
            call_user_func($action, $request, $response);
        else
            die("ERROR: No Callable Action for URI");
    }
}