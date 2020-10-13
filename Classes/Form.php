<?php
    namespace Classes;

    class Form extends AbdstractForm
    {
        public $method = '';
        public $data = [];
        public $rules = [];
        public $elements = [];
        private $name = '';
        private $errors = [];

        /**
         * Set form request method
         *
         * @param string $method
         * @param array $data
         */
        public function __construct($method = 'post')
        {
            $this->method = $method;

            if (strtolower($method) == 'post' && !empty($_POST)) {
                $this->data = $_POST;
            } elseif (strtolower($method) == 'get' && !empty($_GET)) {
                $this->data = $_GET;
            }
        }

        /**
         * Set name for element
         *
         * @param string $name
         * @return this
         */
        public function name($name)
        {
            $this->name = $name;
            $this->elements[$this->name]['name'] = $name;
            return $this;
        }

        /**
         * Create element with tag
         *
         * @param string $element
         * @return this
        */
        public function element($element)
        {
            if (!empty($this->name)) {
                $this->elements[$this->name]['tag'] = $element;
                $this->elements[$this->name]['type'] = 'text';
            }
            return $this;
        }

        /**
         * Set type for element
         *
         * @param string $type
         * @return this
         */
        public function type($type)
        {
            $this->elements[$this->name]['type'] = $type;
            return $this;
        }

        /**
         * Set pattern for element
         *
         * @param string $patternName
         * @return this
         */
        public function pattern($patternName)
        {
            $this->elements[$this->name]['pattern'] = $patternName;
            return $this;
        }

        /**
         * Set custom pattern for element
         *
         * @param string $patternName
         * @return this
         */
        public function customPattern($patternName)
        {
            $this->elements[$this->name]['customPattern'] = $patternName;
            return $this;
        }

        /**
         * Set placeholder for element
         *
         * @param string $placeholder
         * @return this
         */
        public function placeholder($placeholder)
        {
            $this->elements[$this->name]['placeholder'] = $placeholder;
            return $this;
        }

        /**
         * Set value for element
         *
         * @param string $value
         * @return this
         */
        public function value($value)
        {
            $this->elements[$this->name]['value'] = $value;
            return $this;
        }

        /**
         * Check field on require for element
         *
         * @return this
         */
        public function required() {
            $this->elements[$this->name]['required'] = true;
            return $this;
        }

        /**
         * Return errors
         *
         * @return array
         */
        public function getErrors()
        {
            return $this->errors;
        }

        /**
         * Print errors
         * 
         * @return mixed
         */
        public function printErrors()
        {
            if (!empty($this->errors)) {
                echo '<pre>';
                print_r($this->errors);
                echo '</pre>';
            }
        }

        /**
         * Validate all fields on form, or if add param $name - method validate field with name
         *
         * @return bool
         */
        public function validate($name = false)
        {
            $validate = new Validator();

            if ($name) {
                $dataValue = $this->data[$name];
                $element = $this->elements[$name];

                if (!empty($dataValue)) {
                    if (!empty($dataValue['customPattern'])) {
                        $validate->name($name)->value($dataValue)->customPattern($element['customPattern'])->required();
                    } else {
                        $validate->name($name)->value($dataValue)->pattern($element['pattern'])->required();
                    }
                }
            } else {
                foreach ($this->elements as $element) {
                    $name = $element['name'];
                    $dataValue = $this->data[$name];
    
                    if (!empty($dataValue)) {
                        if (!empty($element['customPattern'])) {
                            $validate->name($name)->value($dataValue)->customPattern($element['customPattern'])->required();
                        } else {
                            $validate->name($name)->value($dataValue)->pattern($element['pattern'])->required();
                        }
                    }
    
                }
            }
            
            $this->errors = $validate->getError();

            return $validate->isSuccess();
        }

        /**
         * Render form with fields
         *
         * @return mixed
         */
        public function render()
        {
            echo "<form method=\"{$this->method}\">";

            foreach ($this->elements as $element) {
                $tag = $element['tag'];
                $type = $element['type'];
                $name = $element['name'];
                $value = $element['value'];
                $placeholder = $element['placeholder'];
                $required = ($element['required'] ? 'required' : '');

                if ($element['tag'] == 'input')
                    echo "<$tag type=\"$type\" id=\"form-$name\" name=\"$name\" value=\"$value\" placeholder=\"$placeholder\" $required>";

                echo '<br><br>';
            }

            echo '<button type="submit">Отправить</button>';
            echo "</form>";
        }
    }