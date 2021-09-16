<?php

namespace Andile\Utils;

/**
 * Class that has utility functions used on the app
 * You can define custom util functions here
 */

class Template {

    private function __construct() {}

    /**
     * @method void resolve_layout_partials()
     * @param $template_content
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that gets the main layout file and adds the content to it
     */
    public static function resolve_layout_partials(string $template_content = null) {

        if (file_exists(ROOT_LAYOUT_PATH)) {

            $layout_file_content = file_get_contents(ROOT_LAYOUT_PATH);
        
            return str_replace("[[ content ]]", $template_content, $layout_file_content);

        }

    }

    public static function is_main_layout_exist() {
        return file_exists(ROOT_LAYOUT_PATH);
    }

}