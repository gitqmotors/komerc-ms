<?php
?>
<?= $premessage; ?>
<br><br>
Имя клиента: <b><?= $username; ?></b><br>
Телефон клиента: <b><?= $phone; ?></b><br>
Email клиента: <b><?= $email; ?></b><br>
Срочное обращение: <b><?php if($urgently == 'true') {echo 'yes';} else {echo 'no';} ?></b><br>
Автосервис <?= $service_name; ?><br>
Цель обращения: <?= $target; ?><br>
Текст: <?= $text; ?><br>
<hr>
<br>С уважением! Почтовый робот R-MS.ru
