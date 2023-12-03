<? $this->setCss('ui/button/style'); ?>

<?
$text = props($props, 'text');
$color = props($props, 'color');
$flat = props($props, 'flat', '', 'flat');
$transparent = props($props, 'transparent', '', 'transparent');
$tag = props($props, 'href', 'button', 'a');
$href = (isset($props['href'])) ? "href='{$props['href']}'" : '';
?>

<<?= $tag; ?> <?= $href; ?> class="btn <?= $transparent; ?> <?= $color; ?> <?= $flat; ?>">
    <?= $text; ?>
</<?= $tag; ?>>