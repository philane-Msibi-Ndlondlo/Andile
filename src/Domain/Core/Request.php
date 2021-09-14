<?php

namespace Andile\Domain\Core;

/**
 * Class that handles Requests
 */

class Request {

    public $payload = [];

    public function __construction() {

        $this->set_request_uri();
        $this->set_request_method();
    }

    /**
     * @method void set_request_uri()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that sets the current Request's URI to the payload
     */

    private function set_request_uri() {

        if (isset($_SERVER)) {

            $uri = $_SERVER['REQUEST_URI'];

            $uri = substr($uri, 7);

            $this->payload['URI'] = $uri;
        }
    }

    /**
     * @method void set_request_method()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that sets the current Request's method to the payload
     */

    private function set_request_method() {

        if (isset($_SERVER)) {

            $type = $_SERVER['REQUEST_METHOD'];

            switch ($type) {
                case 'GET':
                    $this->payload['METHOD'] = $type;
                    break;
                
                default:
                    die("No Request Type");
                    break;
            }
        }
    }

    /**
     * @method void get_request_method()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that gets the current Request's method from the payload
     */

    public function get_request_method() {
        if (empty($this->payload['METHOD'])) {
            $this->set_request_method();
        }

        return $this->payload['METHOD'];
    }   

    /**
     * @method void get_request_uri()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that gets the current Request's URI from the payload
     */

    public function get_request_uri() {
        if (empty($this->payload['URI'])) {
            $this->set_request_uri();
        }

        return $this->payload['URI'];

    }

}