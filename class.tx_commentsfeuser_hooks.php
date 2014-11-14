<?php

/**
 *  Copyright notice
 *
 *  (c) 2009 Soren Malling (soren.malling@gmail.com)
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * class.tx_commentsfeuser_hooks.php
 * 
 * Commenting system feuser extension
 * Connecting comments extension to fe_users table using a hook.
 * 
 * (c) 2008 Martin Weissen <martin@weissen.li>
 * (c) 2009-2012 Soren Malling <soren.malling@gmail.com>
 */

class tx_commentsfeuser_hooks {
        function processSubmission($params) {
		$params['record']['tx_commentsfeuser_feuser'] = $GLOBALS['TSFE']->fe_user->user['uid'];

		return $params['record'];
	}
	
	function form($params) {
		$params['markers']['###USERNAME###'] = $GLOBALS['TSFE']->fe_user->user['username'];
		return $params['markers'];
	}

	function comments_getComments($params) {
		$resultComment = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'tx_commentsfeuser_feuser',
			'tx_comments_comments',
			'uid='.$params['row']['uid']
			#'',
			#'',
			#''
		);

		if (!array_key_exists(0, $resultComment) ||
		    !array_key_exists('tx_commentsfeuser_feuser', $resultComment[0])) {
			// early return of default value
			return $params['markers'];
		}

		$resultFeuser = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'*',
			'fe_users',
			'uid='.$resultComment[0]['tx_commentsfeuser_feuser']
			#'',
			#'',
			#''
		);
		if (array_key_exists(0, $resultFeuser) && array_key_exists('username', $resultFeuser[0])) {
			foreach($resultFeuser[0] as $key=>$value) {
				$params['markers']['###FEUSER_' . strtoupper($key) . '###'] = $params['pObj']->applyStdWrap($resultFeuser[0][$key], 'feuser_' . $key . '_stdWrap');
			}
		}
		
		return $params['markers'];
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/comments_feuser/class.tx_commentsfeuser_hooks.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/comments_feuser/class.tx_commentsfeuser_hooks.php']);
}

?>
