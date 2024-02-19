<?
$this->setCss('ui/card/style');
$this->setCss('components/profile_card/style');
$this->setJs('components/profile_card/index');

$classes = props($props, 'classes');
$is_my = props($props, 'is_my');
$is_state = props($props, 'is_state', false);
$user = props($props, 'user');
$count_notes = props($props, 'count_notes', 0);
$count_images = props($props, 'count_images', 0);

if ($user["role"] == 0) $user["role"] = 'Пользователь';
if ($user["status"] == 0) $user["status"] = 'Активный';
if ($user["city"] === '') $user["city"] = '-';
if ($user["info"] === '') $user["info"] = '-';
if ($user["username"] === '') $user["username"] = '-';
$avatar = ($user["avatar_url"])  ? "/img/load/webp/{$user["avatar_url"]}.webp" : env('images')['avatar'];
?>

<section class="ui-card biocard <?= $classes; ?>">

    <div class="biocard-avatar">
        <? $this->Ui(
            'image',
            [
                'src' => $avatar,
                'alt' => $user["username"],
            ]
        ); ?>
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

    <? if ($is_state) : ?>

        <ul class="stats">
            <li>
                <h3><?= $count_images; ?></h3>
                <h4>Картинок</h4>
            </li>
            <li>
                <h3><?= $count_notes; ?></h3>
                <h4>Заметок</h4>
            </li>

        </ul>

    <? endif; ?>

    <div class="links">
        <? if ($is_my) : ?>
            <? $this->Ui(
                'button',
                [
                    'text' => "Редактировать профиль",
                    'href' => "/profile?update&id=" . $user["link"],
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