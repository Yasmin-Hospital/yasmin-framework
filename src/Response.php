<?php 

namespace Yasmin;

class Response {

    private $content;
    private $code;

    function __construct($content = '', $code = 200) {
        $this->content = $content;
        $this->code = $code;
    }

    function send() {
        if(php_sapi_name() != 'cli') {
            $code = $this->code;
            // pastikan $code valid integer HTTP, gunakan 200 sebagai fallback
            if (!is_int($code) || $code <= 0) {
                $code = 200;
            }
            http_response_code($code);
        }
        echo $this->content;
        if(php_sapi_name() == 'cli') echo "\n";
        die();
    }

}