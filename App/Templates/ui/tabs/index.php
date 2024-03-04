<? $this->setCss('ui/tabs/style'); ?>

<?
$list = props($props, 'list');
$active = props($props, 'active');
$link = props($props, 'link');
?>

<div class="horizontal-tabs">
    <a href="<?= $link; ?>" class='<?= (!$active) ? 'active' : '' ?>'>Все</a>
    <? foreach ($list as $item) : ?>
        <a href="<?= $link . $item['link']; ?>" class='<?= ($item['link'] === $active) ? 'active' : '' ?>'>
            <?= $item['name']; ?>
        </a>
    <? endforeach; ?>
</div>