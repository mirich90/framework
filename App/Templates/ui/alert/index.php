<?

use App\Functions\FUser;

$this->setCss('ui/alert/style');
$this->setJs('ui/alert/index');
?>

<?
// setcookie("refreshToken", "", time() - 3600);
var_dump($_COOKIE);
c(FUser::getUser());
?>

<div class="alert">
</div>