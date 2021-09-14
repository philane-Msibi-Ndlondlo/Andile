<?php

namespace Andile\Domain\Core;

/**
 * Class that is the entry point of the app.
 * It registers all routes
 * And Runs the app
 */

class Template {

    public $template_file;
    public $template_content;
    public $data;
    public $partials;
    public $partial_file_content;

    public function __construct($file = '', $data = []) {

        if (empty($file) || $file === null) {
            die("No File Passed");
        }

        $this->template_file = $file;
        $this->data = $data;

    }

    public function set_tmp_partial($partial) {

        $this->partials[] = $partial;

    }

    public function show_resolved_template() {

        $this->template_content = file_get_contents($this->template_file);

        foreach ($this->partials as $partial) {
            $partial = trim($partial);
            $partial_file = PARTIALS_PATH.$partial.".html";

            if (!file_exists($partial_file)) {
                continue;
            }

            $partial_file_content = file_get_contents($partial_file);

            if (isset($this->data[$partial]) && count($this->data[$partial]) > 0) {

                foreach ($this->data[$partial] as $key => $partial_value) {
                    $partial_file_content = str_replace("{{ ".$key." }}", $partial_value, $partial_file_content);
                }
            } 

            $this->template_content = str_replace("[ include ".$partial." ]", $partial_file_content, $this->template_content);
        }

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

        if (isset($this->data['main']) && count($this->data['main']) > 0) {

            foreach ($this->data['main'] as $key => $main_value) {
                $this->template_content = str_replace("{{ ".$key." }}", $main_value, $this->template_content);
            }
        }

        echo $this->template_content;

    }

}