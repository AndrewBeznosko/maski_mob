<?php
// работа с данным скриптом показана в видео на сайте http://rek9.ru/otpravka-zayavok-v-google-forms/
// формируем запись в таблицу google (изменить)
$url = "https://docs.google.com/forms/d/e/1FAIpQLSfvGcp8SGf4lXqpSCkXcblq63GQuPGMccY2p9atvtWajScAYQ/formResponse";
// сохраняем url, с которого была отправлена форма в переменную utm
$link = '';
$long_link = $_SERVER["HTTP_REFERER"];
$split_link = parse_url($long_link);
$link = trim($split_link['path'],'/'); // $split_link['host'].$split_link['path'] == voron.store/maski2/
$output = "<a href='$long_link'>$link</a>";

// массив данных (изменить entry, draft и fbzx)
$post_data = array (
 "entry.471160601" => $_POST['name'],
 "entry.1193417492" => $_POST['phone'],
 "entry.613951642" => $link,
 "draftResponse" => "[null,null,&quot;2538607683567023063&quot;]",
 "pageHistory" => "0",
 "fbzx" => "2538607683567023063"
);

// Далее не трогать
// с помощью CURL заносим данные в таблицу google
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// указываем, что у нас POST запрос
curl_setopt($ch, CURLOPT_POST, 1);
// добавляем переменные
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
//заполняем таблицу google
$output = curl_exec($ch);
curl_close($ch);

//перенаправляем браузер пользователя на скачивание оффера по нашей ссылке
// header('Location: '.$link);

/* https://api.telegram.org/bot734862732:AAFSW-fDThV3umZOus0j9NPxARpR2fwfzVI/getUpdates,
где, XXXXXXXXXXXXXXXXXXXXXXX - токен вашего бота, полученный ранее */

$name = $_POST['name'];
$phone = preg_replace('![^0-9]+!', '', $_POST['phone']);

if ($_POST['feedback'] == 'phone') {
    $feedback = $_POST['feedback'];
}
elseif ( $_POST['feedback'] == 'telegram' ) {
    $feedback = $_POST['feedback'];
}
elseif ( $_POST['feedback'] == 'viber' ) {
    $feedback = "<a href='viber://chat?number=%2B".$phone."'>Viber</a>";
}
elseif ( $_POST['feedback'] == 'whatsapp' ) {
    $feedback = "<a href='https://wa.me/".$phone."'>Whatsapp</a>";
}

// switch($_POST['feedback']){
// case 'phone':
//     $feedback = $_POST['feedback'];
// break;
// case 'telegram':
//     $feedback = $_POST['feedback'];
// break;
// case 'viber':
//     $feedback = "<a href='viber://add?number=".$phone."'>viber</a>";
// break;
// case 'whatsapp':
//     $feedback = "<a href='https://wa.me/".$phone."'>whatsapp</a>";
// break;
// default:
//     $feedback = $_POST['feedback'];
// }

$token = "734862732:AAFSW-fDThV3umZOus0j9NPxARpR2fwfzVI";
$chat_id = "-290767710";
$arr = array(
  'Имя: ' => $name,
  'Телефон: ' => '%2B'.$phone,
  'Связь: ' => $feedback,
  'url:' => "<a href='".$long_link."'>".$link."</a>"
);

foreach($arr as $key => $value) {
  $txt .= "<b>".$key."</b> ".$value."%0A";
};

$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

if ($sendToTelegram) {
  header('Location: thanks.html');
} else {
  echo "Error";
}


?>