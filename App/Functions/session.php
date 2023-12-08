<?

function isRole($role)
{
    $user = $_SESSION['user'];
    return isset($user['role']) && $role == $user['role'];
}

function getRole()
{
    $user = $_SESSION['user'];
    $role = (isset($user['role'])) ? $user['role'] : '';
    return $role;
}

function isLogin()
{
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        return isset($user['id']);
    }
    return NULL;
}
