<?php

namespace Andile\Domain\Core;

/**
 * Class that handles Requests
 */

class URI {

    public function __construct() {

    }

    public static function get() {

        if (isset($_SERVER)) {

            $uri = $_SERVER['REQUEST_URI'];

            $uri = substr($uri, 7);

            return $uri;
        }

    }

}