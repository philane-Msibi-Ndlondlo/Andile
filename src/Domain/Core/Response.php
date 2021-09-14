<?php

namespace Andile\Domain\Core;

/**
 * Class that handles Response
 */

class Response {

    public $payload = [];

    public function __construction() {

    }

    /**
     * @method void render()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that displays the filename that matches the request's URI
     */

    public function render(string $filename) {

        $file = ROOT_DIR."src/Views/{$filename}.html";

        if (!file_exists($file)) {

            die("File doesnt not exist");

        }

        include $file;

    }

}