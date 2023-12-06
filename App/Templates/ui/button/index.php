<? $this->setCss('ui/button/style'); ?>

<?
$text = props($props, 'text');
$type = props($props, 'type'); // button OR submit OR a
$color = props($props, 'color');
$flat = props($props, 'flat', '', 'flat');
$transparent = props($props, 'transparent', '', 'transparent');
$tag = props($props, 'href', 'button', 'a');
$href =  props($props, 'href');
$class = "btn $transparent $color $flat";
?>

<? if ($type === 'submit') : ?>

    <input type="submit" class="<?= $class; ?>" value="<?= $text; ?>" />

<? elseif ($type === 'a' || $href !== '') : ?>

    <a href="<?= $href; ?>" class="<?= $class; ?>">
        <?= $text; ?>
    </a>

<? else : ?>

    <button type="button" class="<?= $class; ?>">
        <?= $text; ?>
    </button>

<? endif ?>