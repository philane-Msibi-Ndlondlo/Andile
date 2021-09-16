<?php

namespace Andile\Domain\Controllers;

/**
 * Base Controller that include all CRUD operations.
 */
class Controller {

    public function __construct() {}

    /**
     * @method void register()
     * @param $router
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that adds all request types
     */
    public function create() {

        print_r($_POST);

    }

}