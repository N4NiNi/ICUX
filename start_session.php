<?php
// start_session.php
session_start();
$_SESSION['session_id'] = session_id();
echo session_id();
?>