<?php 
    namespace Classes;

    class Validator implements InterfaceValidator {
        public $patterns = [
            'tel'           => '[0-9+\s()\-]+',
            'text'          => '[\p{L}0-9\s\-.,;:!"%&()?+\'°#\/@]+',
            'email'         => '[a-zA-Z0-9_\-.+]+@[a-zA-Z0-9\-]+[.]+[a-z-A-Z]+'
        ];
        public $errors = [];
        private $name;
        private $value = null;

        public function name($name) {
            $this->name = $name;
            return $this;
        }

        public function pattern($patternName) {
            if (array_key_exists($patternName, $this->patterns)) {
                $regex = '/^('.$this->patterns[$patternName].')$/u';

                if ($this->value != '' && !preg_match($regex, $this->value))
                    $this->errors[] = 'Field ' . $this->name . ' contains an error.';
            } else {
                $this->errors[] = 'Not valid pattern on field ' . $this->name . '.';
            }

            return $this;
        }

        public function customPattern($pattern) {
            $regex = '/^('.$pattern.')$/u';

            if($this->value != '' && !preg_match($regex, $this->value))
                $this->errors[] = 'Field ' . $this->name . ' contains an error.';

            return $this;
        }

        public function value($value) {
            $this->value = $value;
            return $this;
        }

        public function required() {
            if (empty($this->value) || $this->value == null) {
                $this->errors[] = 'Field ' . $this->name . ' is required';
            }            
            return $this;
        }

        public function isSuccess() {
            return empty($this->errors);
        }

        public function getError() {
            return $this->errors;
        }
    }