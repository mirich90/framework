<? $this->setCss('ui/button/style'); ?>

<?
$text = props($props, 'text');
$type = props($props, 'type'); // button OR submit OR a
$color = props($props, 'color');
$flat = props($props, 'flat', '', 'flat');
$action = props($props, 'action', null);
$transparent = props($props, 'transparent', '', 'transparent');
$tag = props($props, 'href', 'button', 'a');
$href =  props($props, 'href');
$icon =  props($props, 'icon', null);
$classes =  props($props, 'classes', '');
$class = "btn $classes $transparent $color $flat";
if ($icon) $class .= ' btn-icon';
if ($action) $action = "data-action='$action'";

?>

<? if ($type === 'submit') : ?>

    <div class="input_wrapper">
        <input type="submit" class="<?= $class; ?>" value="<?= $text; ?>" />
    </div>

<? elseif ($type === 'a' || $href !== '') : ?>

    <a href="<?= $href; ?>" class="<?= $class; ?>">
        <? if ($icon) : ?>
            <i class="material-icons"> <?= $icon; ?> </i>
        <? endif ?>

        <?= $text; ?>
    </a>

<? else : ?>

    <button type="button" class="<?= $class; ?>" <?= $action; ?>>

        <? if ($icon) : ?>
            <i class="material-icons"> <?= $icon; ?> </i>
        <? endif ?>

        <?= $text; ?>
    </button>

<? endif ?>