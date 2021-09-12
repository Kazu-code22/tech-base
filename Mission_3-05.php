<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
</head>
<body>
    <span style = "color:green;font-size:75px;font-style:italic">
        みんなのけいじばん
    </span><br>
    <span style = "color:red;font-size:40px;font-style:italic">
        ※編集したものを投稿する時はパスワード入力不要
    </span><br>
    
<?php
if(!empty($_POST["name"])){$name = $_POST["name"];}else{$name = "";}
if(!empty($_POST["comment"])){$comment = $_POST["comment"];}
else{$comment = "";}
$file = "mission_3-05.txt";
$date = date("Y/m/d H:i:s");
if(!empty($_POST["pass"])){$pass = $_POST["pass"];}else{$pass = "";}
if(!empty($_POST["pass2"])){$pass2 = $_POST["pass2"];}else{$pass2 = "";}
if(!empty($_POST["pass3"])){$pass3 = $_POST["pass3"];}else{$pass3 = "";}
if(!empty($_POST["deletenum"])){$deletenum = $_POST["deletenum"];}
else{$deletenum = "";}
if(!empty($_POST["editnum"])){$editnum = $_POST["editnum"];}
else{$editnum = "";}
if(!empty($_POST["num"])){$hiddennum = $_POST["num"];}
else{$hiddennum = "";}
$numform = "";
$nameform = "";
$commentform = "";
if(count(file($file)) == 0){$num = 1;}
else{$a = file($file, FILE_IGNORE_NEW_LINES); $b = end($a)
; $number = explode("<>", $b); 
$num = $number[0] + 1;}
if(empty($name) && empty($comment) && empty($deletenum) && 
empty($editnum))
{$lines = file($file, FILE_IGNORE_NEW_LINES);
foreach($lines as $line)
{$parts = explode("<>", $line);
    echo "$parts[0]　"."$parts[1]　"."$parts[2]　"."$parts[3]　".
    "<br>";
}
    
}
if(!empty($name) && !empty($comment) && !empty($pass)
&& empty($hiddennum))
{if(file_exists($file))
{
$fp = fopen($file, "a");
fwrite($fp,  $num."<>".$name."<>".$comment."<>".$date."<>".
$pass."<>".PHP_EOL);
fclose($fp);
$lines = file($file, FILE_IGNORE_NEW_LINES);
foreach($lines as $line)
{$parts = explode("<>", $line);
    echo "$parts[0]　"."$parts[1]　"."$parts[2]　"."$parts[3]"."<br>";
}
}
}
if(!empty($deletenum) && !empty($pass2))
{if(file_exists($file))
{$fp = fopen($file, "a");
$lines = file($file, FILE_IGNORE_NEW_LINES);//ファイルの行ごとに配列
ftruncate($fp, 0);
for($i = 0; $i < count($lines); $i++)
{$line = explode("<>", $lines[$i]);
if($line[0] != $deletenum || $line[4] != $pass2)
{
 fwrite($fp, $lines[$i].PHP_EOL);
 echo "$line[0]　"."$line[1]　"."$line[2]　"."$line[3]"."<br>";
}
}
  fclose($fp);  
}
}
if(!empty($editnum) && !empty($pass3))
{if(file_exists($file))
{$lines = file($file, FILE_IGNORE_NEW_LINES);
foreach($lines as $line)
{$parts = explode("<>", $line);
if($editnum == $parts[0] && $pass3 == $parts[4])
{$numform = $parts[0]; $nameform = $parts[1]; 
 $commentform = $parts[2];
}echo "$parts[0]　"."$parts[1]　"."$parts[2]　"."$parts[3]"."<br>";
}
}
}
if(!empty($hiddennum))
{if(file_exists($file))
{$fp = fopen($file, "a");
$lines = file($file, FILE_IGNORE_NEW_LINES);
ftruncate($fp, 0);
for($i = 0; $i < count($lines); $i++)
{$parts = explode("<>", $lines[$i]);
if($parts[0] == $hiddennum)
{fwrite($fp, $parts[0]."<>".$name."<>".$comment."<>"
.$parts[3]."<>".$parts[4]."<>".PHP_EOL);
}
else
{fwrite($fp, $lines[$i].PHP_EOL);
}  
}fclose($fp);
$lines2 = file($file);
foreach($lines2 as $line2)
{$parts2 = explode("<>", $line2);
    echo "$parts2[0]　"."$parts2[1]　"."$parts2[2]　"."$parts2[3]　".
    "<br>";
}
}
    
}
?>
<form action = "" method = "post">
    <input type = "hidden" name = "num" placeholder = "投稿番号"
    value = "<?php echo $numform?>">
    <input type = "text" name = "name" placeholder = "名前"
    value = "<?php echo $nameform?>">
    <input type = "text" name = "comment" placeholder = "コメント"
    value = "<?php echo $commentform?>">
    <input type = "number" name = "pass" placeholder = "password">
    <input type = "submit" name = "submit" value = "送信"><br><br>
    <input type = "number" name = "deletenum" placeholder = "削除番号">
    <input type = "number" name = "pass2" placeholder = "password">
    <input type = "submit" name = "delete" value = "削除"><br><br>
    <input type = "number" name = "editnum" placeholder = "編集番号">
    <input type = "number" name = "pass3" placeholder = "password">
    <input type = "submit" name = "edit" value = "編集">
</form>
</body>
</html>