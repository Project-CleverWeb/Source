#mobile redirect
#RewriteEngine On
#RewriteCond %{HTTP_HOST} !^m.%{HTTP_HOST}.*$ [NC]
#RewriteCond %{HTTP_ACCEPT} "text/vnd.wap.wml|application/vnd.wap.xhtml+xml" [NC,OR]
#RewriteCond %{HTTP_USER_AGENT} "acs|alav|alca|amoi|audi|aste|avan|benq|bird|blac|blaz|brew|cell|cldc|cmd-" [NC,OR]
#RewriteCond %{HTTP_USER_AGENT} "dang|doco|eric|hipt|inno|ipaq|java|jigs|kddi|keji|leno|lg-c|lg-d|lg-g|lge-" [NC,OR]
#RewriteCond %{HTTP_USER_AGENT}  "maui|maxo|midp|mits|mmef|mobi|mot-|moto|mwbp|nec-|newt|noki|opwv" [NC,OR]
#RewriteCond %{HTTP_USER_AGENT} "palm|pana|pant|pdxg|phil|play|pluc|port|prox|qtek|qwap|sage|sams|sany" [NC,OR]
#RewriteCond %{HTTP_USER_AGENT} "sch-|sec-|send|seri|sgh-|shar|sie-|siem|smal|smar|sony|sph-|symb|t-mo" [NC,OR]
#RewriteCond %{HTTP_USER_AGENT} "teli|tim-|tosh|tsm-|upg1|upsi|vk-v|voda|w3cs|wap-|wapa|wapi" [NC,OR]
#RewriteCond %{HTTP_USER_AGENT} "wapp|wapr|webc|winw|winw|xda|xda-" [NC,OR]
#RewriteCond %{HTTP_USER_AGENT} "up.browser|up.link|windowssce|iemobile|mini|mmp" [NC,OR]
#RewriteCond %{HTTP_USER_AGENT} "symbian|midp|wap|phone|pocket|mobile|pda|psp|chrome" [NC]
#RewriteCond %{HTTP_USER_AGENT} !macintosh [NC] 
#THIS IS WHERE YOUR MOBILE SITE IS LOCATED, USE FULL "HTTP://" PATH!
#RewriteRule ^(.*)$ http://%{HTTP_HOST}%{SCRIPT_FILENAME}?%{QUERY_STRING}&mobile [L,R=302]

 
#cache - set at 1 hour before expire
<FilesMatch "\.(html|htm|xml|txt|css|js|jpg|jpeg|png|gif|swf|ico|pdf|flv)$">
Header set Cache-Control "max-age=3600, proxy-revalidate"
</FilesMatch>
 
#explicitly disable caching for scripts and other dynamic files
<FilesMatch ".(pl|php|cgi|spl|scgi|fcgi)$">
Header unset Cache-Control
</FilesMatch>
 
#for troubleshooting 
SetEnv SERVER_ADMIN Webmaster@ProjectCleverWeb.com
 
#security assets - limits server activity for visitors
Options -ExecCGI -Indexes -All +FollowSymLinks
RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_METHOD} !^(GET|PUT)
RewriteRule .* - [F]
<Files .htaccess>
 order allow,deny
 deny from all
</Files>
IndexIgnore *
 
RewriteEngine On
 
# proc/self/environ? no way!
RewriteCond %{QUERY_STRING} proc/self/environ [OR]
 
# Block out any script trying to set a mosConfig value through the URL
RewriteCond %{QUERY_STRING} mosConfig_[a-zA-Z_]{1,21}(=|\%3D) [OR]
 
# Block out any script trying to base64_encode crap to send via URL
RewriteCond %{QUERY_STRING} base64_encode.*(.*) [OR]
 
# Block out any script that includes a <script> tag in URL
RewriteCond %{QUERY_STRING} (<|%3C).*script.*(>|%3E) [NC,OR]
 
# Block out any script trying to set a PHP GLOBALS variable via URL
RewriteCond %{QUERY_STRING} GLOBALS(=|[|\%[0-9A-Z]{0,2}) [OR]
 
# Block out any script trying to modify a _REQUEST variable via URL
RewriteCond %{QUERY_STRING} _REQUEST(=|[|\%[0-9A-Z]{0,2})
 
# Send all blocked request to homepage with 403 Forbidden error!
RewriteRule ^(.*)$ index.php [F,L]
 
 
 
 
#compresses php/saves bandwidth/improves loading time
ServerSignature Off
<ifModule mod_php4.c>
 php_value zlib.output_compression 16386
</ifModule>
 
# minimize image flicker in IE6
ExpiresActive On
ExpiresByType image/gif A2592000
ExpiresByType image/jpg A2592000
ExpiresByType image/png A2592000
 
# instruct browser to download multimedia/zip/apk files
AddType application/octet-stream .avi
AddType application/octet-stream .mpg
AddType application/octet-stream .wmv
AddType application/octet-stream .mp3
AddType application/octet-stream .apk
AddType application/octet-stream .zip
AddType application/octet-stream .doc
AddType application/octet-stream .mp4
AddType application/octet-stream .m4a
AddType application/octet-stream .acc
 
#nice url
RewriteEngine on
RewriteRule ^about/$    /pages/about.html [L]
RewriteRule ^features/$ /features.php [L]
RewriteRule ^buy/$      /buy.html [L]
RewriteRule ^contact/$  /pages/contact.htm [L]
 
#compress text, html, javascript, css, xml:
AddOutputFilterByType DEFLATE text/plain
AddOutputFilterByType DEFLATE text/html
AddOutputFilterByType DEFLATE text/xml
AddOutputFilterByType DEFLATE text/css
AddOutputFilterByType DEFLATE application/xml
AddOutputFilterByType DEFLATE application/xhtml+xml
AddOutputFilterByType DEFLATE application/rss+xml
AddOutputFilterByType DEFLATE application/javascript
AddOutputFilterByType DEFLATE application/x-javascript