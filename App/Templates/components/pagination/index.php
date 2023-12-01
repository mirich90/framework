<?
$this->setCss('components/pagination/style');
?>

<nav>
    <ul>
        <? foreach (range(1, $props['count']) as $number) {
            $this->Ui(
                'button',
                [
                    'text' => $number,
                    'href' => "/posts?page={$number}",
                    'color' => 'primary',
                    'flat' => true,
                    'transparent' => true
                ]
            );
        } ?>
    </ul>
</nav>