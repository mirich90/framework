<?
$this->setCss('components/nav/style');
$this->setJs('components/nav/index');

$name_site = (include d('/.env.php'))['name_site'];
$uri = getUri();

$navs = [
    ['link' => '', 'text' => 'Главная'],
    ['link' => 'profile', 'text' => 'Профиль'],
    ['link' => 'post', 'text' => 'Статьи'],
    ['link' => 'game', 'text' => 'Игры'],
    ['link' => 'image', 'text' => 'Графика'],
    ['link' => 'code', 'text' => 'Код'],
    ['link' => 'music', 'text' => 'Музыка'],
    ['link' => 'text', 'text' => 'Текст'],
    ['link' => 'note', 'text' => 'Заметки'],
    ['link' => 'setting', 'text' => 'Настройки'],
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