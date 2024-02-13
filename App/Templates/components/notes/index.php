<?
$this->setCss('ui/card/style');
$this->setCss('components/notes/style');
?>

<section class="ui-card notes container">

    <? $this->Ui(
        'title_description',
        [
            'text' => '<h1>заметки</h1> за неделю',
        ]
    ); ?>

    <section class="notes__header">
        <? $this->Ui(
            'title',
            [
                'text' => 'Последние заметки',
                'link' => '/post?id=',
                'level' => 2,
            ]
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'search', 'type' => 'search', 'placeholder' => 'Поиск', 'href' => "/note?search"]
        ); ?>

    </section>
    <div>
        <? $this->Ui(
            'button',
            [
                'text' => "Создать заметку",
                'href' => "/note?create",
                'color' => 'primary',
                'flat' => true,
                'transparent' => true
            ]
        ); ?>
    </div>


    <? foreach ($this->notes as $note) {
        $this->Component(
            'notes_item',
            array_merge($note)
        );
    } ?>

</section>