<? $this->setCss('ui/tabs/style'); ?>

<?
$list = props($props, 'list');
$link = props($props, 'link');
?>

<div class="horizontal-tabs">
    <a href="<?= $link; ?>" class='active'>Все</a>
    <? foreach ($list as $item) : ?>
        <a href="<?= $link . $item['index']; ?>">
            <?= $item['name']; ?>
        </a>
    <? endforeach; ?>
</div>