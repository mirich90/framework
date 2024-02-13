<?

use App\Functions\FUser;

$this->Component('profile_card', [
    'classes' => 'container',
    'user' => $this->user,
    'is_my' => $this->user['id'] == FUser::getId()
]);
