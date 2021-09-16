<?php

namespace Andile\Domain\Core;

use Andile\Domain\Core\Template;
use Andile\Utils\Template as UtilTemplate;

/**
 * Class that handles Response
 */

class Response {

    public $payload = [];

    public function __construct() {

    }

    /**
     * @method void render()
     * @param string $filename, $data = []
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that displays the filename that matches the request's URI
     * - Check if the file requested exists
     * - Get the file contents
     * - Check if main layout file exists
     * - If it exists, replace [[ content ]] witht he file's contents
     * - Get all partials included in the file's content
     * - Create a Template Instance
     * - Set partials to the template
     * - Resolve the requested file to the user 
     */

    public function render(string $filename, $data = []) {

        $file = ROOT_DIR."src/Views/{$filename}.html";

        if (!file_exists($file)) die("File doesnt not exist");

        $file_content = file_get_contents($file);

        if (UtilTemplate::is_main_layout_exist()) $file_content = UtilTemplate::resolve_layout_partials($file_content);

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