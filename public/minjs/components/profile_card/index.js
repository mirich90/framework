(function () {
  $click(".biocard-qr-btn", (e) => {
    console.log(e);
    const modal = $id("biocard-modal");
    $classToggle(modal, "open");
  });
})();
