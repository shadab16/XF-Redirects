<?php

define('XF_SEO', 1);

$output  = array();
$errors  = array();
$process = false;

if (!$process && count($_POST))
{
	$preset = (int) $_POST['preset'];

	if ($preset >= 1 && $preset <= 7)
	{
		$filename = sprintf('presets/vbseo_urls_00%d.xml', $preset);
		$process  = true;
	}
}

if (!$process && count($_FILES))
{
	$settingsFile = $_FILES['settings'];

	if (
		count($settingsFile) && $settingsFile['size'] && $settingsFile['tmp_name'] &&
		($settingsFile['error'] == UPLOAD_ERR_OK) && ($settingsFile['type'] == 'text/xml')
	)
	{
		$filename = $settingsFile['tmp_name'];
		$process  = true;
	}
}

if ($process)
{
	try
	{
		include '_generate.php';
		include '_process.php';
	}
	catch (Exception $e)
	{
		$errors['text'] = 'Could not process the file. Sorry.';
	}
}

include '_view.php';
