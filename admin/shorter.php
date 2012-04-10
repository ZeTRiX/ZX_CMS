<?
if ($_POST['s_submit']) {
$url=mysql_real_escape_string($_POST[url]);
$short_url = file_get_contents('http://clck.ru/--?url='.$url);
echo '<table border=0><tr bgcolor=#565360><td><textarea rows=1 cols=20 name="short_url">';
echo $short_url;
echo '</textarea></td><tr></table><br />';
} else {
?>
<form name="shorturl" method="post" action="">
<textarea name="url" rows=1 cols=20></textarea>
<input type="submit" value="Сократить" name="s_submit" />
</form>
<? } ?>