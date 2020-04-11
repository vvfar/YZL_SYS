<?php
    session_start();
    session_unset();
    session_destroy();
?>

<meta charset="utf-8">

<script>
    alert("您已退出登陆！");
    window.location.href="../../login.php";
</script>