<?

use App\Functions\FUser;

$this->Component('profile_card', [
    'classes' => 'container',
    'user' => $this->user,
    'count_notes' => $this->count_notes,
    'count_images' => $this->count_images,
    'is_state' => true,
    'is_my' => $this->user['id'] == FUser::getId()
]);


// function getIp()
// {
//     $keys = [
//         'HTTP_CLIENT_IP',
//         'HTTP_X_FORWARDED_FOR',
//         'REMOTE_ADDR'
//     ];
//     foreach ($keys as $key) {
//         if (!empty($_SERVER[$key])) {
//             $ip = trim(end(explode(',', $_SERVER[$key])));
//             if (filter_var($ip, FILTER_VALIDATE_IP)) {
//                 return $ip;
//             }
//         }
//     }
// }

// c('ip:' . getIp());
// echo getenv('USERNAME');
