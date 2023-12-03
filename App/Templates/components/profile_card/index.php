<? $this->setCss('ui/card/style'); ?>
<? $this->setCss('components/profile_card/style'); ?>

<? $classes = props($props, 'classes') ?>

<section class="ui-card biocard <?= $classes; ?>">
    <div class="img_biocard">
        <img src="/img/users/098098/5.jpg">
    </div>
    <div class="infos">
        <div class="name">
            <h1>Den Dionigi</h1>
            <h2>@den.dionigi</h2>
        </div>
        <p class="text">
            I'm a Front End Developer, follow me to be the first
            who see my new work.
        </p>
        <ul class="stats">
            <li>
                <h3>15K</h3>
                <h4>Views</h4>
            </li>
            <li>
                <h3>82</h3>
                <h4>Projects</h4>
            </li>
            <li>
                <h3>1.3M</h3>
                <h4>Followers</h4>
            </li>
        </ul>
        <div class="links">
            <button class="follow">Follow</button>
            <button class="view">View profile</button>
        </div>
    </div>
</section>