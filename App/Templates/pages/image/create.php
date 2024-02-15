<section class="ui-card posts container">

    <? $this->Ui(
        'title_description',
        [
            'text' => '<h1>картинки</h1>',
        ]
    ); ?>

    <? $this->Ui(
        'title',
        [
            'text' => 'Загрузить картинку',
            'level' => 2,
            'link' => '/image?create',
        ]
    ); ?>

    <? $this->Ui('alert_session'); ?>

    <form action="/image?create&submit" method="post">
        <? $this->Ui(
            'input',
            ['id' => 'title', 'text' => 'Название', 'label' => 'Название', 'placeholder' => 'Введите название картинки']
        ); ?>


        <? $this->Ui('load_image', []); ?>

        <? $this->Ui(
            'input',
            ['id' => 'is_show', 'type' => 'checkbox', 'label' => 'Видима для всех']
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'is_public', 'type' => 'checkbox', 'label' => 'Опубликовать (картинка будет отображаться в новостях)']
        ); ?>

        <fieldset class="sign-up__input sign-up__input--horizontal">

            <? $this->Ui(
                'button',
                [
                    'text' => "Загрузить картинку",
                    'color' => 'primary',
                    'type' => 'submit',
                    'flat' => true,
                    'transparent' => true
                ]
            ); ?>
        </fieldset>

    </form>
</section>