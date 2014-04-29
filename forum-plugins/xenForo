<?php

class MediaSites_Smurfy
{
	public static function extractParams($url, $matchedId, array $site)
	{
		// ISOLATE THE TWO VALUES FROM THE QUERY STRING
		if(preg_match('/^i=(?P<iVal>[0-9]+)&l=(?P<lVal>[a-z0-9]+)$/siU', $matchedId, $match))
		{
			// RETURN DELIMITED VALUES
			// THESE TWO VALUES ARE INSERTED INTO THE HTML IN THE HTML CALLBACK
			return $match['iVal'] . '|' . $match['lVal'];
		}

		// RETURN NOTHING IF NO MATCH
		return '';
	}

	public static function buildEmbed($mediaKey, array $site)
	{
		// EXTRACT TWO VALUES FROM QUERY STRING
		$delimiter = strpos($mediaKey, '|');
		$components['iVal'] = substr($mediaKey, 0, $delimiter);
		$components['lVal'] = substr($mediaKey, $delimiter + 1);

		// DEFINE GENERIC EMBED HTML WITH REPLACEMENT VARIABLES
		$embedHtml = '<iframe src="http://mwo.smurfy-net.de/tools/mechtooltip?i=__IVAL__&l=__LVAL__" width="750" height="300" border="0"></iframe>';

		// MAKE THE REPLACEMENTS
		$finalHtml = str_replace(array('__IVAL__', '__LVAL__'), array($components['iVal'], $components['lVal']), $embedHtml);

		// RETURN THE FINISHED HTML
		return $finalHtml;
	}
}
