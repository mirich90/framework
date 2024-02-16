<? $this->setCss('ui/button/style'); ?>

<?
$text = props($props, 'text');
$type = props($props, 'type'); // button OR submit OR a
$color = props($props, 'color');
$flat = props($props, 'flat', '', 'flat');
$transparent = props($props, 'transparent', '', 'transparent');
$tag = props($props, 'href', 'button', 'a');
$href =  props($props, 'href');
$icon =  props($props, 'icon', null);
$classes =  props($props, 'classes', '');
$class = "btn $classes $transparent $color $flat";
if ($icon) $class .= ' btn-icon';
?>

<? if ($type === 'submit') : ?>

    <input type="submit" class="<?= $class; ?>" value="<?= $text; ?>" />

<? elseif ($type === 'a' || $href !== '') : ?>

    <a href="<?= $href; ?>" class="<?= $class; ?>">
        <? if ($icon) : ?>
            <i class="material-icons"> <?= $icon; ?> </i>
        <? endif ?>

        <?= $text; ?>
    </a>

<? else : ?>

    <button type="button" class="<?= $class; ?>">

        <? if ($icon) : ?>
            <i class="material-icons"> <?= $icon; ?> </i>
        <? endif ?>

        <?= $text; ?>
    </button>

<? endif ?>