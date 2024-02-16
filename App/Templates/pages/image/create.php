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

    <? $this->Ui('alert'); ?>

    <? $this->Component('form_image'); ?>
</section>