<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');
$tempColumns = Array (
	"tx_commentsfeuser_feuser" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:comments_feuser/locallang_db.xml:tx_comments_comments.tx_commentsfeuser_feuser",		
		"config" => Array (
			"type" => "group",	
			"internal_type" => "db",	
			"allowed" => "fe_users",	
			"size" => 1,	
			"minitems" => 0,
			"maxitems" => 1,	
		)
	),
);

t3lib_div::loadTCA("tx_comments_comments");
t3lib_extMgm::addTCAcolumns("tx_comments_comments",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("tx_comments_comments","tx_commentsfeuser_feuser;;;;1-1-1");

# Firstname should not be required as we are now expecting a frontend user record
$TCA['tx_comments_comments']['columns']['firstname']['config']['eval'] = 'trim';
?>
