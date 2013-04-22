#This will contain the style guide#

Short Version:

* Tabs not spaces
* recommended tab width: 2
* Underscores not CamelCase
* ALL file names must use [a-z0-9_-] NO uppercase letters
* classes with dedicated files must use "&gt;class-name&lt;.class.php"
* comment blocks have a 100 character soft-limit
* when including/requiring files, path must be absolute
* When handling paths (other than URLs) you must always use DS
* Use of [GOTO](http://php.net/manual/en/control-structures.goto.php) is allowed, **HOWEVER** the destination of GOTO must be in the same file and marked with a comment. NO EXCEPTIONS.
* There is a soft-length-limit on file sizes. Any file over 1,000 lines long should be split into another file. This is not a requirement.