(function () {
  $submit("#form", async (e) => {
    e.preventDefault();

    try {
      const fp = {
        appVersion: window.navigator.appVersion,
        connection: window.navigator.connection.effectiveType,
        cookieEnabled: window.navigator.cookieEnabled,
        language: window.navigator.language,
        languages: window.navigator.languages,
        platform: window.navigator.platform,
        plugins: window.navigator.plugins,
        userAgent: window.navigator.userAgent,
        vendor: window.navigator.vendor,
        timezone: new Date().getTimezoneOffset(),
      };

      const fp_screen = {
        colorDepth: screen.colorDepth,
        pixelDepth: screen.pixelDepth,
        width: screen.width,
        height: screen.height,
        availLeft: screen.availLeft,
        availWidth: screen.availWidth,
        availTop: screen.availTop,
        availHeight: screen.availHeight,
        isExtended: screen.isExtended,
        orientation: screen.orientation.type,
      };

      $id("fp_1").value = decode(fp);
      $id("fp_2").value = decode(fp_screen);

      let h = new Headers();
      let fd = new FormData($id("form"));

      let req = new Request(`/registration?index&submit`, {
        method: "POST",
        cache: "no-cache",
        headers: h,
        body: fd,
      });

      await fetch(req)
        .then((res) => res.json())
        .then((commit) => {
          if (commit.status === 200) {
            console.log(commit.data.accessToken);
            console.log(commit.data.accessTokenExpiration);
            new AlertMessage(commit.message, commit.status);
          } else {
            new AlertMessage(commit.message, commit.status);
          }
          console.log(commit);
          // document.location.href = "/profile";
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
