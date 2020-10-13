<?php
    spl_autoload_register(function($class) {
        $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
        
        if (file_exists($file))
            require_once $file;
    });

    $form = new Classes\Form('post');

    $form->element('input')->setType('text')->setName('username')->setPattern('text')->setValue('Kirill')->setPlaceholder('Имя пользователя')->setRequired();
    $form->element('input')->setType('text')->setName('age')->setCustomPattern('[0-9]+')->setValue('26')->setPlaceholder('Возраст');
    $form->element('input')->setType('text')->setName('user_email')->setPattern('email')->setValue('smyotkin@gmail.com')->setPlaceholder('E-mail')->setRequired();
    $form->element('input')->setType('text')->setName('telephone')->setPattern('tel')->setValue('7989123412323')->setPlaceholder('Телефон');
    $form->element('input')->setType('password')->setName('password')->setPattern('text')->setValue('Pass')->setPlaceholder('Пароль')->setRequired();

    $form->render();

    // $form->addElement(
    //    'element'      => 'input',
    //    'type'         => 'text',
    //    'name'         => 'username',
    //    'pattern'      => 'text',
    //    'value'        => 'Kirill',
    //    'placeholder'  => 'Имя пользователя',
    //    'required'     => true
    // );