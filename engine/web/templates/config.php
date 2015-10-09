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
					Database Configuration
				</h2> 
				<form action="" method="post">
					<label>
						DB host <br />
						<input type="text" class="field" name="db[host]" />
					</label>
					<label>
						DB username<br />
						<input type="text" class="field" name="db[user]" />
					</label>
					<label>
						DB password<br />
						<input type="text" class="field" name="db[password]" />
					</label>
					<label>
						DB name<br />
						<input type="text" class="field" name="db[name]" />
					</label>
					<input type="submit" value="Save" class="but"/>
					<input type="hidden" name="ac" value="save_db_config" />
				</form>
			</div>
			<div id="footer">
				&copy; 2014 <a href="http://pikolor.com" target="_blank">Pikolor lab.</a>
			</div>
		</div>
	
    </body>
</html>
