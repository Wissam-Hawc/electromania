<?php
if($_SESSION['isloggedin']!=1 || $_SESSION['role_id']!=1){
    header("Location:../index.php");
}
else{
?>

<footer class="footer pt-5">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
        </div>
    </div>
</footer>
</main>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="assets/js/plugins/smooth-scrollbar.min.js"></script>

<!-- alertify js -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
    <?php if (isset($_SESSION['message'])) { ?>
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('<?= $_SESSION["message"]; ?>');
    <?php
        unset($_SESSION['message']);
    } ?>
        <?php if (isset($_SESSION['message2'])) { ?>
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('<?= $_SESSION["message2"]; ?>');
    <?php
        unset($_SESSION['message2']);
    } ?>
</script>
</body>

</html>
<?php } ?>