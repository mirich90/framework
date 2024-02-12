<?
$this->setCss('ui/icon/style');
$this->setJs('ui/icon/index');
?>

<?
$label = props($props, 'label');
$icon = props($props, 'icon');
$active = props($props, 'active', 'noactive', '');
$click = props($props, 'click');
$id = props($props, 'id');
$table = props($props, 'table');
$href = props($props, 'href');
$action = props($props, 'action');
?>

<? if ($href) : ?>
    <a href="<?= $href; ?>" class="icon action <?= $active; ?>">
        <p> <?= $label; ?></p>
        <i class="material-icons"> <?= $icon; ?> </i>
    </a>
<? else : ?>
    <div class="icon action <?= $active; ?>" data-id="<?= $id; ?>" data-table="<?= $table; ?>" data-action="<?= $action; ?>">
        <p> <?= $label; ?></p>
        <i class="material-icons"> <?= $icon; ?> </i>
    </div>
<? endif; ?>