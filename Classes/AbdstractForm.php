<?php
    // namespace app\controllers;
    namespace Classes;

    // use \App\Validator;

    abstract class AbdstractForm
    { // текст, пароль, дата, e-mail, textarea
        public $fields = [];
        public $get = [];
        public $values = [];
        public $post = [];

        public function __construct($method = 'POST') {
            if ($method == 'POST' && !empty($_POST)) {
                $this->values = $_POST;
            } elseif ($method == 'GET'  && !empty($_GET)) {
                $this->values = $_GET;
            } else {
                return 'error';
            }
        }

        // abstract public function validate();
        // abstract public function text();
        // abstract public function password();
        // abstract public function date();
        // abstract public function textarea();
    }