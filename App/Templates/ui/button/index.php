<!-- 
    text
    flat ?
    href ?
    color ?
    onclick ?
-->

<? $this->setCss('ui/button/style'); ?>

<?

if (!isset($props['color'])) $props['color'] = '';
$flat = (isset($props['flat'])) ? 'flat' : '';
$tag = (isset($props['href'])) ? "a" : 'button';
$href = (isset($props['href'])) ? "href='{$props['href']}'" : '';
?>

<<?= $tag; ?> <?= $href; ?> class="btn <?= $props['color']; ?> <?= $flat; ?>">
    <?= $props['text']; ?>
</<?= $tag; ?>>