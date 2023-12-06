<section class="ui-card posts container">

    <? $this->Ui(
        'title_description',
        [
            'text' => '<h1>заметки</h1>',
        ]
    ); ?>

    <? $this->Ui(
        'title',
        [
            'text' => 'Создать заметку',
            'level' => 2,
            'link' => '/note?create',
        ]
    ); ?>

    <? $this->Ui('alert_session'); ?>

    <form action="/note?create" method="post">
        <? $this->Ui(
            'input',
            ['id' => 'title', 'text' => 'Название', 'label' => 'Заголовок', 'placeholder' => 'Введите заголовок заметки']
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'text', 'type' => 'textarea', 'text' => 'Название', 'label' => 'Текст', 'placeholder' => 'Введите текст заметки']
        ); ?>

        <fieldset class="sign-up__input sign-up__input--horizontal">

            <? $this->Ui(
                'button',
                [
                    'text' => "Создать заметку",
                    'color' => 'primary',
                    'type' => 'submit',
                    'flat' => true,
                    'transparent' => true
                ]
            ); ?>
        </fieldset>

    </form>
</section>