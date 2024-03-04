<?

use App\Functions\FSort;
use App\Functions\FUser;

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
                    ['href' => FSort::getSort("updatedown"), 'text' => 'По дате ↓'],
                    ['href' => FSort::getSort("updateup"), 'text' => 'По дате ↑'],
                    ['href' => FSort::getSort("titledown"), 'text' => 'По названию ↓'],
                    ['href' => FSort::getSort("titleup"), 'text' => 'По названию ↑'],
                    ['href' => FSort::getSort("likedown"), 'text' => 'По лайкам ↓'],
                    ['href' => FSort::getSort("likeup"), 'text' => 'По лайкам ↑'],
                    ['href' => FSort::getSort("bookmarkdown"), 'text' => 'По закладкам ↓'],
                    ['href' => FSort::getSort("bookmarkup"), 'text' => 'По закладкам ↑'],
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