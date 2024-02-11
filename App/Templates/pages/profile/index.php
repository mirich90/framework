<?

use App\Functions\FUser;

$this->Component('profile_card', [
    'classes' => 'container',
    'link' => FUser::getLink(),
    'username' => FUser::getUsername(),
    'avatar' => FUser::getAvatar(),
    'info' => FUser::getInfo(),
    'city' => FUser::getCity(),
    'role' => FUser::getRole(),
    'status' => FUser::getStatus(),
    'email' => FUser::getEmail(),
    'is_my' => true
]);
// echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

// $browser = get_browser(null, true);
// print_r($browser);

function getIp()
{
    $keys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'REMOTE_ADDR'
    ];
    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $ip = trim(end(explode(',', $_SERVER[$key])));
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
}

// c('ip:' . getIp());
// echo getenv('USERNAME');
