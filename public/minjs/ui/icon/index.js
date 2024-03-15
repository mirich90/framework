// универсальная функция - постаивть лайк, добавить в закладки
(function () {
  $for(".action", (e) => {
    if (e.dataset.hasEvent) return;

    $click(e, (event) => {
      console.log(e);
      let action = e.dataset.action;
      if (!action) return;

      if (action === "dropdown") {
        let menu = $elLastChild(e);
        $hideToggle(menu);
        $for(".y-dropdown-menu", (e) => {
          if (e != menu) $hide(e);
        });
      } else {
        event.stopPropagation();
        let id = e.dataset.id;
        let table = e.dataset.table;
        add(e, id, table, action);
      }
    });

    e.dataset.hasEvent = true;
  });

  async function add(el, id, table = "articles", action = "like", v = 0) {
    let h = new Headers();
    let fd = new FormData();

    fd.append("submit", true);
    fd.append("item_id", id);
    fd.append("name_table", table);
    fd.append("action", action);
    fd.append("state", 1);

    let req = new Request(`/${action}?create&submit`, {
      method: "POST",
      cache: "no-cache",
      headers: h,
      body: fd,
    });

    await fetch(req)
      .then((res) => res.json())
      // .then((res) => res.text())
      .then((commit) => {
        // console.log(commit);
        // console.log("commit:", commit);
        if (commit.status === 401) {
          document.location.href = "/login";
        } else {
          if (action == "raitings") {
            changeStateRaitingAfterAdd(commit, el, id);
          } else {
            changeStateIconAfterAdd(commit, el);
          }
        }
      })
      .catch((err) => {
        console.log("ERROR:", err.message);
      });

    function changeStateIconAfterAdd(commit, el) {
      if (+commit.data.state === 1) el.classList.remove("noactive");
      else el.classList.add("noactive");
      console.log(commit.data);
      el.firstElementChild.innerText = commit.data.count;
    }

    function changeStateRaitingAfterAdd(commit, el, id) {
      Array.from(el.parentElement.children).forEach((e, i) => {
        if (i < commit.data.state) e.classList.remove("noactive");
        else e.classList.add("noactive");
      });

      document.querySelector(`.raiting_${id}`).innerText = commit.data.state;
      document.querySelector(
        `.raiting_count_${id}`
      ).innerText = `(${commit.data.count} РѕС†РµРЅРѕРє, РјРѕСЏ ${commit.data.my})`;
    }
  }
})();
