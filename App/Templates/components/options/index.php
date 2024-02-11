<?

use App\Functions\FUser;

$this->setCss('ui/card/style');
$this->setCss('components/options/style');
?>

<div class="options">
    <? if (FUser::getUser()) : ?>
        <? $this->Component('profile_card', [
            'classes' => 'container',
            'link' => FUser::getLink(),
            'username' => FUser::getUsername(),
            'avatar' => FUser::getAvatar(),
            'info' => FUser::getInfo(),
            'city' => FUser::getCity(),
            'role' => FUser::getRole(),
            'status' => FUser::getStatus(),
            'email' => FUser::getEmail(),
            'datetime' => FUser::getDatetime(),
            'is_my' => true
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