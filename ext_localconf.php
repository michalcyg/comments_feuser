<?php

if (!defined ('TYPO3_MODE')) die('Access denied.');

# hook
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['comments']['processSubmission']['comments_feuser'] = 'EXT:comments_feuser/class.tx_commentsfeuser_hooks.php:&tx_commentsfeuser_hooks->processSubmission';
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['comments']['comments_getComments']['comments_feuser'] = 'EXT:comments_feuser/class.tx_commentsfeuser_hooks.php:&tx_commentsfeuser_hooks->comments_getComments';
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['comments']['form']['comments_feuser'] = 'EXT:comments_feuser/class.tx_commentsfeuser_hooks.php:&tx_commentsfeuser_hooks->form';

?>
