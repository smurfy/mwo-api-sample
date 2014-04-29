Admin CP -> Home -> BB Code Media Sites -> Add BB Code Media Site

Media Site ID: smurfy

Site Title: Smurfy

Site URL: http://mwo.smurfy-net.de/

Match URLs: #http://mwo\.smurfy-net\.de/mechlab\#(?P<id>i=[0-9]+&l=[a-z0-9]+)$#siU

Embed HTML:

Code:
<see callback>


Then under Advanced Options:

Use 'Match URLs' as PCRE regular expressions: (checked)

URL Match Callback: MediaSites_Smurfy::extractParams

Embed HTML Callback: MediaSites_Smurfy::buildEmbed

And you need to upload the attached file to this location:

library/MediaSites/Smurfy.php


Original xF thread is here http://xenforo.com/community/threads/custom-bb-code.72160/#post-751232 (The requestor is myself)
