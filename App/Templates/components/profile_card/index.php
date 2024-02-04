<? $this->setCss('ui/card/style'); ?>
<? $this->setCss('components/profile_card/style'); ?>

<?
$classes = props($props, 'classes');
$username = props($props, 'username');
$link = props($props, 'link');
$info = props($props, 'info');
$avatar = props($props, 'avatar', 'core/ava.png');
?>

<section class="ui-card biocard <?= $classes; ?>">
    <div class="img_biocard">
        <img src="/img/<?= $avatar; ?>">
    </div>
    <div class="infos">
        <div class="name">
            <h1><?= $username; ?></h1>
            <h2>@<?= $link; ?></h2>
        </div>
        <p class="text">
            <?= $info; ?>
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