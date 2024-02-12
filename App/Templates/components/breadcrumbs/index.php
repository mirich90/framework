<?

$this->setCss('components/breadcrumbs/style');
$parent_link = lcfirst(getControllerName());
$category_link = "$parent_link?category={$props['link']}";
?>

<ul class="breadcrumbs">
    <li class="breadcrumbs-item">
        <a href="/<?= $parent_link; ?>"><?= $props['parent'] ?> / </a>
    </li>
    <li class="breadcrumbs-item">
        <a href="/<?= $category_link ?>"><?= $props['text'] ?></a>
    </li>
</ul>