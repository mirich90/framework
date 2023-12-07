<section class="ui-card posts container">

    <? $this->Ui(
        'title_description',
        [
            'text' => '<h1>войти в личный кабинет</h1>',
        ]
    ); ?>

    <? $this->Ui(
        'title',
        [
            'text' => 'Войти',
            'level' => 2
        ]
    ); ?>

    <? $this->Ui('alert_session'); ?>

    <form action="/registration?index&submit" method="post">
        <? $this->Ui(
            'input',
            ['id' => 'email', 'type' => 'text', 'text' => 'e-mail (электронный адрес)', 'label' => 'E-mail', 'placeholder' => 'Введите e-mail (электронный адрес)']
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'password', 'type' => 'password', 'text' => 'Пароль', 'label' => 'Пароль', 'placeholder' => 'Введите пароль']
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'password2', 'type' => 'password', 'text' => 'Повторите пароль', 'label' => 'Повторите пароль', 'placeholder' => 'Введите пароль еще раз']
        ); ?>

        <fieldset class="sign-up__input sign-up__input--horizontal">

            <? $this->Ui(
                'button',
                [
                    'text' => "Зарегистрироваться",
                    'color' => 'primary',
                    'type' => 'submit',
                    'flat' => true,
                    'transparent' => true
                ]
            ); ?>

            <? $this->Ui(
                'button',
                [
                    'text' => "уже зарегистрированы? Войти",
                    'href' => '/login',
                    'transparent' => true
                ]
            ); ?>
        </fieldset>

    </form>
</section>