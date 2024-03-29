<?
$this->setCss('ui/input/style');

$id = props($props, 'id');
$type = props($props, 'type', 'text');
$value = props($props, 'value');
$label = props($props, 'label');
$placeholder = props($props, 'placeholder');
$href = props($props, 'href');
$options = props($props, 'options');
$hidden = ($type === 'hidden') ? 'hidden' : '';
?>

<fieldset class="ui-input-fieldset" <?= $hidden; ?>>

    <? if ($type !== 'search' && $type !== 'checkbox') : ?>
        <label class="ui-input-label" for="<?= $id; ?>">
            <?= $label; ?>
        </label>
    <? endif ?>

    <? if ($type === 'textarea') : ?>
        <textarea rows="5" autofocus="" autocomplete="off" name="<?= $id; ?>" id="<?= $id; ?>" placeholder="<?= $placeholder; ?>" class="ui-input-textarea"><?= $value; ?></textarea>

    <? elseif ($type === 'search') : ?>
        <label class="ui-input-label-search" for="<?= $id; ?>">
            <? $this->Ui(
                'icon',
                [
                    'icon' => "search",
                    'href' => $href,
                ]
            ); ?>
        </label>

        <input autofocus="" autocomplete="off" type="<?= $type; ?>" name="<?= $id; ?>" id="<?= $id; ?>" value="<?= $value; ?>" placeholder="<?= $placeholder; ?>" class="ui-input ui-input-search">

    <? elseif ($type === 'select') : ?>
        <select id="<?= $id; ?>" name="<?= $id; ?>" type="<?= $type; ?>" placeholder="<?= $placeholder; ?>" tabindex="0" autofocus="" class="ui-input-select">

            <? foreach ($options as $option) : ?>
                <option value="<?= $option[0]; ?>" <?= ($value == $option[0]) ? 'selected' : '' ?>>
                    <?= $option[1]; ?>
                </option>
            <? endforeach ?>
        </select>

    <? elseif ($type === 'checkbox') : ?>
        <input class="ui-input-checkbox" id="<?= $id; ?>" name="<?= $id; ?>" type="<?= $type; ?>" autofocus="">
        <label class="ui-input-checkbox-label" for="<?= $id; ?>"><?= $label; ?></label>

    <? elseif ($type === 'file') : ?>
        <p class="ui-input-file-wrapper">
            <input autofocus="" autocomplete="off" type="<?= $type; ?>" name="<?= $id; ?>" id="<?= $id; ?>" value="<?= $value; ?>" class="ui-input ui-input-file">
            <?= $placeholder; ?>
        </p>

    <? else : ?>
        <input autofocus="" autocomplete="off" type="<?= $type; ?>" name="<?= $id; ?>" id="<?= $id; ?>" value="<?= $value; ?>" placeholder="<?= $placeholder; ?>" class="ui-input">
    <? endif ?>

</fieldset>