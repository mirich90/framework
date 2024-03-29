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

    <? $this->Component(
        'profile_edit_avatar',
        [
            'avatar' => $this->user['avatar_url'],
            'link' => $this->user['link'],
            'username' => $this->user['username']
        ]
    ); ?>

    <form action="profile?update&submit&id=<?= $this->user['link']; ?>" id="form-profile" method="post">

        <? $this->Ui(
            'input',
            ['id' => 'avatar', 'type' => 'hidden', 'label' => 'Аватар', 'value' => $this->user['avatar']]
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'username', 'type' => 'text', 'label' => 'Имя/ник пользователя', 'placeholder' => 'Введите свое имя/ник', 'value' => $this->user['username']]
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'link', 'type' => 'text', 'label' => 'Адрес страницы', 'placeholder' => 'Введите  адрес вашей личной страницы)', 'value' => $this->user['link']]
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'city', 'type' => 'text', 'label' => 'Место жительства', 'placeholder' => 'Введите  место жительства)', 'value' => $this->user['city']]
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'info', 'type' => 'text', 'label' => 'О себе', 'placeholder' => 'Расскажите о себе', 'value' => $this->user['info']]
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'email', 'type' => 'email', 'label' => 'E-mail (электронный адрес)', 'placeholder' => 'Введите e-mail (электронный адрес)', 'value' => $this->user['email']]
        ); ?>

        <!-- <? $this->Ui(
                    'input',
                    ['id' => 'password', 'type' => 'password', 'text' => 'Пароль', 'label' => 'Пароль', 'placeholder' => 'Введите пароль', 'value' => 'cvbcvb']
                ); ?> -->

        <fieldset class="row">

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