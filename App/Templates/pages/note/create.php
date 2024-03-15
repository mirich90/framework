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

    <form action="/note?create&submit" method="post">
        <? $this->Ui(
            'input',
            ['id' => 'title', 'text' => 'Название', 'label' => 'Заголовок', 'placeholder' => 'Введите заголовок заметки']
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'category_id', 'type' => 'select', 'label' => 'Категория', 'placeholder' => 'Выберите категорию заметки', 'options' => $this->categories]
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'content', 'type' => 'textarea', 'text' => 'Название', 'label' => 'Текст', 'placeholder' => 'Введите текст заметки']
        ); ?>

        <fieldset class="row">

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