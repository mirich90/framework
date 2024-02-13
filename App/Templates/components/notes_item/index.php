<?
$this->setCss('components/notes_item/style');

$author_avatar = props($props, 'author_avatar', 'core/ava.png');
$author_username = props($props, 'author_username');
$author_link = props($props, 'author_link');
$title = props($props, 'title');
$link = props($props, 'link');
$id = props($props, 'id');
$content = props($props, 'content');
$datetime = props($props, 'datetime');
$category = props($props, 'category');
$is_like = props($props, 'is_like');
$count_like = props($props, 'is_like');
$is_bookmark = props($props, 'is_bookmark');
$count_bookmark = props($props, 'is_bookmark');
$category_link = props($props, 'category_link');

if (!isset($props['is_breadcrumbs'])) $props['is_breadcrumbs'] = false;
?>


<div class="notes-item">
    <div class="notes-item-author-img">
        <a href="/">
            <? $this->Ui(
                'image',
                [
                    'src' => "/img/" . $author_avatar,
                    'alt' => $author_username
                ]
            ); ?>
        </a>
    </div>

    <div class="notes-item-body">

        <div class="notes-item-title">
            <div class="notes-item-author-name">
                <a href="/profile?id=<?= $author_link; ?>">
                    <?= $author_username; ?>
                </a>
            </div>

            <? if ($props['is_breadcrumbs']) {
                $this->Component(
                    'breadcrumbs',
                    [
                        'parent' => 'заметки',
                        'text' => $category,
                        'link' => $category_link,
                    ]
                );
            } ?>

            <? $this->Ui(
                'title',
                [
                    'text' => $title,
                    'link' => "/note?id=$link",
                    'level' => 3,
                ]
            ); ?>
        </div>

        <p>
            <span><?= $datetime; ?> — </span>
            <?= $content; ?>
        </p>

        <div class="post-action">
            <? $this->Ui(
                'icon',
                [
                    'label' => $count_like,
                    'icon' => "favorite",
                    'active' => !!$is_like,
                    'click' => '',
                    'id' => $id,
                    'table' => "notes",
                    'action' => 'like',
                ]
            ); ?>

            <? $this->Ui(
                'icon',
                [
                    'label' => $count_bookmark,
                    'icon' => "bookmark",
                    'active' => !!$is_bookmark,
                    'click' => '',
                    'id' => $id,
                    'table' => "notes",
                    'action' => 'bookmark',
                ]
            ); ?>

            <? $this->Ui(
                'icon',
                [
                    'label' => 12,
                    'icon' => "comment",
                    'href' => "/note?id=$link#comments",
                    'click' => '',
                ]
            ); ?>

            <? $this->Ui(
                'icon',
                [
                    'icon' => "edit",
                    'href' => "/note?update&id=$link",
                    'click' => '',
                ]
            ); ?>

            <? $this->Ui(
                'icon',
                [
                    'icon' => "menu",
                    'active' => false,
                    'click' => '',
                    'id' => 1,
                    'table' => "notes",
                    'action' => 'bookmark',
                ]
            ); ?>
        </div>
    </div>


</div>