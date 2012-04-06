<?php defined('XF_SEO') or die() ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Redirects for vBSEO URLs to native vBulletin format</title>
	<meta name="description" content="Generate .htaccess rewrites for converting vBSEO URLs to native vBulletin format.">
	<meta name="author" content="Shadab Ansari">
	<link rel="stylesheet" type="text/css" href="http://xf.geekpoint.net/install/install.css" />
	<style type="text/css">
		#title { font-size: 22px; line-height: 35px; height: 35px; }
		.pairsColumns { line-height: 2; }
		.pairsColumns dt { width: 15%; }
		.pairsColumns dd { width: 75%; }
		.xenForm .ctrlUnit dd .explain { margin-top: 5px; margin-right: 0; }
		.unsupported { font-style: italic; font-weight: normal; color: #E77E7E; /* #E77E7E */ }
		.supported { font-style: normal; font-weight: normal; color: #4B4; /* #8FE28F */ }
		p.text { line-height: 1.5; }
		pre { line-height: 2; border-top: 1px solid #D7EDFC; padding-top: 1em; }
	</style>
</head>
<body>
	<div id="header">
		<div id="logoLine">
			<div class="pageWidth">
				<h1 id="title"><a href="./" id="logo">vBSEO to vBulletin URLs</a></h1>
				<h2 id="version">Tool Version: 1.0</h2>
			</div>
		</div>
		<div id="tabsNav">
			<div class="pad"></div>
		</div>
	</div>

	<div id="body" class="pageWidth">
		<div id="contentContainer" class="noSideBar">
			<div id="content">
				<?php if (!$output): ?>
				<div class="titleBar">
					<h1>Generate Rewrite Rules</h1>
				</div>
				<p class="text">
					If you have installed vBSEO for your vBulletin forum and want to redirect all those rewritten
					links to the corresponding XenForo links, there's no single way to do that unfortunately.
					The rewrite codes all depend on what url formats you are using.
				</p>
				<p class="text">
					If you are using a preset, select it from the dropdown menu; otherwise, export your URL format
					settings via the vBSEO Control Panel and upload it here. The default preset for vBSEO is "001".
				</p>
				<form action="./" method="post" enctype="multipart/form-data" class="xenForm">
						<dl class="ctrlUnit">
							<dt>
								<label for="preset">Select a Preset:</label>
							</dt>
							<dd>
								<select name="preset" id="preset">
									<option value="0"></option>
									<option value="1">001 - Hierarchic .html type URLs with content relevant forums and threads</option>
									<option value="2">002 - Hierarchic directory type URLs with content relevant threads</option>
									<option value="3">003 - Hierarchic .htm type URLs with content relevant forums</option>
									<option value="4">004 - Non-hierarchic .html type URLs using IDs</option>
									<option value="5">005 - Non-hierarchic directory type URLs using IDs</option>
									<option value="6">006 - Hierarchic .html type URLs with content relevant threads</option>
									<option value="7">007 - Non-English Speaking Forums</option>
								</select>
							</dd>
						</dl>
						<dl class="ctrlUnit">
							<dt>
								<label for="settings">Or, Upload your own XML File:</label>
							</dt>
							<dd>
								<input type="file" name="settings" id="settings" />
								<p class="explain">
									For 3.5 &amp; above: Go to: vbseocp.php &raquo; Data Backup &amp; Restore &raquo; vbseo_urls.xml
								</p>
								<p class="explain">
									For 3.3 &amp; below: Go to: vbseocp.php &raquo; Download/Backup your Current Settings &raquo; vbseo_urls.xml
								</p>
							</dd>
						</dl>
						<dl class="ctrlUnit submitUnit">
							<dt></dt>
							<dd><input type="submit" value="Generate" class="button primary" /></dd>
						</dl>
				</form>
				<?php elseif ($output): ?>
					<div class="titleBar">
						<h1>Your Rewrite Rules</h1>
					</div>
					<p class="text muted">
						Source: <?php echo $output['title'] ?>
					</p>
					<div class="pairsColumns">
						<?php echo $output['html'] ?>
					</div>
					<p class="text">
						Copy the rewrite rules given below to your .htaccess file in the same directory
						where you have placed showthread.php and forumdisplay.php files provided by Kier:
						<a href="http://xenforo.com/community/threads/redirection-scripts-for-vbulletin-3-x.5030/">
						Redirection Scripts for vBulletin 3.x</a>.
						If you already have some rewrite rules in that .htaccess file, place these near the top.
					</p>
					<pre><?php echo $output['plain'] ?></pre>
				<?php endif ?>
				<?php if ($errors): ?>
					<div class="titleBar">
						<h1>Errors</h1>
					</div>
					<p class="text unsupported">
						<?php echo $errors['text'] ?>
					</p>
				<?php endif ?>
			</div>
			<div id="footer">
				<div id="debugInfo">
					<a href="http://xenforo.com" class="concealed">Forum software by XenForo&trade;</a>, &copy;2010 XenForo Ltd.
				</div>
				<div id="copyright">
					<a href="http://www.geekpoint.net/" class="concealed">Script by Shadab</a>, &copy;2010 Shadab.
				</div>
			</div>
		</div>
	</div>
</body>
</html>