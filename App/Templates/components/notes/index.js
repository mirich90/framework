(function () {
  $click(".filter-btn", (e) => {
    console.log(e);
    const modal = $id("filter-modal");
    $classToggle(modal, "open");
  });
})();

// async function addAvatar(data, id) {
//   $classDel($id("biocard-modal"), "open");
//   $(".biocard-avatar img").setAttribute(
//     "src",
//     `/img/load/min/${data.link}.webp`
//   );
//   $id("avatar").value = data.id;
//   let h = new Headers();
//   const form = $id("form-profile");
//   let fd = new FormData(form);

//   let req = new Request(`/profile?update&submit&api&id=${id}`, {
//     method: "POST",
//     cache: "no-cache",
//     headers: h,
//     body: fd,
//   });

//   await fetch(req)
//     .then((res) => res.json())
//     .then((commit) => {
//       console.log(commit);
//     });
// }
