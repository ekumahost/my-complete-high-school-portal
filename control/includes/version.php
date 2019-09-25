<?php

// no direct access
defined( '_VALID' ) or die( 'Restricted access' );


class kasVersion {
	/** @var string Product */
	var $PRODUCT 	= 'kasTech School Portal App';
	var $RELEASE 	= '2.1.8';
	var $DEV_STATUS = 'Stable';
	var $DEV_LEVEL 	= '01';
	var $BUILD	 	= '001';
	var $CODENAME 	= 'kasCodex';
	var $RELDATE 	= '2014-12-10';
	var $RELTIME 	= '12:00';
	var $RELTZ 		= 'UTC';
	var $COPYRIGHT 	= "Copyright (C) 2010 - 2017 kasTech Software foundation. All rights reserved.";
	var $URL 		= 'KAS - Student Management System';
	/** @var string Whether site is a production = 1 or demo site = 0: 1 is default */
	var $SITE 		= 1;
	/** @var string Whether site has restricted functionality mostly used for demo sites: 0 is default */
	var $RESTRICT	= 0;
	/** @var string Whether site is still in testing phase (disables checks for /installation file) - should be set to 0 for package release: 0 is default */
	var $SVN		= 0;

	
	/**
	 * @return string Long format version
	 */
	function getLongVersion() {
		return $this->PRODUCT .' '. $this->RELEASE .'.'. $this->DEV_LEVEL .' '
			. $this->DEV_STATUS
			.' [ '.$this->CODENAME .' ] '. $this->RELDATE .' '
			. $this->RELTIME .' '. $this->RELTZ;
	}

	/**
	 * @return string Short version format
	 */
	function getShortVersion() {
		return $this->RELEASE .'.'. $this->DEV_LEVEL;
	}

	/**
	 * @return string Version suffix for help files
	 */
	function getHelpVersion() {
		if ($this->RELEASE > '1.0') {
			return '.' . str_replace( '.', '', $this->RELEASE );
		} else {
			return '';
		}
	}
}
$_VERSION = new kasVersion();

$version = $_VERSION->PRODUCT .' '. $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL .' '
. $_VERSION->DEV_STATUS
.' [ '.$_VERSION->CODENAME .' ] '. $_VERSION->RELDATE .' '
. $_VERSION->RELTIME .' '. $_VERSION->RELTZ;

$release = $_VERSION->RELEASE;
$reldate = $_VERSION->RELDATE;

?>