<?php
    namespace Classes;

    class Form extends AbdstractForm {
        public static $count = -1;
        public $method = 'post';
        public $data = [];
        public $elements = [];

        public function __construct($method = 'post') {
            if (strtolower($method) == 'post' && !empty($_POST)) {
                $this->data = $_POST;
            } elseif (strtolower($method) == 'get' && !empty($_GET)) {
                $this->data = $_GET;
            }
        }

        public function element($element) {
            self::$count++;
            $this->elements[self::$count]['tag'] = $element;
            return $this;
        }

        public function setType($type) {
            $this->elements[self::$count]['type'] = $type;
            return $this;
        }

        public function setName($name) {
            $this->elements[self::$count]['name'] = $name;
            return $this;
        }

        public function setPattern($patternName) {
            $this->elements[self::$count]['pattern'] = $patternName;
            return $this;
        }

        public function setCustomPattern($patternName) {
            $this->elements[self::$count]['customPattern'] = $patternName;
            return $this;
        }

        // public function setValidate($patternName) {
        //     $this->elements[self::$count]['customPattern'] = $patternName;
        //     return $this;
        // }

        public function setPlaceholder($placeholder) {
            $this->elements[self::$count]['placeholder'] = $placeholder;
            return $this;
        }

        public function setValue($value) {
            $this->elements[self::$count]['value'] = $value;
            return $this;
        }

        public function setRequired() {
            $this->elements[self::$count]['required'] = true;
            return $this;
        }

        public function render() {
            echo "<form method=\"{$this->method}\">";

            foreach ($this->elements as $element) {
                $validate = new Validator();
                $tag = $element['tag'];
                $type = $element['type'];
                $name = $element['name'];
                $value = $element['value'];
                $dataValue = $this->data[$name];
                // $pattern = $validate->patterns[$element['pattern']];
                $placeholder = $element['placeholder'];
                $required = ($element['required'] ? 'required' : '');
                
                if ($element['tag'] == 'input')
                    echo "<$tag type=\"$type\" id=\"form-$name\" name=\"$name\" value=\"$value\" placeholder=\"$placeholder\" $required>"; // pattern=\"$pattern\"

                if (!empty($this->data[$name])) {
                    if (!empty($element['customPattern']))
                        $validate->name($name)->value($dataValue)->customPattern($element['customPattern'])->required();
                    else
                        $validate->name($name)->value($dataValue)->pattern($element['pattern'])->required();
                }

                if (!$validate->isSuccess()) {
                    print_r($validate->getError());
                }

                echo '<br><br>';
            }

            echo '<button type="submit">Send</button>';
            echo "</form>";
        }
    }