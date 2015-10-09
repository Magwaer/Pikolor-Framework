<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
		<link rel="stylesheet" type="text/css" href="/engine/web/css/debugger.css?x=<?=time()?>">
		
		<title>Debugger</title>
        
    </head>
    <body>
		
		<table width="100%" border="0" cellspacing="1">
			<?php 
			foreach($vars as $k => $v)
			{
			?>
			<tr>
				<td><b><?=$k?></b></td>
				<td>
					<pre><?php 
					if (is_bool ($v))
						var_dump($v);
					else
						print_r($v); 
					?></pre>
				</td>
			</tr>
			<?php } ?>
		</table>
	
    </body>
</html>
