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
    <!-- <div class="center">
  <div class="preloader"></div>
</div> -->

    <section id="content">
      <?= $this->content; ?>
    </section>

    <!-- <? $this->Component('footer'); ?> -->
  </main>


</body>

</html>