<? $this->setCss('ui/input/style'); ?>


<?
$id = props($props, 'id');
$type = props($props, 'type', 'text');
$value = props($props, 'value');
$label = props($props, 'label');
$placeholder = props($props, 'placeholder');
$hidden = ($type === 'hidden') ? 'hidden' : '';
?>

<fieldset class="ui-input-fieldset" <?= $hidden; ?>>

    <label class="ui-input-label" for="<?= $id; ?>">
        <?= $label; ?>
    </label>

    <? if ($type === 'textarea') : ?>
        <textarea autofocus="" autocomplete="off" name="<?= $id; ?>" id="<?= $id; ?>" placeholder="<?= $placeholder; ?>" class="ui-input-textarea"><?= $value; ?></textarea>
    <? else : ?>
        <input autofocus="" autocomplete="off" type="<?= $type; ?>" name="<?= $id; ?>" id="<?= $id; ?>" value="<?= $value; ?>" placeholder="<?= $placeholder; ?>" class="ui-input-input">
    <? endif ?>

</fieldset>