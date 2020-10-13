<?php
    namespace Classes;

    interface InterfaceValidator {
        public function name($name);
        public function pattern($patternName);
        public function customPattern($pattern);
        public function value($value);
    };

    // abstract class AbdstractValidator
    // { // текст, пароль, дата, e-mail, textarea
    //     public $value;
        
    //     // public function validateField ($is_require = false) {
    //     // }
    //     abstract public function name($name);
    // }