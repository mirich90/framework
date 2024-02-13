<?

use App\Functions\FUser;

$this->setCss('components/images_item/style');

$id = props($props, 'id');
$author_username = props($props, 'author_username');
$author_link = props($props, 'author_link');
$author_id = props($props, 'user_id');
$title = props($props, 'title');
$link = props($props, 'link');
$datetime = props($props, 'datetime');
$is_like = props($props, 'is_like');
$count_like = props($props, 'is_like');
$is_bookmark = props($props, 'is_bookmark');
$count_bookmark = props($props, 'is_bookmark');
$is_menu = props($props, 'is_menu', null);

?>

<li class="images_list__item">
    <div class="images_list__item__img">
        <? $this->Ui(
            'image',
            [
                'src' => $link,
                'alt' => $title,
            ]
        ); ?>
    </div>
    <div class="images_list__item__content">

        <div class="images_list__item__content__info">
            <h3><?= $title; ?></h3>
            <a href="<?= $author_link; ?>"><?= $author_username; ?></a>
        </div>

        <div class="images-action">
            <? $this->Ui(
                'icon',
                [
                    'label' => $count_like,
                    'icon' => "favorite",
                    'active' => !!$is_like,
                    'id' => $id,
                    'table' => "images",
                    'action' => 'like',
                    'small' => true,
                ]
            ); ?>

            <? $this->Ui(
                'icon',
                [
                    'label' => $count_bookmark,
                    'icon' => "bookmark",
                    'active' => !!$is_bookmark,
                    'id' => $id,
                    'table' => "images",
                    'action' => 'bookmark',
                    'small' => true,
                ]
            ); ?>

            <? $this->Ui(
                'icon',
                [
                    'label' => 12,
                    'icon' => "comment",
                    'href' => "/image?id=$link#comments",
                    'small' => true,
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
                        'small' => true,
                        'dropdown' => [
                            ['action' => 'qr', 'text' => 'QR-код'],
                            ['href' => "/image?update&id=$link", 'text' => 'Редактировать', 'is_my' => $author_id === FUser::getId()]
                        ]
                    ]
                );
            }
            ?>
        </div>
    </div>
</li>