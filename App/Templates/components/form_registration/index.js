(function () {
  $submit("#form", (e) => {
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

      $id("form").submit();
      return true;
    } catch (error) {
      console.log("ОШИБКА: ", error);
      return false;
    }
  });

  function decode(obj) {
    const stringify = JSON.stringify(obj);
    return btoa(stringify);
  }
})();
