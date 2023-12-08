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

    <form action="/login?submit" method="post">
        <? $this->Ui(
            'input',
            ['id' => 'email', 'type' => 'email', 'text' => 'e-mail (электронный адрес)', 'label' => 'E-mail', 'placeholder' => 'Введите e-mail (электронный адрес)']
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'password', 'type' => 'password', 'text' => 'Пароль', 'label' => 'Пароль', 'placeholder' => 'Введите пароль']
        ); ?>

        <fieldset class="sign-up__input sign-up__input--horizontal">

            <? $this->Ui(
                'button',
                [
                    'text' => "Войти",
                    'color' => 'primary',
                    'type' => 'submit',
                    'flat' => true,
                    'transparent' => true
                ]
            ); ?>

            <? $this->Ui(
                'button',
                [
                    'text' => "зарегистрироваться",
                    'href' => 'registration',
                    'transparent' => true
                ]
            ); ?>
        </fieldset>

    </form>
</section>