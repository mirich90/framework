(function () {
  $click(".biocard-avatar", (e) => {
    console.log(e);
    const modal = $id("biocard-modal");
    $classToggle(modal, "open");
  });
})();
