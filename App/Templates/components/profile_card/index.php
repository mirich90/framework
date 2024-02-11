<? $this->setCss('ui/card/style'); ?>
<? $this->setCss('components/profile_card/style'); ?>

<?
$classes = props($props, 'classes');
$username = props($props, 'username');
$link = props($props, 'link');
$info = props($props, 'info');
$status = props($props, 'status');
$role = props($props, 'role');
$city = props($props, 'city');
$is_my = props($props, 'is_my');
$datetime = props($props, 'datetime');
$avatar = props($props, 'avatar', 'core/ava.png');

if ($role == 0) $role = 'Пользователь';
if ($status == 0) $status = 'Активный';
if ($city === '') $city = '-';
if ($info === '') $info = '-';
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

        <ul class="text">
            <li>
                <span>Город:</span> <?= $city; ?>
            </li>
            <li>
                <span>Статус:</span> <?= $status; ?>
            </li>
            <li>
                <span>Роль:</span> <?= $role; ?>
            </li>
            <li>
                <span>Дата регистрации:</span> <?= $datetime; ?>
            </li>
            <li>
                <span>О себе:</span> <?= $info; ?>
            </li>
    </div>

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
        <? if ($is_my) : ?>
            <? $this->Ui(
                'button',
                [
                    'text' => "Редактировать профиль",
                    'href' => "/profile?update",
                    'color' => 'primary',
                    'flat' => true,
                    'transparent' => true
                ]
            ); ?>
        <? else : ?>
            <? $this->Ui(
                'button',
                [
                    'text' => "Подписаться",
                    'href' => "/bookmark?create",
                    'color' => 'primary',
                    'flat' => true,
                    'transparent' => true
                ]
            ); ?>
            <? $this->Ui(
                'button',
                [
                    'text' => "Написать личное сообщение",
                    'href' => "/message?create",
                    'color' => 'primary',
                    'flat' => true,
                    'transparent' => true
                ]
            ); ?>
        <? endif; ?>

        <? $this->Ui(
            'button',
            [
                'text' => "Показать qr-код",
                'color' => 'primary',
                'flat' => true,
                'transparent' => true
            ]
        ) ?>
    </div>
    </div>
</section>