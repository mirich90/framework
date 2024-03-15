<?
$this->setJs('components/form_image/index');

$event = props($props, 'event', null);
$id = props($props, 'id', null);
$data_event = ($event) ? "data-event='$event'" : '';
$data_id = ($id) ? "data-id='$id'" : '';
?>

<form id="form_image_load" action="/image?create&submit" method="post" <?= $data_event; ?> <?= $data_id; ?>>
    <? $this->Ui(
        'input',
        ['id' => 'title', 'text' => 'Название', 'label' => 'Название', 'placeholder' => 'Введите название картинки']
    ); ?>


    <? $this->Ui('load_image', []); ?>

    <? $this->Ui(
        'input',
        ['id' => 'is_show', 'type' => 'checkbox', 'label' => 'Видима для всех']
    ); ?>

    <? $this->Ui(
        'input',
        ['id' => 'is_public', 'type' => 'checkbox', 'label' => 'Опубликовать (картинка будет отображаться в новостях)']
    ); ?>

    <fieldset class="row">

        <? $this->Ui(
            'button',
            [
                'text' => "Загрузить картинку",
                'color' => 'primary',
                'type' => 'submit',
                'flat' => true,
                'transparent' => true
            ]
        ); ?>
    </fieldset>

</form>