(function () {
  $click(".biocard-avatar", (e) => {
    console.log(e);
    const modal = $id("biocard-modal");
    $classToggle(modal, "open");
  });
})();

function addAvatar(data) {
  $classDel($id("biocard-modal"), "open");
  $(".biocard-avatar img").setAttribute(
    "src",
    `/img/load/min/${data.link}.webp`
  );
  console.log(data.link);
}
