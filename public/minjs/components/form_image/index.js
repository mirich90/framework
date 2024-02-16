(function () {
  $submit($id("form_image_load"), async (e) => {
    e.preventDefault();

    const preview = this.$id("file_image_preview-image");
    const imageFile = preview.getAttribute("src");
    const title = $("#title");

    if (imageFile === "" || title.value === "") {
      return new AlertMessage(
        "Загрузка картинки невозможна. Загрузите картинку и добавьте название изображения.",
        400
      );
    }

    try {
      let h = new Headers();
      let fd = new FormData($id("form_image_load"));
      fd.append("file", imageFile);

      let req = new Request(`/image?create&submit`, {
        method: "POST",
        cache: "no-cache",
        headers: h,
        body: fd,
      });

      await fetch(req)
        .then((res) => res.json())
        .then((commit) => {
          if (commit.status === 200) {
            const wrapperInput = $(".file_image_input_wrapper");
            const icon = $(".file_image_wrapper .icon");
            const img = $("#file_image");

            icon.classList.add("hide");
            img.value = null;
            title.value = "";
            preview.setAttribute("hidden", true);
            wrapperInput.removeAttribute("hidden");
            preview.setAttribute("src", "");
            new AlertMessage(commit.message, commit.status);
          } else {
            new AlertMessage(commit.message, commit.status);
          }
          console.log(commit);
        });
    } catch (error) {
      new AlertMessage(error, 500);
    }
  });

  function decode(obj) {
    const stringify = JSON.stringify(obj);
    return btoa(stringify);
  }
})();
