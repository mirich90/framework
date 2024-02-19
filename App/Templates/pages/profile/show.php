<?

use App\Functions\FUser;

$this->Component('profile_card', [
    'classes' => 'container',
    'user' => $this->user,
    'count_notes' => $this->count_notes,
    'count_images' => $this->count_images,
    'is_qr' => true,
    'is_edit' => true,
    'is_state' => true,
    'is_my' => $this->user['id'] == FUser::getId()
]);
