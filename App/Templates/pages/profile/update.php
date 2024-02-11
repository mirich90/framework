<section class="ui-card posts container">

    <? $this->Ui(
        'title_description',
        [
            'text' => '<h1>Личный профиль пользователя</h1>',
        ]
    ); ?>

    <? $this->Ui(
        'title',
        [
            'text' => 'Редактировать профиль',
            'level' => 2
        ]
    ); ?>

    <? $this->Ui('alert_session'); ?>

    <form action="/login?submit" method="post">
        <? $this->Ui(
            'input',
            ['id' => 'username', 'type' => 'text', 'text' => 'e-mail (электронный адрес)', 'label' => 'E-mail (электронный адрес)', 'placeholder' => 'Введите e-mail (электронный адрес)', 'value' => 'cvb@cvb.cvb']
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'email', 'type' => 'email', 'text' => 'e-mail (электронный адрес)', 'label' => 'E-mail', 'placeholder' => 'Введите e-mail (электронный адрес)', 'value' => 'cvb@cvb.cvb']
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'password', 'type' => 'password', 'text' => 'Пароль', 'label' => 'Пароль', 'placeholder' => 'Введите пароль', 'value' => 'cvbcvb']
        ); ?>

        <fieldset class="sign-up__input sign-up__input--horizontal">

            <? $this->Ui(
                'button',
                [
                    'text' => "Редактировать",
                    'color' => 'primary',
                    'type' => 'submit',
                    'flat' => true,
                    'transparent' => true
                ]
            ); ?>

        </fieldset>

    </form>
</section>