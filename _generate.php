<?php

defined('XF_SEO') or die();

$errorState = libxml_use_internal_errors(TRUE);

$settings   = new SimpleXMLElement($filename, NULL, TRUE);
$index      = 0;
$rewrites   = array();

$formats    = array(
	'VBSEO_URL_THREAD'         => '',
	'VBSEO_URL_THREAD_PAGENUM' => '',
	'VBSEO_URL_FORUM'          => '',
	'VBSEO_URL_FORUM_PAGENUM'  => '',
	'VBSEO_URL_MEMBER'         => '',
	'VBSEO_URL_MEMBERLIST'     => ''
);

while ($node = $settings->setting[$index++])
{
	switch ($node->name)
	{
		case 'VBSEO_URL_THREAD':
		case 'VBSEO_URL_THREAD_PAGENUM':
		case 'VBSEO_URL_FORUM':
		case 'VBSEO_URL_FORUM_PAGENUM':
		case 'VBSEO_URL_MEMBER':
		case 'VBSEO_URL_MEMBERLIST':
			$formats["$node->name"] = (string) $node->value;
			break;
		default:
			// Do nothing
			break;
	}
}

$replacements = array(
	'%forum_path%'   => '.+',
	'%forum_title%'  => '[^/]+',

	'%forum_id%'     => '([\d]+)',
	'%forum_page%'   => '([\d]+)',

	'%thread_title%' => '.+',

	'%thread_id%'    => '([\d]+)',
	'%thread_page%'  => '([\d]+)',

	'%user_name%'    => '.+',
	'%user_id%'      => '([\d]+)'
);

/*
 * MEMBERLIST
 */

/*
$rewrites['Memberlist'] = array(
	$formats['VBSEO_URL_MEMBERLIST'],
	'memberlist.php'
);
*/

/*
 * MEMBER
 */

/*
$pattern = str_replace(array_keys($replacements), array_values($replacements), $formats['VBSEO_URL_MEMBER']);

$rewrites['Members'] = array(
	$formats['VBSEO_URL_MEMBER'],
	$pattern,
	(substr_count($pattern, '([\d]+)') === 1) ? 'member.php?u=$1' : NULL
);
*/

/*
 * FORUM
 */

$pattern = str_replace(array_keys($replacements), array_values($replacements), $formats['VBSEO_URL_FORUM']);

$rewrites['Forum'] = array(
	$formats['VBSEO_URL_FORUM'],
	$pattern,
	(substr_count($pattern, '([\d]+)') === 1) ? 'forumdisplay.php?f=$1' : NULL
);

/*
 * FORUM (PAGING)
 */

$pattern = str_replace(array_keys($replacements), array_values($replacements), $formats['VBSEO_URL_FORUM_PAGENUM']);

$rewrites['Forum Paging'] = array(
	$formats['VBSEO_URL_FORUM_PAGENUM'],
	$pattern,
	(substr_count($pattern, '([\d]+)') === 2) ? 'forumdisplay.php?f=$1&page=$2' : NULL
);

/*
 * THREAD
 */

// Thread pages don't really need to capture the forumid
$_replacements = array_merge($replacements, array('%forum_id%' => '[\d]+'));

$pattern = str_replace(array_keys($_replacements), array_values($_replacements), $formats['VBSEO_URL_THREAD']);

$rewrites['Thread'] = array(
	$formats['VBSEO_URL_THREAD'],
	$pattern,
	(substr_count($pattern, '([\d]+)') === 1) ? 'showthread.php?t=$1' : NULL
);

/*
 * THREAD (PAGING)
 */

$pattern = str_replace(array_keys($_replacements), array_values($_replacements), $formats['VBSEO_URL_THREAD_PAGENUM']);

$rewrites['Thread Paging'] = array(
	$formats['VBSEO_URL_THREAD_PAGENUM'],
	$pattern,
	(substr_count($pattern, '([\d]+)') === 2) ? 'showthread.php?t=$1&page=$2' : NULL
);


/*
 * Output Title
 */

$output['title'] = isset($settings['title']) ? (string) $settings['title'] : 'Rewrites for uploaded XML file';
$output['title'] = htmlspecialchars($output['title']);

/*
 * Unset
 */

libxml_use_internal_errors($errorState);
unset($settings, $index, $replacements, $_replacements, $node, $pattern, $formats, $errorState);
