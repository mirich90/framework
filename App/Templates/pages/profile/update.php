<section class="ui-card posts container">

    <?

    use App\Functions\FUser;

    $this->Ui(
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

    <form action="profile?update&submit&id=<?= FUser::getLink(); ?>" method="post">
        <? $this->Ui(
            'input',
            ['id' => 'username', 'type' => 'text', 'label' => 'Имя/ник пользователя', 'placeholder' => 'Введите e-mail (электронный адрес)', 'value' => FUser::getUsername()]
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'link', 'type' => 'text', 'label' => 'Адрес страницы', 'placeholder' => 'Введите  адрес вашей личной страницы)', 'value' => FUser::getLink()]
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'city', 'type' => 'text', 'label' => 'Место жительства', 'placeholder' => 'Введите  место жительства)', 'value' => FUser::getCity()]
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'info', 'type' => 'text', 'label' => 'О себе', 'placeholder' => 'Расскажите о себе', 'value' => FUser::getInfo()]
        ); ?>

        <!-- <? $this->Ui(
                    'input',
                    ['id' => 'email', 'type' => 'email', 'label' => 'E-mail (электронный адрес)', 'placeholder' => 'Введите e-mail (электронный адрес)', 'value' => FUser::getEmail()]
                ); ?> -->

        <!-- <? $this->Ui(
                    'input',
                    ['id' => 'password', 'type' => 'password', 'text' => 'Пароль', 'label' => 'Пароль', 'placeholder' => 'Введите пароль', 'value' => 'cvbcvb']
                ); ?> -->

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

            <? $this->Ui(
                'button',
                [
                    'text' => 'Вернуться на страницу профиля',
                    'href' => "/profile",
                ]
            ); ?>

        </fieldset>

    </form>
</section>