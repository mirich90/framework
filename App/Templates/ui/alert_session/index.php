<? $this->setCss('ui/alert_session/style'); ?>

<?
$request = (isset($_SESSION['request'])) ? json_decode($_SESSION['request']) : null;
$class = "status-success";
if ($request && $request->status === 500) {
    $class = "status-danger";
}
?>

<?php if ($request) : ?>
    <div class="alert <?= $class; ?>">
        <?
        echo $request->message;
        unset($_SESSION['request']);
        ?>
    </div>
<?php endif; ?>