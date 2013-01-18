# Directory Plans #

**Description :**  
This is what plans have been made for this directory and it's contents. This file gives key details on files that are by default in this directory.  

##Directories##
- **cleverweb** - This directory contains all of the files needed to run CleverWeb. 

##Files##
- **settings.php** - In addition to setting up the server args, this file will attempt to find the *cleverweb core* in a few common places. This file is should be included by */index.php*.
- **index.php** - This file works as the default page for everything, including navigation to sub-directories. Redirecting error pages to this page will allow errors to show correctly though the CleverWeb system. Redirecting the index.php of a "hidden" directory here, results in a fake 404. This file needs to first include the settings.php wherever it is, and then use cleverweb::init( $args ); to start cleverweb.