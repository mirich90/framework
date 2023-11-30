<?
// $this->setCss('btn');
// $this->setCss('not_found');
?>

<div class="container center max-height">
  <? $this->Ui(
    'title',
    ['text' => 'Ошибка 404', 'link' => '/', 'level' => 1]
  ); ?>

  <? $this->Ui(
    'title',
    [
      'text' => 'Страница, которую вы ищете, не существует.',
      'link' => '/',
      'level' => 2,
    ]
  ); ?>

  <div class="buttons">

    <? $this->Ui(
      'button',
      ['text' => 'Вернуться на главную', 'href' => "/"]
    ); ?>

    <? $this->Ui(
      'button',
      ['text' => 'Зарегистрироваться', 'href' => "/signup", 'flat' => true, 'color' => 'primary']
    ); ?>


  </div>
</div>