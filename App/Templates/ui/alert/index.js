// универсальная функция - постаивть лайк, добавить в закладки
class AlertMessage {
  constructor(message = "", status = 200) {
    this.message = message;
    this.status = status;
    this.show();
  }

  show() {
    this.createP();
    if (this.status === 200) {
      $(".alert").classList.add("status-success");
      $(".alert").classList.remove("status-danger");
    } else {
      $(".alert").classList.remove("status-success");
      $(".alert").classList.add("status-danger");
    }
  }

  createP() {
    $(".alert").innerHTML = "";
    let p = document.createElement("p");
    p.innerHTML = this.message;
    $(".alert").append(p);
  }
}
