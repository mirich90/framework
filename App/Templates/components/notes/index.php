<?
$this->setCss('components/notes/style');

$notes = [
    [
        'id' => 1,
        'author_name' =>  'Cosima Mielke',
        'author_img' =>  '/img/users/098098/1.jpg',
        'author_img_alt' =>  'info',
        'title' => 'Cold Days, Shining Lights (December 2023 Wallpapers Edition)',
        'date' => '20 дек. 2023',
        'link' => 'asd',
        'content' => 'Could there be a better way to welcome the new month than with a collection of desktop wallpapers? We’ve got some eye-catching designs to sweeten up the last few weeks of the year and, if you’re celebrating, to get you in the holiday mood.',
    ],
    [
        'id' => 2,
        'author_name' =>  'Инна Иванова',
        'author_img' =>  '/img/users/098098/2.jpg',
        'author_img_alt' =>  'info',
        'title' => 'Художник Руди Сисванто: милые звери, яркие характеры и добрые истории',
        'date' => '20 янв. 2023',
        'link' => 'asd',
        'content' => 'Руди Сисванто — художник из Индонезии. Он вырос в мегаполисе Сурабае на острове Ява и рисовать научился самостоятельно — художественных учебных заведений рядом просто не было. Сейчас его работами могут любоваться игроки в League of Legends — Руди создаёт для неё заставки. А в Сети наиболее известны его обаятельные герои-животные, в чьих образах сочетается реалистичность и мультяшная наивность, — они чем-то напоминают персонажей «Зверополиса». У каждого такого зверька есть своя история, и Сисванто великолепно удаётся их рассказывать.',
    ],
];
?>

<section class="container notes">

    <?
    $this->Component(
        'breadcrumbs',
        [
            'parent' => '',
            'text' => '<h1>заметки</h1>',
            'link' => '/post?id=',
        ]
    );
    ?>


    <? $this->Ui(
        'title',
        [
            'text' => 'Последние заметки',
            'link' => '/post?id=',
            'level' => 2,
        ]
    ); ?>

    <? foreach ($notes as $note) {
        $this->Component(
            'notes_item',
            array_merge($note)
        );
    } ?>

</section>