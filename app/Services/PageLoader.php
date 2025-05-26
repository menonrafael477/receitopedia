<?php

trait PageLoader {

    private static function loadHeader() {
        include HEADER_LAYOUT;
    }

    private static function loadFooter(){
        include FOOTER_LAYOUT;
    }   
}

?>