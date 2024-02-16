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
$id = props($props, 'id', null);
$hidden = props($props, 'hidden', '', 'hidden="true"');
$small = props($props, 'small', '', 'small');

$picture_id = '';
$image_id = '';

if ($id) {
    $picture_id = "id='$id'";
    $image_id = "id='$id-image'";
}
// $flat = (isset($props['flat'])) ? 'flat' : '';
// $tag = (isset($props['href'])) ? "a" : 'button';
// $href = (isset($props['href'])) ? "href='{$props['href']}'" : '';
?>

<picture <?= $picture_id; ?> class="picture">
    <!-- <source class="picture-image" type="image/webp" srcset="/img/core/post_template.wepb" data-src="<?= $src; ?>"> -->
    <img loading="lazy" <?= $image_id; ?> class="picture-image <?= $small; ?>" <?= $hidden; ?> src="<?= $src; ?>" alt="<?= $alt; ?>">
</picture>