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
            'text' => 'Изменить заметку',
            'level' => 2,
            'link' => "/note?update&id=" . $this->note['link'],
        ]
    ); ?>

    <? $this->Ui('alert_session'); ?>

    <form action="/note?update&submit&id=<?= $this->note['link']; ?>" method="post">
        <? $this->Ui(
            'input',
            ['id' => 'title', 'text' => 'Название', 'label' => 'Заголовок', 'placeholder' => 'Введите заголовок заметки', 'value' => $this->note['title']]
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'category_id', 'type' => 'select', 'label' => 'Категория', 'placeholder' => 'Выберите категорию заметки', 'options' => $this->categories, 'value' => $this->note['category_id']]
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'content', 'type' => 'textarea', 'text' => 'Название', 'label' => 'Текст', 'placeholder' => 'Введите текст заметки', 'value' => $this->note['content']]
        ); ?>

        <fieldset class="row">

            <? $this->Ui(
                'button',
                [
                    'text' => "Изменить заметку",
                    'color' => 'primary',
                    'type' => 'submit',
                    'flat' => true,
                    'transparent' => true
                ]
            ); ?>
        </fieldset>

    </form>
</section>