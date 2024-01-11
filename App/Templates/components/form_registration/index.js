(function () {
  $submit("#form", (e) => {
    e.preventDefault();

    try {
      const info = {
        navigator: {
          appVersion: window.navigator.appVersion,
          battery: window.navigator.battery,
          connection: window.navigator.connection.effectiveType,
          cookieEnabled: window.navigator.cookieEnabled,
          language: window.navigator.language,
          languages: window.navigator.languages,
          platform: window.navigator.platform,
          plugins: window.navigator.plugins,
          userAgent: window.navigator.userAgent,
          vendor: window.navigator.vendor,
        },
        screen: {
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
        },
      };

      const stringify_info = JSON.stringify(info);
      const decoded_info = btoa(stringify_info);
      $id("fp").value = decoded_info;
      console.log($id("fp").value);
      $id("form").submit();
      return true;
    } catch (error) {
      console.log("ОШИБКА: " + e);
      return false;
    }
  });
})();
