<?
$this->setCss('ui/icon/style');
$this->setJs('ui/icon/index');

$label = props($props, 'label');
$icon = props($props, 'icon');
$active = props($props, 'active', 'noactive', ' ');
$id = props($props, 'id');
$table = props($props, 'table');
$href = props($props, 'href');
$dropdown = props($props, 'dropdown');
$small = props($props, 'small', '', 'small');

$action = props($props, 'action', null);
$actionDataset = '';
if ($action) {
    $actionDataset = "data-action='$action'";
}
?>

<? if ($href) : ?>
    <a href="<?= $href; ?>" class="icon action <?= $active; ?>">
        <p> <?= $label; ?></p>
        <i class="material-icons <?= $small; ?>"> <?= $icon; ?> </i>
    </a>
<? else : ?>
    <div class="icon action <?= $active; ?>" data-id="<?= $id; ?>" data-table="<?= $table; ?>" <?= $actionDataset; ?>>
        <? if ($action === 'dropdown') : ?>
            <i class="material-icons <?= $small; ?>"> <?= $icon; ?> </i>
            <? $this->Ui(
                'dropdown',
                ['dropdown' => $dropdown]
            ); ?>
        <? else : ?>
            <p> <?= $label; ?></p>
            <i class="material-icons <?= $small; ?>"> <?= $icon; ?> </i>
        <? endif; ?>
    </div>
<? endif; ?>