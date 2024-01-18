<?php
// show toast message
if (isset($_SESSION['toastMessage'])) {
    $message = $_SESSION['toastMessage'];
    print_r($message);
    $type = $message['type'];
    $msg = $message['msg'];
    $duration = $message['duration'];
    showTostMessaage($msg, $type, $duration);
    unset($_SESSION['toastMessage']);
}    
?>
</body>

</html>