xenForo Plugin
=================

Plugin provided by @DarkDeLaurel original thread and possible help:

http://xenforo.com/community/threads/custom-bb-code.72160/#post-751232

Install:
----------
Upload the shipped ``Smurfy.php`` to your server to ``library/MediaSites/Smurfy.php``

Goto: Admin CP -> Home -> BB Code Media Sites -> Add BB Code Media Site

    Media Site ID: smurfy

    Site Title: Smurfy

    Site URL: http://mwo.smurfy-net.de/

    Match URLs: #http://mwo\.smurfy-net\.de/mechlab\#(?P<id>i=[0-9]+&l=[a-z0-9]+)$#siU

    Embed HTML:

    Code: <see callback>

Then under Advanced Options:

    Use 'Match URLs' as PCRE regular expressions: (checked)

    URL Match Callback: MediaSites_Smurfy::extractParams

    Embed HTML Callback: MediaSites_Smurfy::buildEmbed

Usage:
-------
All links in the format below, will be transformed:

http://mwo.smurfy-net.de/mechlab#i=7&l=0c5baded02023e70daac9803845aae9718d48c15
