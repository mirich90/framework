<? $this->setCss('ui/card/style'); ?>
<? $this->setCss('components/profile_card/style'); ?>

<?
$classes = props($props, 'classes');
$is_my = props($props, 'is_my');
$user = props($props, 'user');

if ($user["role"] == 0) $user["role"] = 'Пользователь';
if ($user["status"] == 0) $user["status"] = 'Активный';
if ($user["city"] === '') $user["city"] = '-';
if ($user["info"] === '') $user["info"] = '-';
if (!$user["avatar"]) $user["avatar"] = 'core/ava.png';
?>

<section class="ui-card biocard <?= $classes; ?>">
    <div class="img_biocard">
        <img src="/img/<?= $user["avatar"]; ?>">
    </div>
    <div class="infos">
        <div class="name">
            <h1><?= $user["username"]; ?></h1>
            <h2>@<?= $user["link"]; ?></h2>
        </div>

        <ul class="text">
            <li>
                <span>Город:</span> <?= $user["city"]; ?>
            </li>
            <li>
                <span>О себе:</span> <?= $user["info"]; ?>
            </li>
            <li>
                <span>Эл.почта:</span> <?= $user["email"]; ?>
            </li>
            <li>
                <span>Статус:</span> <?= $user["status"]; ?>
            </li>
            <li>
                <span>Роль:</span> <?= $user["role"]; ?>
            </li>
            <li>
                <span>Дата регистрации:</span> <?= $user["datetime"]; ?>
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
</section>