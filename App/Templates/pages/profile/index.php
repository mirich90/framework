<? $this->Component('profile_card', [
    'classes' => 'container',
    'link' => $this->user['link'],
    'username' => $this->user['username'],
    'avatar' => $this->user['avatar'],
    'info' => $this->user['info'],
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
