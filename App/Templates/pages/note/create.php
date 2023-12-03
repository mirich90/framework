<section class="ui-card posts container">


    <? $this->Ui(
        'title_description',
        [
            'text' => '<h1>заметки</h1>',
        ]
    ); ?>

    <? $this->Ui(
        'title',
        [
            'text' => 'Создать заметку',
            'level' => 2,
        ]
    ); ?>

    <form>
        <? $this->Ui(
            'input',
            ['text' => 'Название', 'label' => 'Заголовок', 'placeholder' => 'Введите заголовок заметки']
        ); ?>

        <? $this->Ui(
            'input',
            ['text' => 'Название', 'label' => 'Текст', 'placeholder' => 'Введите текст заметки']
        ); ?>


        <fieldset class="sign-up__input sign-up__input--horizontal">
            <!-- <input type="submit" value="Join" class="sign-up__button"> -->
            <? $this->Ui(
                'button',
                [
                    'text' => "Создать заметку",
                    'href' => "/note?create",
                    'color' => 'primary',
                    'flat' => true,
                    'transparent' => true
                ]
            ); ?>
        </fieldset>

    </form>
</section>