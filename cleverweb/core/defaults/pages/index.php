<?php
$_CW["uc_exclude"]=true;
require_once("./../start.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
    <meta name="description" content="Discover how using CleverWeb makes the difference, by making everything simply work. If you can make Facebook page, You can use CleverWeb. This is because CleverWeb is a network designed to make life easier for you, by thinking on its own." />
    <meta name="keywords" content="Blog, Profile, Portfolio, Generator, Clever, CleverWeb, Project, Project CleverWeb, Logic Hierarchy, HTML5, Integrated, Developer, Smart, Web, CMS" />
    <meta name="revisit-after" content="3 days">
    <title><?php echo CW_Page_Title();?> ~ Discover how using CleverWeb makes the difference.</title>
    <!-- CMS, CleverWeb, Logic Hierarchy -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="title" content="<?php CW_Page_Title();?>" />
    <meta name="generator" content="CleverWeb v0.1 pre-alpha">
    <meta name="author" content="CleverWeb => Nicholas Jordon" />
    <meta name="contact" content="admin@projcleverweb.com">
    <meta name="language" content="en" />
    <meta name="subject" content="CleverWeb" />
    <meta name="robots" content="All, NOYDIR, NOODP" />
    <meta name="copyright" content="CleverWeb | Nicholas Jordon" />
    <meta name="googlebot" content="noarchive">
    <meta name="no-email-collection" content="all email collection is forbidden!">
    <meta http-equiv="Cache-control" content="private">
    <meta name="MSSmartTagsPreventParsing" content="true" />
    <link rel="icon" type="image/png" href="./../images/favicon.png">
    <meta name="google-site-verification" content="5k2R9qIVFkdzF6dNz7_W_1ibwcjAatfRm3lZC5tnoIw" />
    <link href="https://plus.google.com/106244282930871353729" rel="publisher" /> 
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<?php if(mt_is_ie()){
echo
"<!--[if lt IE 9]>
<script type='text/javascript' src='http://info.template-help.com/files/ie6_warning/ie6_script_other.js'></script>
<![endif]-->
<!--[if IE]>
<script type='text/javascript' src='js/html5.js'></script>
<style>
.updates{float:right; width:130px}
</style>
<![endif]-->";
}
?>
</head>
<body id="page1">
<center>
<div class="body1">
	<div class="body2">
		<div class="main">
<!-- header -->
			<header>
				<div class="wrapper">
					
					
<form id="search" method="get" target="_blank" action="http://www.google.com/search" >
<div>
<input type="submit" class="submit" value="" />
<input type="text" class="input" name="q" maxlength="255" <?php if(mt_is_ie()){echo 'style="height:29px; width:190px"';} ?> />
<input type="hidden" name="sitesearch" value="projcleverweb.com" />
</div>
</form>


                    
				</div>
				<div class="wrapper">
                
					<nav>
                     <!--[if IE]>
                        <div style="margin-top:9px; padding:none"></div>
                        <![endif]-->
						<ul id="menu" style="margin-top:-<?php if(!mt_is_ie()){echo 4;}else echo 13; ?>px">
							<li><a id="nav_here" href="#">Home</a></li>
							<li><a href="#">Current Progress</a></li>
							<li><a href="#">Design</a></li>
							<li><a href="#">About</a></li>
							<li><a href="#">Contact</a></li>
						</ul>
					</nav>
				</div>
                <div class="page_edge">
				<div class="wrapper">
					<div class="col">
						<h2>Free Done Right <span>How CleverWeb Eliminates The Competition</span></h2>
						<p class="pad_bot1"><strong>Discover how using CleverWeb makes the difference</strong>, by making everything simply work. If you can make Facebook page, you can use CleverWeb. This is because CleverWeb is a network designed to make life easier for <b>you</b>, by thinking on its own. Because of this CleverWeb can:</p>
						<ul class="list1 pad_bot2">
							<li>Be more effecient</li>
							<li>Think of things you may have forgot</li>
							<li>And do <b>things</b> faster!</li>
						</ul>
						<a href="#" class="button" style="float:left"><span>Read More</span></a><a href="#" class="button" style="float:right"><span>Get CleverWeb (It's Free!)</span></a>
					</div>
				</div>
                </div>
			</header>
<!-- / header -->
<!-- content -->
			<section id="content">
				<article class="col1">
					<h3>Latest Updates</h3>
					<div class="wrapper">
						<figure class="left marg_right1"><a href="#"><img src="images/page1_img1.jpg" alt=""></a></figure>
						<p class="updates">
							<strong><a href="#">HTML5 Intergated!</a></strong><br />This is the latest and greatest, the web has to offer. This allows websites to have more awesome elements, like 3D objects or tiny rocket-ships flying all over the page.
						</p>
					</div>
					<div class="wrapper">
						<figure class="left marg_right1"><a href="#"><img src="images/page1_img2.jpg" alt=""></a></figure>
						<p class="updates">
							<strong><a href="#">Added A Contact Page</a></strong><br />Now if you have a question, we can help. Anytime.
						</p>
					</div>
					<div class="wrapper">
						<figure class="left marg_right1"><a href="#"><img src="images/page1_img3.jpg" alt=""></a></figure>
						<p class="updates">
							<strong><a href="#">Added An About Page</a></strong><br />Discover how CleverWeb is like nothing you have ever tried before.
						</p>
					</div>
				</article>
				<article class="col2">
					<h3>Welcome to Project CleverWeb!</h3>
					<p class="pad_bot2">
					CleverWeb is a downloadable program that allows almost anyone to create, edit and manage their own site with minimal effort. From posting YouTube videos, to updating your blog, to even managing files, CleverWeb can help.<br /><br />
                    
                   Although, it is not currently available, you can sign up to be contacted when CleverWeb becomes available. You can even sign up to be in the beta testing program!<br /><br />
                   
<?php
$_CW["mysql_conn"];
if (!$_CW["mysql_conn"])
  {
  die('Could not connect: ' . mysql_error());
  }

// Create table
mysql_select_db("teamcw_cleverweb", $_CW["mysql_conn"]);
$sql = "INSERT INTO emailUpdates VALUES (
'this@email.com','Peter', 'Johan', 'true', 'true'
)";
// Execute query
mysql_query($sql,$_CW["mysql_conn"]);
echo mysql_query("SELECT * FROM table_name",$_CW["mysql_conn"]);
$_CW["mysql_close"];

?>
                   <br /><br />
                   
                 <div style="text-align:center"><h3>Sign-up for updates!</h3></div>
                   
                   <form name="form" method="POST" action="sign_up.php" ONSUBMIT="return Validate()" style="border: solid 1px; padding:10px; width:75%; margin-left:12.5%">
                   <p><b>Name:</b> (optional)<br />
                   <input type="text" name="firstname" size="20" placeholder="Firstname" maxlength="25" width="50%" style="border: solid 1px">
                   <input type="text" name="lastname" size="20" placeholder="Lastname" maxlength="25" width="50%" style="border: solid 1px"></p>
                   <p><b>Email:</b> <input type="email" name="email" placeholder="user@example.com" size="30" maxlength="35" style="border: solid 1px"></p>
                   <p><input type="checkbox" name="beta" value="1" />I want to be in your beta program!<br />
                   <input type="checkbox" name="noupdates" value="1" />I just want to know when the product is ready, don't send me any other emails</p>
                   <p><font style="font-size:10px">*By clicking submit, you agree to receive update via E-Mail about CleverWeb*</font><br />
                   <input type="button" value="Submit"/></p>
                   </form>
					</p>
				</article>
                
			</section>
		</div>
	</div>
</div>
<div class="body3">
	<div class="main">
		<section id="content2"> <!-- DISABLED UNTIL ALPHA RELEASE
			<article class="col3">
				<a href="#" class="button"><span>Social Pages</span></a><br /><br />
				<div class="wrapper">
					<div class="pad">
						<p class="pad_bot3">
							<strong>Vero eoset accusamus eot iusto odio dignissimos</strong>
						</p>
						<p class="pad_bot3">
							Blanditiis praesentium voluptatum deleniti atque corrupti quos dolores erum facilis est et expedita distinc et quas molestias excepturi occaecati cupiditate corrupti quos.
						</p>
						<p>
							Non provident, similique sunt infgo culpa qui officia deserunt mollitia animid laborum et dolorum fuga. Et harum quidem.
						</p>
					</div>
				</div>
			</article>
			<article class="col4">
				<a href="#" class="button"><span>Social Pages</span></a><br /><br />
				<div class="wrapper">
					<div class="pad">
						<ul class="list1">
							<li><a href="#">Twitter</a></li>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Google +</a></li>
                            <li><a href="#">Linkedin</a></li>
                            <li><a href="#">Digg</a></li>
						</ul>
					</div>
				</div>
			</article>
			<article class="col4">
				<a href="#" class="button"><span>Social Pages</span></a><br /><br />
				<div class="wrapper">
					<div class="pad">
						<ul class="list1">
							<li><a href="#">Twitter</a></li>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Google +</a></li>
                            <li><a href="#">Linkedin</a></li>
                            <li><a href="#">Digg</a></li>
						</ul>
					</div>
				</div>
			</article> -->
		</section>
<!-- / content -->
<!-- footer -->
		<footer>
			<div class="template">
				 Based off a template from <a rel="nofollow" href="http://www.templatemonster.com/" target="_blank">TemplateMonster</a>*<br />
				*Please keep in mind that this template is temporary, and will be replaced with a completely original design when CleverWeb goes into beta.
			</div>
		</footer>
<!-- / footer -->
	</div>
</div>
</center>
</body>
</html>
<?php
require_once("./../finish.php");
?>