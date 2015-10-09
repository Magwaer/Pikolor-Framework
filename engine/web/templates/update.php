<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
		
		<link type="text/css" href="/engine/web/css/main.css" rel="stylesheet" media="all" />
		
		<title>Update Pikolor</title>
        
    </head>
    <body>
		
		<div id="wrapper">
			<div id="header">
				<div class="logo">Pikolor</div>
			</div>
			
			<div id="content">
				<h2>
					<a href="/update.php?ac=updateEntity" class="but orange_but small">Update all</a>
					Entities list 
				</h2> 
				<?php 
				foreach($entities as $entity => $exists)
				{
				?>
				<div class="entity">
					<?php if (!$exists) { ?>
					<a href="/update.php?ac=createEntity&entity=<?=$entity?>" class="but green_but small">create</a>
					<?php }  ?>
					
					<?=$entity?> 
				</div>
				<?php } ?>
			</div>
			<div id="footer">
				&copy; 2014 <a href="http://pikolor.com" target="_blank">Pikolor lab.</a>
			</div>
		</div>
	
    </body>
</html>
