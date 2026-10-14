<?php
class Test {
    public static function _this($input) {
        echo '<pre>';
        print_r($input);
        echo '</pre>';
    }
    public static function _dump($input) {
        var_dump($input);
        exit;
    }
}