<? $this->setCss('components/home/style'); ?>
<? $this->setCss('ui/card/style'); ?>

<section class="container container-lg ui-card ui-card-style-primary_g ui-card-right home">
  <div class="home-description">
    <h1 class="home-title">
      <span class="home-gradient-text">MY_SITE</span> - сайт для индюков
    </h1>
    <p class="home-paragraph">
      Портфолио, интервью и разговоры о творчестве. Статьи и уроки о разработке игр, написании музыки, моделлировании в 3d и многому другом.
    </p>
    <form id="home-form" autocomplete="off">
      <input type="email" id="email-id" name="email_address" aria-label="email adress" placeholder="" required oninput="checkEmpty()" />
      <button type="submit" class="home-btn" aria-label="submit">
        <span>Подписаться</span>
        <ion-icon name="arrow-forward-outline"></ion-icon>
      </button>
    </form>
  </div>

  <div class="home-users-color-container">
    <a href="/" class="home-item" style="--i: 1">
      <p>Игры</p>
    </a>

    <a href="/" class="home-item" style="--i: 1">
      <img class="home-item-img" src="/img/core/post_template.png" data-src="/img/users/098098/2.jpg" style="--i: 2" alt="" />
    </a>

    <a href="/" class="home-item" style="--i: 3">
      <p>Графика</p>
    </a>

    <a href="/" class="home-item" style="--i: 1">
      <img class="home-item-img" src="/img/core/post_template.png" data-src="/img/users/098098/1.jpg" style="--i: 4" alt="" />
    </a>

    <a href="/" class="home-item" style="--i: 1">
      <img class="home-item-img" src="/img/core/post_template.png" data-src="/img/users/098098/3.jpg" style="--i: 10" alt="" />
    </a>

    <a href="/" class="home-item" style="--i: 11">
      <p>Код</p>
    </a>

    <a href="/" class="home-item" style="--i: 1">
      <img class="home-item-img" src="/img/core/post_template.png" data-src="/img/users/098098/7.jpg" style="--i: 12" alt="" />
    </a>

    <a href="/" class="home-item" style="--i: 5">
      <p>Уроки</p>
    </a>

    <a href="/" class="home-item" style="--i: 9">
      <p>Музыка</p>
    </a>

    <a href="/" class="home-item" style="--i: 1">
      <img class="home-item-img" src="/img/core/post_template.png" data-src="/img/users/098098/8.jpg" style="--i: 8" alt="" />
    </a>

    <a href="/" class="home-item" style="--i: 7">
      <p>Текст</p>
    </a>

    <a href="/" class="home-item" style="--i: 1">
      <img class="home-item-img" src="/img/core/post_template.png" data-src="/img/users/098098/9.jpg" style="--i: 6" alt="" />
    </a>
  </div>
</section>