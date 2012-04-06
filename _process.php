<?php

defined('XF_SEO') or die();

$rewrites = array_reverse($rewrites, true);
$plain    = array('RewriteEngine on');
$html     = '<dl>';

foreach ($rewrites as $type => $rewriteInfo)
{
	$rewriteInfo = array_map('htmlspecialchars', $rewriteInfo);
	$html       .= sprintf('<dt>%s</dt>', $type);

	if ($rewriteInfo[2])
	{
		$plain[] = sprintf('RewriteRule %s %s [NC,L]', $rewriteInfo[1], $rewriteInfo[2]);
		$html   .= sprintf('<dd class="supported">%s</dd>', end($plain));
	}
	else
	{
		$html .= sprintf('<dd class="unsupported">%s</dd>', 'Unsupported url format.');
	}
}

$html .= '</dl>';
$plain = implode(PHP_EOL, $plain);

/*
 * Output Data
 */

$output['html'] = $html;
$output['plain'] = $plain;

/*
 * Unset
 */

unset($rewrites, $type, $rewriteInfo, $html, $plain);