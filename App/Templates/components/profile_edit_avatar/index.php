<?

$this->setCss('ui/card/style');
$this->setCss('components/profile_edit_avatar/style');
$this->setJs('components/profile_edit_avatar/index');

$this->Component('modal');

$classes = props($props, 'classes');
$avatar = props($props, 'avatar');
$username = props($props, 'username');

?>

<div class="biocard-avatar">
    <? $this->Ui(
        'image',
        [
            'src' => "/img/$avatar",
            'alt' => $username,
        ]
    ); ?>
</div>

<div id="biocard-modal" class="modal-wrapper">

    <div class="modal">
        <div class="modal-head">
            <p class="modal-title">Ссылки на статью</p>
            <a class="modal-btn-close modal-trigger"></a>
        </div>

        <div class="modal-content">
            <? $this->Ui('alert'); ?>
            <?= $this->Component('form_image'); ?>
        </div>
    </div>
</div>