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
      const wrapperBtn = $("#form_image_load .input_wrapper");
      wrapperBtn.classList.add("loading");

      const form = $id("form_image_load");
      let h = new Headers();
      let fd = new FormData(form);
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
            const event = form.dataset.event;
            const id = form.dataset.id;
            console.log(event);
            if (event) {
              window[event](commit.data, id);
            } else {
              new AlertMessage(commit.message, commit.status);
            }
            const wrapperInput = $(".file_image_input_wrapper");
            const icon = $(".file_image_wrapper .icon");
            const img = $("#file_image");

            icon.classList.add("hide");
            img.value = null;
            title.value = "";
            preview.setAttribute("hidden", true);
            wrapperInput.removeAttribute("hidden");
            preview.setAttribute("src", "");
            wrapperBtn.classList.remove("loading");
          } else {
            new AlertMessage(commit.message, commit.status);
          }
          console.log(commit);
        });
    } catch (error) {
      new AlertMessage(error, 500);
    }
  });
})();
