// универсальная функция - постаивть лайк, добавить в закладки
(function () {
  $change("#file_image", (event) => {
    onChangeImage(event);
  });
  $click(".file_image_preview_wrapper .icon", () => {
    removeImg();
  });

  $click("#paste", async (e) => {
    console.log(new Event("paste"));

    // await navigator.clipboard.writeText('text to clipboard')
    // e.target.dispatchEvent(new Event("paste", { bubbles: true }));
  });

  $paste("#paste", (e) => {
    onPasteImg(e);
  });

  async function onChangeImage(event) {
    const file = event.target.files[0];
    loadImage(file);
  }

  async function loadImage(file) {
    let reader = new FileReader();
    reader.onload = (eventReader) => {
      if (reader.readyState === FileReader.DONE) {
        const preview = $id("file_image_preview-image");
        const icon = $(".file_image_wrapper .icon");
        const wrapperInput = $(".file_image_input_wrapper");

        wrapperInput.setAttribute("hidden", true);
        preview.setAttribute("src", eventReader.target.result);
        preview.removeAttribute("hidden");
        icon.classList.remove("hide");
      }
    };
    reader.readAsDataURL(file);
  }

  async function removeImg() {
    const wrapperInput = $(".file_image_input_wrapper");
    const preview = $id("file_image_preview-image");
    const icon = $(".file_image_wrapper .icon");
    const img = $("#file_image");

    icon.classList.add("hide");
    img.value = null;
    preview.setAttribute("hidden", true);
    wrapperInput.removeAttribute("hidden");
    preview.setAttribute("src", "");
  }

  function onPasteImg(e) {
    console.log(e);
    let img = (e?.originalEvent || e).clipboardData.files;
    if (img.length) {
      const file = img[0];
      loadImage(file);
    } else {
      console.log("В буфере пусто или не картинка");
    }
  }
})();
