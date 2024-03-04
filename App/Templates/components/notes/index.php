<?

use App\Functions\FUser;

$this->setCss('ui/card/style');
$this->setCss('components/notes/style');

$url = $_SERVER['REQUEST_URI'];

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
                'link' => '/note?sort=updatedown',
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
                'text' => "Фильтрация",
                'color' => 'primary',
                'flat' => true,
                'transparent' => true,
                'icon' => "tune"
            ]
        ); ?>
        <? $this->Ui(
            'button',
            [
                'text' => $this->sort_name,
                'color' => 'primary',
                'action' => 'dropdown',
                'flat' => true,
                'transparent' => true,
                'icon' => "sort",
                'dropdown' => [
                    ['href' => "$url&sort=updatedown", 'text' => 'По дате ↓'],
                    ['href' => "$url&sort=updateup", 'text' => 'По дате ↑'],
                    ['href' => "$url&sort=titledown", 'text' => 'По названию ↓'],
                    ['href' => "$url&sort=titleup", 'text' => 'По названию ↑'],
                    ['href' => "$url&sort=likedown", 'text' => 'По лайкам ↓'],
                    ['href' => "$url&sort=likeup", 'text' => 'По лайкам ↑'],
                    ['href' => "$url&sort=bookmarkdown", 'text' => 'По закладкам ↓'],
                    ['href' => "$url&sort=bookmarkup", 'text' => 'По закладкам ↑'],
                ]
            ]
        ); ?>

        <? $this->Ui(
            'button',
            [
                'text' => "Создать заметку",
                'href' => "/note?create",
                'color' => 'primary',
                'transparent' => true
            ]
        ); ?>
    </div>

    <? $this->Ui(
        'tabs',
        [
            'link' => '/note?category=',
            'active' => $this->category,
            'list' => $this->categories
        ]
    ); ?>

    <? if (count($this->notes) === 0) : ?>
        <h4>Заметок пока нет</h4>

    <? else : ?>
        <? foreach ($this->notes as $note) {
            $this->Component(
                'notes_item',
                array_merge($note)
            );
        } ?>

    <? endif; ?>

</section>