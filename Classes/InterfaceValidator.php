<?php
    namespace Classes;

    interface InterfaceValidator {
        public function name($name);
        public function pattern($patternName);
        public function customPattern($pattern);
        public function value($value);
    };