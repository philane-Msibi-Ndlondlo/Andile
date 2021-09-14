<?php

namespace Andile\Domain\Core;

/**
 * Class that handles Response
 */

class Response {

    public $payload = [];

    public function __construct() {

    }

    /**
     * @method void render()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that displays the filename that matches the request's URI
     */

    public function render(string $filename, $data = []) {

        $file = ROOT_DIR."src/Views/{$filename}.html";

        if (!file_exists($file)) {

            die("File doesnt not exist");

        }

        $file_content = file_get_contents($file);

        $partials = [];

        if (preg_match_all("/\[ include [a-zA-Z]+ \]/i", $file_content, $partial_matches)) {
            
            foreach ($partial_matches[0] as $match) {
                
                $text = str_replace('[', '' , trim($match));
                $text = str_replace('include ', '' , trim($text));
                $partials[] = str_replace(']', '' , trim($text));
            }
        }

        $template = new Template($file, $data);
        
        foreach ($partials as $partial) {
            $template->set_tmp_partial($partial);
        }

        $template->show_resolved_template();

    }

}