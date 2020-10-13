<?php
    // AUTOLOAD Classes

    spl_autoload_register(function($class) {
        $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
        
        if (file_exists($file))
            require_once $file;
    });

    // FORM 1 - Create, validate and render

    echo '<h1>Форма регистрации</h1>';

    $form1 = new Classes\Form('post');

    $form1->name('username')->element('input')->type('text')->pattern('text')->value('Kirill')->placeholder('Имя пользователя')->required();
    $form1->name('age')->element('input')->type('text')->customPattern('[0-9]+')->value('26')->placeholder('Возраст');
    $form1->name('user_email')->element('input')->type('text')->pattern('email')->value('smyotkin@gmail.com')->placeholder('E-mail')->required();
    $form1->name('telephone')->element('input')->type('text')->pattern('tel')->value('7989123412323')->placeholder('Телефон');
    $form1->name('password')->element('input')->type('password')->pattern('text')->value('Pass')->placeholder('Пароль')->required();

    $form1->validate();
    $form1->printErrors();
    $form1->render();

    // FORM 2 - Create, validate and render

    echo '<h1>Форма поиска</h1>';

    $form2 = new Classes\Form('get');

    $form2->name('search')->element('input')->type('text')->pattern('text')->value('Строка поиска')->placeholder('Что вы хотите найти?')->required();
    $form2->name('pages')->element('input')->type('number')->customPattern('[0-9]+')->value('5')->placeholder('Количество страниц');

    $form2->validate('search');
    $form2->printErrors();
    $form2->render();

    // echo '<pre>';
    // print_r($form2->rules);
    // echo '</pre>';