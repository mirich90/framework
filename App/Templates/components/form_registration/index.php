<?
$this->setJs('components/form_registration/index');
?>

<form id="form" action="/registration?index&submit" method="post">
    <? $this->Ui(
        'input',
        ['id' => 'email', 'type' => 'text', 'text' => 'e-mail (электронный адрес)', 'label' => 'E-mail', 'placeholder' => 'Введите e-mail (электронный адрес)', 'value' => 'cvb@cvb.cvb']
    ); ?>

    <? $this->Ui(
        'input',
        ['id' => 'password', 'type' => 'password', 'text' => 'Пароль', 'label' => 'Пароль', 'placeholder' => 'Введите пароль', 'value' => 'cvbcvb']
    ); ?>

    <? $this->Ui(
        'input',
        ['id' => 'password2', 'type' => 'password', 'text' => 'Повторите пароль', 'label' => 'Повторите пароль', 'placeholder' => 'Введите пароль еще раз', 'value' => 'cvbcvb']
    ); ?>

    <? $this->Ui(
        'input',
        ['id' => 'fp_1', 'type' => 'hidden']
    ); ?>

    <? $this->Ui(
        'input',
        ['id' => 'fp_2', 'type' => 'hidden']
    ); ?>

    <fieldset class="sign-up__input sign-up__input--horizontal">

        <? $this->Ui(
            'button',
            [
                'text' => "Зарегистрироваться",
                'color' => 'primary',
                'type' => 'submit',
                'flat' => true,
                'transparent' => true
            ]
        ); ?>

        <? $this->Ui(
            'button',
            [
                'text' => "уже зарегистрированы? Войти",
                'href' => '/login',
                'transparent' => true
            ]
        ); ?>
    </fieldset>

</form>