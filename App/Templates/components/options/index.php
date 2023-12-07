<?
$this->setCss('ui/card/style');
$this->setCss('components/options/style');
?>

<div class="options">
    <? if (isLogin()) : ?>
        <? $this->Component('profile_card', ['classes' => 'ui-card-right']); ?>
    <? else : ?>
        <div class="ui-card">
            <? $this->Ui(
                'button',
                [
                    'text' => "Войти",
                    'href' => "/login",
                    'color' => 'primary',
                    'flat' => true,
                    'transparent' => true
                ]
            ); ?>
        </div>
    <? endif; ?>
</div>