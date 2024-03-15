<?
$this->setCss('ui/button/style');
$this->setJs('ui/button/index');
?>

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
$dropdown = props($props, 'dropdown');
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

    <div class="input_wrapper">
        <a href="<?= $href; ?>" class="<?= $class; ?>">
            <? if ($icon) : ?>
                <i class="material-icons"> <?= $icon; ?> </i>
            <? endif ?>

            <?= $text; ?>
        </a>
    </div>

<? else : ?>

    <button type="button" class="<?= $class; ?>" <?= $action; ?>>

        <? if ($icon) : ?>
            <i class="material-icons"> <?= $icon; ?> </i>
        <? endif ?>

        <?= $text; ?>

        <? if ($dropdown) : ?>
            <? $this->Ui(
                'dropdown',
                ['dropdown' => $dropdown]
            ); ?>
        <? endif ?>
    </button>

<? endif ?>