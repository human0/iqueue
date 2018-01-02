<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('LIB_PATH') ? null : define('LIB_PATH', 'components'.DS.'php');

require_once(LIB_PATH.DS.'config.php');

require_once("components/php/PHPMailer/class.phpmailer.php");
require_once("components/php/PHPMailer/class.smtp.php");
require_once("components/php/PHPMailer/language/phpmailer.lang-uk.php");

require_once(LIB_PATH.DS.'functions.php');

require_once(LIB_PATH.DS.'object-session.php');
require_once(LIB_PATH.DS.'object-database.php');

require_once(LIB_PATH.DS.'class-list.php');
require_once(LIB_PATH.DS.'class-user.php');
require_once(LIB_PATH.DS.'class-task.php');
require_once(LIB_PATH.DS.'class-application.php');
require_once(LIB_PATH.DS.'class-gadget.php');
require_once(LIB_PATH.DS.'class-comment.php');
require_once(LIB_PATH.DS.'class-notification.php');

require_once(LIB_PATH.DS.'actions.php'); 
?>