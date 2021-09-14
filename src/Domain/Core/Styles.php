<?php

namespace Andile\Domain\Core;

use Andile\Domain\Core;

/**
 * Class that is the entry point of the app.
 * It registers all routes
 * And Runs the app
 */

class Styles {

    private function __construct() {}

    /**
     * @method void set_style()
     * @param $css_file
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return string
     * Desc: Function that adds a link tag of the specified css file
     */
    public static function set_style($css_file = "") {

        $css_path = ROOT_STYLE_PATH;

        if (empty($css_file)) {

            $css_path .= "index.css";
            
            return "<link rel='stylesheet href='{$css_path}'>";
        }

        if (!file_exists($css_file)) {

            $css_path = ROOT_STYLE_PATH.$css_file;

            return "<link rel='stylesheet href='{$css_path}'>";
        }

    }

}