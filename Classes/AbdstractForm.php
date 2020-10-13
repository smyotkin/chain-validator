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

        public function __construct($method = 'POST')
        {
            if ($method == 'POST' && !empty($_POST)) {
                $this->values = $_POST;
            } elseif ($method == 'GET'  && !empty($_GET)) {
                $this->values = $_GET;
            } else {
                return 'error';
            }
        }

        abstract public function name($name);
        abstract public function element($element);
        abstract public function validate($name = false);
    }