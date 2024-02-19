<?
$this->setCss('ui/card/style');
$this->setCss('components/note/style');
?>

<section class="ui-card notes container">

    <? $this->Component(
        'notes_item',
        array_merge(
            $this->note,
            $this->category,
            $this->count_like,
            $this->count_bookmark,
            $this->is_like,
            $this->is_bookmark,
            $this->author,
            ['is_breadcrumbs' => true],
            ['is_menu' => true]
        )
    ); ?>

</section>