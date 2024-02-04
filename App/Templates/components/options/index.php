<?

use App\Functions\FUser;

$this->setCss('ui/card/style');
$this->setCss('components/options/style');
?>

<div class="options">
    <? if (FUser::getUser()) : ?>
        <? $this->Component('profile_card', [
            'classes' => 'ui-card-right', 'link' => $this->user['link'],
            'username' => $this->user['username'],
            'avatar' => $this->user['avatar'],
            'info' => $this->user['info'],
        ]); ?>
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