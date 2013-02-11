# Project CleverWeb Source (codename: CleverWeb) #

**Site :** [projectcleverweb.com](http://projectcleverweb.com)  
**Description :**  
This is the source for the framework of Project CleverWeb. The intentions of this project are detailed in the quote below.
  
> Project CleverWeb is a "Non-Invasive CMS Framework, UI and Library" designed to be easy for both end-users and developers to understand and use. The original plans for Project CleverWeb, detail that, "It should be easy enough to use, that anyone who can make a social-networking profile, can make their own site using CleverWeb. Additionally, if a developer wants only use CleverWeb's framework and library without the CMS UI, it should not only be both possible and easy, but neither the framework or the library should take up the common name-spaces for function names. This would allow CleverWeb to be very easy to integrate into procedural based systems."  
> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Nicholas Jordon&nbsp;&nbsp;|&nbsp;&nbsp;Founder of the project
  
Project CleverWeb is designed to be neat and organized, while providing as much optimization and features as possible. One way is by throwing commonly used items into variables, or if you want to make things complex & dynamic, why not preload you links with some useful information.  
  
``` php
<?php // good ?>
<div class="foo" id="bar">
  <a
    href="<?php
      add_query_arg(
        array(
          'id'   => get_current_user_id(),
          'hash' => wp_hash($info)
        )
        the_permalink()
      ); 
    ?>"
    alt="Click Me!"
    rel="follow"
    title="<?php the_title_attribute(); ?>"
    target="_blank"
  ><?php the_title(); ?></a>
</div>

<?php
// better
blog::post_link(TRUE , // echo
  array( // args array
    'wrap_tag'   => 'div',
    'wrap_class' => 'foo',
    'wrap_id'    => 'bar',
    'target'     => '_blank',
    'alt'        => 'Click Me!',
    'rel'        => 'follow',
    'text'       => $_CW->blog['post_title'] // visible text of link
    'query'      =>
      array(
        'id'   => user::id(),
        'hash' => secure::hash($info),
      )
  )
);
?>
```  

&nbsp;    

----------

&nbsp;    

##Updates, Versions & HotFixes##
Most informational aspects (such us the codex or this readme) will be updated as full versions are released. Requests for ETA's on versions or update will be ignored entirely.  
  
Project CleverWeb is currently in version **0.01 Pre-Alpha**. This version naming system is broken down into 4 parts, the *Major Version*, the *Minor Version*, the *Version CodeName*, and the *Hotfix Sum*. In this case, **0** is the current *Major Version*, **.01** is the *Minor Version*, and **Pre-Alpha** is the *Version CodeName*. Note that the *HotFix Sum* will only appear when a HotFix is pushed out. The *HotFix Sum* appears as 6 characters in square brackes after the *Version CodeName*. (e.g. **1.59 Beta [29053f]**)  
  
Current plans for HotFixes may allow for them to be force installed **without** admin approval. **HOWEVER**, this would mean that HotFix pushes would be strictly governed, would be required to notify admin upon installation,and would be required to create temporary files on the server, until the next approved update.  

##Installation##
Coming Soon  

##The $_CW global variable##
The entire CleverWeb system, is designed to use this global variable (as an stdClass) instead of populating random globals with information. This allows information to be neatly organized withing the CleverWeb system, and also prevents CleverWeb from interfearing with other scripts or systems. This stdClass is broken down into logical english to help prevent "mixups" and misunderstandings. There should be no need to print this global, as it should be well documented on [our site](http://projectcleverweb.com), once the first major version is complete.

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