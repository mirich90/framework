(function () {
  $for(".btn[data-action=dropdown]", (e) => {
    if (e.dataset.hasEvent) return;

    $click(e, (event) => {
      let menu = $elLastChild(e);
      $hideToggle(menu);
      $for(".y-dropdown-menu", (e) => {
        if (e != menu) $hide(e);
      });
    });
    e.dataset.hasEvent = true;
  });
})();
