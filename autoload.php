<?php

class Autoload {

    public $title;
    public $css_inc;
    public $js_inc;

    function loadCss() {
        if ($this->css_inc != NULL) {
            foreach ($this->css_inc as $value) {
                echo '<link rel="stylesheet" href="' . $value . '">';
                echo PHP_EOL;
            }
        }
    }

    function loadJs() {
        if ($this->js_inc != NULL) {
            foreach ($this->js_inc as $value) {
                echo '<script type="text/javascript" src="' . $value . '"></script>';
                echo PHP_EOL;
            }
        }
    }

    function getTitle() {
        return $this->title;
    }
}

?>

