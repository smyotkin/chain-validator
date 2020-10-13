<?php
    spl_autoload_register(function($class) {
        $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
        
        if (file_exists($file))
            require_once $file;
    });

    $form = new Classes\Form('post');

    $form->element('input')->type('text')->name('username')->pattern('text')->value('Kirill')->placeholder('Имя пользователя')->required();
    $form->element('input')->type('text')->name('age')->customPattern('[0-9]+')->value('26')->placeholder('Возраст');
    $form->element('input')->type('text')->name('user_email')->pattern('email')->value('smyotkin@gmail.com')->placeholder('E-mail')->required();
    $form->element('input')->type('text')->name('telephone')->pattern('tel')->value('7989123412323')->placeholder('Телефон');
    $form->element('input')->type('password')->name('password')->pattern('text')->value('Pass')->placeholder('Пароль')->required();

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