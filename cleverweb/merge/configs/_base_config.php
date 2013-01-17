<?php

/** Environment Constants **/
d('ENVIRONMENT','Development'); // (Development|Production)
d('TODAY', date('D M j Y'));
d('TIMEZONE','America/Edmonton'); // Timezone
d('USE_SUBDOMAINS',false);


/** Site Constants **/
d('SITE_NAME_LONG', 'CleverWeb 2.0 - Colin Baylis Proposed Frame Work');
d('SITE_NAME_SHORT', 'CW2');
d('SITE_URL','192.168.0.194/~projects/CleverWeb2.0/'); // Must have trailing '/'
d('SITE_HOST', '192.168.0.194');
d('SITE_AUTHOR', 'Nicholas Jordan');
d('SITE_CONTACT', 'admin@projcleverweb.com');
d('SITE_ICON', 'images/favicon.png');

/**	CleverWeb Version Info	**/
d('CW_VERSION_NUM','0.1');
d('CW_VERSION_NAME', 'pre-alpha');
d('POWERED_BY', 'CleverWeb');

/** Copyright Info **/
$_copyright_year = 2011;
if((int)date('Y') !== $_copyright_year){
	$_copyright_year = $_copyright_year . '-' . date('Y');
}
d('COPYRIGHT_YEAR', $_copyright_year);
d('COPYRIGHT_NAME', 'CleverWeb | '.$author);

/**	Site HTML Head Constants	**/
d('HH_GENERATOR', POWERED_BY . ' v' . CW_VERSION_NUM . ' ' . CW_VERSION_NAME);
d('HH_AUTHOR', POWERED_BY . ' | ' . SITE_AUTHOR);
d('HH_CONTACT', SITE_CONTACT);
d('HH_LANGUAGE','en');
d('HH_GOOGLEBOT', 'noarchive');
d('HH_COPYRIGHT', COPYRIGHT_NAME);

/**	Page Defaults	**/
d('PAGE_DESCRIPTION','CleverWeb is a clever yet easy way to build and manage your own site. From forums, to profiles, to blogs, CleverWeb does it all.');
d('PAGE_KEYWORDS','CleverWeb, Project, Nicholas, Jordon, Blog, WordPress, vBulletin');
d('PAGE_LANG','en');
d('PAGE_SUBJECT','CleverWeb');
d('PAGE_ROBOTS', 'All,NOYDIR,NOODP');
d('PAGE_GOOGLEBOT','');
d('PAGE_NO_EMAIL_COLLECTION','all email collection is forbidden');
d('PAGE_REVISIT_AFTER','2 days');


/** Misc Constants **/
d('PASSWORD_SALT',')(*S(FIH9wef80si()*sfdwj09*(Auds09*DS9su9s9u'); // DO NOT CHANGE THIS ONCE YOU HAVE INPUTTED ANYTHING INTO THE SITE


/**	SMTP Mailling Info	**/
d('USE_SMTP',true, false);


