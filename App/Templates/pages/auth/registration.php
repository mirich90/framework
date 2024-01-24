<section class="ui-card posts container">

    <? $this->Ui(
        'title_description',
        [
            'text' => '<h1>зарегистрироваться</h1>',
        ]
    ); ?>

    <? $this->Ui(
        'title',
        [
            'text' => 'Зарегистрироваться',
            'level' => 2
        ]
    ); ?>

    <? $this->Ui('alert'); ?>

    <? $this->Component('form_registration'); ?>

</section>