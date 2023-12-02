<?
$this->setCss('reset');
$this->setCss('fonts');
$this->setCss('root');
$this->setCss('style');
?>

<body>
  <div class="progress-container">
    <div class="progress-bar" id="myBar" style="width: 0%;"> </div>
  </div>
  <main>
    <? $this->Component('nav') ?>

    <section id="content">
      <?= $this->content; ?>
    </section>
  </main>

  <? $this->Component(
    'options'
  ); ?>

</body>

</html>