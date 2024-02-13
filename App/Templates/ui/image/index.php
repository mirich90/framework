<!-- 
    src
    alt
    href ? пока не сделал
    onclick ? пока не сделал
-->

<? $this->setCss('ui/image/style'); ?>

<?
$src = props($props, 'src');
$alt = props($props, 'alt');
// $flat = (isset($props['flat'])) ? 'flat' : '';
// $tag = (isset($props['href'])) ? "a" : 'button';
// $href = (isset($props['href'])) ? "href='{$props['href']}'" : '';
?>

<picture class="picture">
    <!-- <source class="picture-image" type="image/webp" srcset="/img/core/post_template.wepb" data-src="<?= $src; ?>"> -->
    <img class="picture-image" src="/img/core/post_template.png" data-src="<?= $src; ?>" alt="<?= $alt; ?>">
</picture>