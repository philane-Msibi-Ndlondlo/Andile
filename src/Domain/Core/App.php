<?php

namespace Andile\Domain\Core;

/**
 * Class that is the entry point of the app.
 * It registers all routes
 * And Runs the app
 */

class App {

    public $router;

    public function __construct() {}

    /**
     * @method void register()
     * @param $router
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that adds all request types
     */
    public function register(Router $router) {

        $this->router = $router;

    }

}