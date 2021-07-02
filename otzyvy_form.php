<?php
session_start();
?>
<form action='' method='post'>
  <input type='hidden' name='c' value='obr' />
  <b>Имя:</b> <input type='text' name='name' value='' /><br>
  <b>Тема отзыва:</b> <input type='text' name='tems' value='' /><br>
  <b>Отзыв:</b><br>
  <textarea name='content'></textarea>
<p>Введите текст с картинки:</p>
<p><img src="./?<?php echo session_name()?>=<?php echo session_id()?>"></p>
<p><input type='text' name='keystring'></p>
<p><input type='submit' value='Отправить'></p>
</form>
<?php

if(count($_POST)>0){
	if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $_POST['keystring']){
		
if (isset($_REQUEST['c'])) 
{
$znach1 = $_REQUEST['name'];
$znach2 = $_REQUEST['tems'];
$znach3 = $_REQUEST['content'];

  if( !$znach1 ){ print "Поле <b>Имя</b> не заполнено <br> <meta http-equiv='Refresh' content='4; url=javascript:history.go(-1);' ><a href='javascript:history.go(-1);'><<<Назад</a> <br>"; }else
  if( !$znach2 ){ print "Поле <b>Тема</b> не заполнено <br> <meta http-equiv='Refresh' content='4; url=javascript:history.go(-1);' ><a href='javascript:history.go(-1);'><<<Назад</a> <br>"; }else
  if( !$znach3 ){ print "Поле <b>Отзыв</b> не заполнено <br> <meta http-equiv='Refresh' content='4; url=javascript:history.go(-1);' ><a href='javascript:history.go(-1);'><<<Назад</a> <br>"; }else
	  {
$fp = fopen("comment.txt", "a+"); // Открываем файл в режиме записи 
$mytext = "\r\n" . "Имя: ". $znach1 . "\r\n" . "Тема: ". $znach2 . "\r\n" . "Отзыв: " . "\r\n" .$znach3 . "\r\n"; // Исходная строка
$test = fwrite($fp, $mytext); // Запись в файл
if ($test) echo 'Ваш отзыв успешно добавлен.';
else echo 'Ошибка при записи в файл.';
fclose($fp); //Закрытие файла
	} 
}	
	}else{
		echo "Вы ввели код неверно<br />";
	}
}
unset($_SESSION['captcha_keystring']);

$fp = fopen("comment.txt", "r"); // Открываем файл в режиме чтения
if ($fp) 
{
while (!feof($fp))
{
$mytext = fgets($fp, 999);
echo $mytext."<br />";
}
}
else echo "Ошибка при открытии файла";
fclose($fp);

?>