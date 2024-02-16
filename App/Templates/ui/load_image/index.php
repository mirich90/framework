<?
$this->setCss('ui/load_image/style');
$this->setJs('ui/load_image/index');

?>

<div class="file_image_wrapper">

    <div class="file_image_input_wrapper">
        <? $this->Ui(
            'input',
            ['id' => 'paste', 'type' => 'text', 'label' => 'Выберите картинку', 'placeholder' => 'Вставьте через буфер обмена']
        ); ?>

        <p>ИЛИ</p>

        <? $this->Ui(
            'input',
            ['id' => 'file_image', 'type' => 'file', 'placeholder' => 'Нажмите, чтобы выбрать файл']
        ); ?>


    </div>

    <div class="file_image_preview_wrapper">
        <? $this->Ui(
            'image',
            [
                'id' => 'file_image_preview',
                'alt' => 'Здесь будет картинка',
                'small' => true,
                'hidden' => true,
            ]
        ); ?>

        <? $this->Ui(
            'icon',
            [
                'icon' => "close",
                'active' => false,
                'id' => 1,
                'action' => '',
                'hidden' => true,
            ]
        ); ?>
    </div>
</div>