<?
$this->setCss('ui/card/style');
$this->setCss('components/note/style');
?>

<section class="ui-card notes container">

    <? $this->Component(
        'notes_item',
        array_merge($this->note, $this->category, ['is_breadcrumbs' => true])
    ); ?>

</section>