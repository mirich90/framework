<!-- 
    src
    alt
    href ? пока не сделал
    onclick ? пока не сделал
-->

<? $this->setCss('ui/image/style'); ?>

<?
// $flat = (isset($props['flat'])) ? 'flat' : '';
// $tag = (isset($props['href'])) ? "a" : 'button';
// $href = (isset($props['href'])) ? "href='{$props['href']}'" : '';
?>

<picture class="picture">
    <source class="picture-image" type="image/webp" srcset="/img/core/post_template.wepb" data-src="<?= $props['src']; ?>">
    <img class="picture-image" src="/img/core/post_template.png" data-src="<?= $props['src']; ?>" alt="<?= $props['alt']; ?>">
</picture>