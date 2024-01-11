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

    <? $this->Component('form_registration'); ?>

</section>