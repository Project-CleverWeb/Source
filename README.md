# Project CleverWeb Source (codename: CleverWeb) #

**Site :** [projectcleverweb.com](http://projectcleverweb.com)  
**Description :**  
This is the source for the framework of Project CleverWeb. The intentions of this project are detailed in the quote below.
  
> Project CleverWeb is a "Non-Invasive CMS Framework, UI and Library" designed to be easy for both end-users and developers to understand and use. The original plans for Project CleverWeb, detail that, "It should be easy enough to use, that anyone who can make a social-networking profile, can make their own site using CleverWeb. Additionally, if a developer wants only use CleverWeb's framework and library without the CMS UI, it should not only be both possible and easy, but neither the framework or the library should take up the common name-spaces for function names. This would allow CleverWeb to be very easy to integrate into procedural based systems."  
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Nicholas Jordon&nbsp;&nbsp;|&nbsp;&nbsp;Founder of the project

&nbsp;    

----------

&nbsp;    

##Updates##
Most informational aspects (such us the codex or this readme) will be updated as full versions are released. Requests for ETA's on versions or update will be ignored entirely.

##The $_CW global array##
The entire CleverWeb system, is designed to use this global array instead of populating random globals with information. This allows information to be neatly organized withing the CleverWeb system, and also prevents CleverWeb from interfearing with other scripts or systems. This array is broken down into logical english to help prevent "mixups" and misunderstandings. Instead of using print_r() or var_dump() directly on on $_CW, it is recommended that you instead put the global into array_keys() before printing. Additionally, there should be no need to print this global, as it should be well documented on [our site](http://projectcleverweb.com), once a version is complete.

##Various Information##
**Codex :**  
[docs.projectcleverweb.com/codex.php](http://docs.projectcleverweb.com/codex.php) (Work in progress)

**Contact Us :**  
git@projectcleverweb.com

**ETA's :**  
Forget they existhttps://github.com/Project-CleverWeb/Source#abbreviations

**Notices :**  
- Some text is abbreviated, and may not be what you expect. Please see the section below called "[Abbreviations](#abbreviations)" for a guide as to what some abbreviations mean.  


##Abbreviations##
**Information:** This section will likely be updated fairly often, however not constantly. It would be a good idea to check this section between upgrades for new content.
&nbsp;  
&nbsp;  
- **org** = *The original or organic, may refer to a file or element within a document. The idea being that whatever is being refered to is a starting point.*
- **cleverweb/CleverWeb** = *This is used a nickname for Project CleverWeb*  
- **CW** = *Alias of cleverweb*  
- **[comeback]** = *This declars a spot to come back to and fix, adding this to a file, makes it easy to search for areas of script that still need additional information*