<?php

namespace Andile\Domain\Core;

use Andile\Utils\Template as UtilsTemplate;

/**
 * Class that handles the templating of page.
 * It takes in a file requested and load data set by the user
 */

class Template {

    private $template_file;
    private $template_content;
    private $layout_file_content;
    private $data;
    private $partials = [];

    public function __construct($file = '', $data = []) {

        if (empty($file) || $file === null) {
            die("No File Passed");
        }

        $this->template_file = $file;
        $this->data = $data;

    }

    /**
     * @method void set_tmp_partial()
     * @param $partial
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that sets partial file to the main file requested
     */
    public function set_tmp_partial($partial) {

        $this->partials[] = $partial;

    }

    /**
     * @method void show_resolved_template()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that embeds partials
     * - Check if partials were added during Template instantiation
     * - Check if partial files exist
     * - If so, check if partial file has data templates inside
     * - if so, replace templates with actual data passed on the $data array
     */
     private function resolve_partials() {

        if (count($this->partials) === 0) return;

        foreach ($this->partials as $partial) {
            $partial = trim($partial);
            $partial_file = PARTIALS_PATH.$partial.FILE_EXTENSION;

            if (!file_exists($partial_file)) continue;

            $partial_file_content = file_get_contents($partial_file);

            if (isset($this->data[$partial]) && count($this->data[$partial]) > 0) {

                foreach ($this->data[$partial] as $key => $partial_value) {
                    $partial_file_content = str_replace("{{ ".$key." }}", $partial_value, $partial_file_content);
                }
            } 

            $this->template_content = str_replace("[ include ".$partial." ]", $partial_file_content, $this->template_content);
        }

     }

     /**
     * @method void resolve_styles_partials()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that embeds styles partials
     * - Check for css_styles templates on the file content
     * - Replaces and trim the matches
     * - create an html tag with the css styles file
     * - add the link tag to the files content
     */
    private function resolve_styles_partials() {
        
        if (preg_match_all("/\[ css_styles [a-zA-Z]+ \]/i", $this->template_content, $styles_matches)) {
            
            foreach ($styles_matches[0] as $match) {
                
                $text = str_replace('[', '' , trim($match));
                $text = str_replace('css_styles ', '' , trim($text));
                $styles_partial = trim(str_replace(']', '' , trim($text)));
            
                $styles_file = ROOT_STYLE_PATH.$styles_partial.".css";

                $styles_file_link_tag = "<link href='".$styles_file."'>";

                $this->template_content = str_replace("[ css_styles ".$styles_partial." ]", $styles_file_link_tag, $this->template_content);

            }
        }
    }

    /**
     * @method void resolve_data()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that embeds data to the main page
     * - Check if data exists for the main file
     * - Replace data templates with actual data
     */
    private function resolve_data() {

        if (isset($this->data['main']) && count($this->data['main']) > 0) {

            foreach ($this->data['main'] as $key => $main_value) {
                $this->template_content = str_replace("{{ ".$key." }}", $main_value, $this->template_content);
            }
        }
    }

    /**
     * @method void show_resolved_template()
     * @author Philane Msibi <philanemsibi14@gmail.com>
     * @return void
     * Desc: Function that displays the formatted requested page
     * - resolve partials, data and display the processed file's content
     */
    public function show_resolved_template() {

        $this->template_content = file_get_contents($this->template_file);

        if (UtilsTemplate::is_main_layout_exist()) $this->template_content = UtilsTemplate::resolve_layout_partials($this->template_content);

        $this->resolve_partials();

        $this->resolve_styles_partials();

        $this->resolve_data();

        echo $this->template_content;

    }

}