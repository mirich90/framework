<?
$this->setCss('components/nav/style');
$this->setJs('components/nav/index');

$name_site = env('name_site');
$uri = getUri();

$navs = [
    ['link' => '', 'text' => 'Главная'],
    ['link' => 'article', 'text' => 'Статьи'],
    ['link' => 'game', 'text' => 'Игры'],
    ['link' => 'image', 'text' => 'Графика'],
    ['link' => 'code', 'text' => 'Код'],
    ['link' => 'music', 'text' => 'Музыка'],
    ['link' => 'text', 'text' => 'Текст'],
    ['link' => 'note', 'text' => 'Заметки'],
    ['link' => 'setting', 'text' => 'Настройки'],
    ['link' => 'profile', 'text' => 'Профиль'],
    ['link' => 'logout?submit', 'text' => 'Выйти'],
];
?>

<nav class="main-menu">
    <a href="/">
        <h1><?= $name_site; ?></h1>
    </a>

    <ul>
        <? foreach ($navs as $nav) {
            $active = $uri === $nav['link'];
            $this->Component(
                'nav_item',
                array_merge($nav, ['active' => $active])
            );
        } ?>

    </ul>
</nav>