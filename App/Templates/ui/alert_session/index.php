<?
$this->setCss('ui/alert_session/style');
?>

<?
$request = (isset($_SESSION['request'])) ? json_decode($_SESSION['request']) : null;
$class = "status-success";
if ($request && $request->status !== 200) {
    $class = "status-danger";
}
?>

<?php if ($request && getControllerName() === $request->class) : ?>
    <div class="alert <?= $class; ?>">
        <p>
            <?
            echo $request->message;
            unset($_SESSION['request']);
            ?>
        </p>
    </div>
<?php endif; ?>