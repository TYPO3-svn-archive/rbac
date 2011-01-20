<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Pi1',
	array(
		'Admin' => 'index, actionList, domainList, userList, extensionList, objectList, privilegeList, roleList, editUser, addRoleToUser, removeRoleFromUser'
	),
	array(
		'Admin' => 'index, actionList, domainList, userList, extensionList, objectList, privilegeList, roleList, editUser, addRoleToUser, removeRoleFromUser'
	)
);

?>