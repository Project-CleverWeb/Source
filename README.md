# Project CleverWeb Source (codename: CleverWeb) #

**Site :** [projectcleverweb.com](http://projectcleverweb.com)  
**Description :**  
This is the source for the framework of Project CleverWeb.

[![endorse me](https://api.coderwall.com/projectcleverweb/endorsecount.png)](https://coderwall.com/projectcleverweb)  
[![Build Status](https://travis-ci.org/Project-CleverWeb/Source.png?branch=Master)](https://travis-ci.org/Project-CleverWeb/Source)

&nbsp;    

----------

&nbsp;    
##Comparing with other CMS's##
While this project will have many elements that are unique to it, we want to make sure things can be learned quickly and easily. As a start, everything will be bundled into the variable [$_CW](#the-_cw-global-variable) for easy access. At the same time, CleverWeb operates in modules, while some are required, many are able to be dropped or added as needed. This use of modules also allows CleverWeb to dynamically load modules as they are needed; rather than the typical system of "load it regardless." Further more, CleverWeb will be using a [system of scopes](#scopes) to disable/enable various scripts. This keeps things like plugins and themes, from messing with each other.
  



##Updates, Versions & HotFixes##
Most informational aspects (such us the codex or this readme) will be updated as full versions are released. Requests for ETA's on versions or update will be ignored entirely.  
  
Project CleverWeb will be maintained under the Semantic Versioning guidelines appended with a space and then a codename. Codenames are exempt from the Semantic Versioning guidelines, and are not considered a part of the actual version. Codenames are used as a 1 word description of the version and may contain:  
a-zA-Z0-9-_*/\  
  
Releases will use the following format:  
  
`<major>.<minor>.<patch> <codename>`  
  
* **Example 1:** 0.1.0 Pre-Alpha  
* **Example 2:** 13.4.58 Beef-Nugget  
  
Versions will be constructed with the following guidelines:  
  
* Breaking backward compatibility bumps the major (and resets the minor and patch)  
* New additions without breaking backward compatibility bumps the minor (and resets the patch)  
* Bug fixes and misc changes bumps the patch  
  
For more information on SemVer, please visit [semver.org](http://semver.org/).  
  
##The $_CW global variable##
The entire CleverWeb system, is designed to use this global variable (as an stdClass) instead of populating random globals with information. This allows information to be neatly organized withing the CleverWeb system, and also prevents CleverWeb from interfearing with other scripts or systems. This stdClass is broken down into logical english to help prevent "mixups" and misunderstandings. There should be no need to print this global, as it should be well documented on [our site](http://projectcleverweb.com), once the first major version is complete.  
  
##Scopes##
Scopes in Project CleverWeb, are basically a secondary permissions system, that keeps the balance of power. For example, plugins will have access to some scripts that themes wont. Additionally there are script that can only be accessed by themes, and some scripts are only availible to CleverWeb internals.
  
This system is nested within the init class, and [protected](http://php.net/manual/en/language.oop5.visibility.php) in a way that prevents other scripts from using it.
  
##Various Information##
**Codex :**  
[docs.projectcleverweb.com/codex.php](http://docs.projectcleverweb.com/codex.php) (Work in progress)

**Contact Us :**  
git@projectcleverweb.com

**ETA's :**  
Forget they exist

**Notices :**  
- Some text is abbreviated, and may not be what you expect. Please see the section below called "[Abbreviations](#abbreviations)" for a guide as to what some abbreviations mean.  

**Warnings :**  
- None (yet)

##Abbreviations##
**Information:** This section will likely be updated fairly often, however not constantly. It would be a good idea to check this section between upgrades for new content.
&nbsp;  
&nbsp;  
- **org** = *The original or organic, may refer to a file or element within a document. The idea being that whatever is being refered to is a starting point.*
- **cleverweb/CleverWeb** = *This is used a nickname for Project CleverWeb*  
- **CW** = *Alias of cleverweb*  
- **[comeback]** = *This declars a spot to come back to and fix, adding this to a file, makes it easy to search for areas of script that still need additional information*