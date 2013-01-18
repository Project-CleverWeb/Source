<?php

/**
 * This file needs a remodel, but will do for now
 */

/** Environment Constants **/
_define('TODAY', date('D M j Y'));
_define('TIMEZONE','America/Edmonton'); // Timezone
_define('USE_SUBDOMAINS',false);


/** Site Constants **/
_define('SITE_URL','192.168.0.194/~projects/CleverWeb2.0/'); // Must have trailing '/'
_define('SITE_HOST', '192.168.0.194');
_define('SITE_AUTHOR', 'Nicholas Jordan');
_define('SITE_CONTACT', 'admin@projcleverweb.com');
_define('SITE_ICON', 'images/favicon.png');

/**	CleverWeb Version Info	**/
_define('CW_VERSION_NUM','0.01');
_define('CW_VERSION_NAME', 'pre-alpha');
_define('POWERED_BY', 'CleverWeb');
_define('SITE_NAME_LONG', 'Project CleverWeb '.CW_VERSION_NUM.' '.CW_VERSION_NAME);
_define('SITE_NAME_SHORT', 'CW '.CW_VERSION_NUM);

/** Copyright Info **/
$_copyright_year = 2011;
if((int)date('Y') !== $_copyright_year){
	$_copyright_year = $_copyright_year . '-' . date('Y');
}
_define('COPYRIGHT_YEAR', $_copyright_year);
_define('COPYRIGHT_NAME', 'Nicholas Jordon');

/**	Site HTML Head Constants	**/
_define('HH_GENERATOR', POWERED_BY . ' v' . CW_VERSION_NUM . ' ' . CW_VERSION_NAME);
_define('HH_AUTHOR', POWERED_BY . ' | ' . SITE_AUTHOR);
_define('HH_CONTACT', SITE_CONTACT);
_define('HH_LANGUAGE','en');
_define('HH_GOOGLEBOT', 'noarchive');
_define('HH_COPYRIGHT', COPYRIGHT_NAME);

/**	Page Defaults	**/
_define('PAGE_DESCRIPTION','CleverWeb is a clever yet easy way to build and manage your own site. From forums, to profiles, to blogs, CleverWeb does it all.');
_define('PAGE_KEYWORDS','CleverWeb, Project, Nicholas, Jordon, Blog, WordPress, vBulletin');
_define('PAGE_LANG','en');
_define('PAGE_SUBJECT','CleverWeb');
_define('PAGE_ROBOTS', 'All,NOYDIR,NOODP');
_define('PAGE_GOOGLEBOT','');
_define('PAGE_NO_EMAIL_COLLECTION','all email collection is forbidden');
_define('PAGE_REVISIT_AFTER','2 days');


/**	SMTP Mailling Info	**/
_define('USE_SMTP',true, false);

