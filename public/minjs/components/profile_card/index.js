(function () {
  $click(".img_biocard img", (e) => {
    const modal = $id("biocard-modal");
    $classToggle(modal, "open");
  });
})();
