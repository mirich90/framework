<?

namespace App\Controllers\Profile;

use App\Core\Controller;
use App\Db;
use App\Functions\FUser;

class profile extends Controller
{

    protected function construct()
    {
    }

    protected function getUserSecret($usersInfo)
    {
        $UsersSecretData = new \App\Models\UsersSecretData();
        return $UsersSecretData->selectOne(
            ['email', 'id'],
            ['id' => $usersInfo['user_id']]
        );
    }

    protected function getUsersInfo($id = null)
    {
        $paramId = (isset($_GET['id'])) ? $_GET['id'] : FUser::getLink();
        $user = ($id) ? ['user_id' => $id] : ['link' => $paramId];
        $UsersInfo = new \App\Models\UsersInfo();
        $usersInfo = $UsersInfo->selectOne(
            ['link',  'city', 'username', 'info', 'user_id', 'role', 'status', 'avatar', 'datetime'],
            $user
        );
        $usersInfo = $UsersInfo->addUrlAvatar($usersInfo);
        return $usersInfo;
    }

    protected function title()
    {
        return "Indyground";
    }

    protected function description()
    {
        return "Indyground - сайт о создателях игр, музыки, графики и всего осталнього творчества";
    }

    protected function keywords()
    {
        return "Indyground, инди, RPG maker";
    }

    protected function author()
    {
        return "Yuryol";
    }
}
