<?

use App\Functions\FSort;
use App\Functions\FUser;

$this->setCss('ui/card/style');
$this->setCss('components/notes/style');
$this->setJs('components/notes/index');
?>

<?= $this->Component('modal'); ?>

<div id="filter-modal" class="modal-wrapper">

    <div class="modal">
        <div class="modal-head">
            <p class="modal-title">Фильтры</p>
            <a class="modal-btn-close modal-trigger"></a>
        </div>

        <div class="modal-content">
            <? $this->Ui('alert'); ?>

            <form id="form_image_load" action="/note" method="post">

                <? $this->Ui(
                    'input',
                    ['id' => 'category_id', 'type' => 'select', 'label' => 'Категория', 'options' => $this->categories_filter]
                ); ?>

                <? $this->Ui(
                    'input',
                    ['id' => 'category_id', 'type' => 'select', 'label' => 'Автор', 'options' => $this->categories_filter]
                ); ?>


                <fieldset class="row">

                    <? $this->Ui(
                        'button',
                        [
                            'text' => "Применить",
                            'color' => 'primary',
                            'type' => 'submit',
                            'flat' => true,
                            'transparent' => true
                        ]
                    ); ?>
                </fieldset>

            </form>
        </div>
    </div>
</div>

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

    <div class="row">
        <? $this->Ui(
            'button',
            [
                'text' => "Фильтрация",
                'color' => 'primary',
                'classes' => 'filter-btn',
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