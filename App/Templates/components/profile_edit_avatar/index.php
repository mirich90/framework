<?

$this->setCss('ui/card/style');
$this->setCss('components/profile_edit_avatar/style');
$this->setJs('components/profile_edit_avatar/index');

$this->Component('modal');

$classes = props($props, 'classes');
$avatar = props($props, 'avatar');
$link = props($props, 'link');
$username = props($props, 'username');

$avatar = ($avatar) ? "/img/load/webp/$avatar.webp" : env('images')['avatar'];
?>

<div class="biocard-avatar">
    <? $this->Ui(
        'image',
        [
            'src' => $avatar,
            'alt' => $username,
        ]
    ); ?>
</div>

<div id="biocard-modal" class="modal-wrapper">

    <div class="modal">
        <div class="modal-head">
            <p class="modal-title">Изменить аватар</p>
            <a class="modal-btn-close modal-trigger"></a>
        </div>

        <div class="modal-content">
            <? $this->Ui('alert'); ?>
            <?= $this->Component('form_image', ['event' => 'addAvatar', 'id' =>  $link]); ?>
        </div>
    </div>
</div>