<?

use App\Functions\FUser;

$this->setCss('components/notes_item/style');

$author_avatar = props($props, 'info_users_avatar', null);
$author_username = props($props, 'info_users_username');
$author_link = props($props, 'info_users_link');
$author_id = props($props, 'user_id');
$title = props($props, 'title');
$link = props($props, 'link');
$id = props($props, 'id');
$content = props($props, 'content');
$datetime = props($props, 'datetime');
$category = props($props, 'category');
$is_likes = props($props, 'is_likes');
$count_likes = props($props, 'count_likes');
$is_bookmarks = props($props, 'is_bookmarks');
$count_bookmarks = props($props, 'count_bookmarks');
$category_link = props($props, 'category_link');
$is_menu = props($props, 'is_menu', null);

$author_avatar = ($author_avatar)  ? "/img/load/webp/$author_avatar.webp" : env('images')['avatar'];
if (!isset($props['is_breadcrumbs'])) $props['is_breadcrumbs'] = false;
?>

<?= $this->Component('qr', ['link' => "note?id=$link"]); ?>

<div class="notes-item">
    <div class="notes-item-author-img">
        <a href="/profile?id=<?= $author_link; ?>">
            <? $this->Ui(
                'image',
                [
                    'src' => $author_avatar,
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
            <time datetime="<?= $datetime; ?>">
                <?= $datetime; ?> —
            </time>
            <?= $content; ?>
        </p>

        <div class="post-action">
            <? $this->Ui(
                'icon',
                [
                    'label' => $count_likes,
                    'icon' => "favorite",
                    'active' => !!$is_likes,
                    'id' => $id,
                    'table' => "notes",
                    'action' => 'like',
                ]
            ); ?>

            <? $this->Ui(
                'icon',
                [
                    'label' => $count_bookmarks,
                    'icon' => "bookmark",
                    'active' => !!$is_bookmarks,
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
                ]
            ); ?>

            <?
            if ($is_menu) {
                $this->Ui(
                    'icon',
                    [
                        'icon' => "menu",
                        'active' => false,
                        'action' => 'dropdown',
                        'id' => 1,
                        'dropdown' => [
                            ['action' => 'qr', 'text' => 'QR-код'],
                            ['href' => "/note?update&id=$link", 'text' => 'Редактировать', 'is_my' => $author_id === FUser::getId()]
                        ]
                    ]
                );
            }
            ?>
        </div>
    </div>


</div>