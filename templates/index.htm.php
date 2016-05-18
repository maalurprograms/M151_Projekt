<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../css/styles.css"/>
		<script src="../js/jscript.js"></script>
		<title>Bilderdatenbank</title>
	</head>
	<body>
		<div align="center">
			<table class="top" width="1004" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td class="nav" width="200" valign="top">
						<?php echo getMenu(getValue(getValue('menu_eintraege')), getValue('menu_titel')); ?>
					</td>
					<td class="header" height="20" colspan="2">
					<?php echo getMetaMenu(getValue(getValue('meta_menu'))); ?>
					</td>
				</tr>
			</table>
			<?php echo getValue('inhalt');?>
		</div>
	</body>
</html>