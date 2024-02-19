<?
$this->setCss('components/qr/style');
$this->setJs('components/qr/qrcode.min');
$this->setJs('components/qr/index');

$link = env('url_site') . props($props, 'link');
?>

<?= $this->Component('modal'); ?>

<div id="qrcode-wrapper" class="modal-wrapper" data-qrcode="<?= $link; ?>">

    <div class="modal">
        <div class="modal-head">
            <p class="modal-title">Ссылки на статью</p>
            <a class="modal-btn-close modal-trigger"></a>
        </div>

        <div class="modal-content">
            <p>Перейти на страницу статьи с помощью этого qr-кода</p>
            <div id="qrcode">
                <img src="" alt="">
            </div>
        </div>
    </div>
</div>