<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$session_key = 'PASSED';
$session_key_form_request = 'PASS_REQUEST';
$siteKey = YII_CONFIG['components']['recaptcha']['siteKey'];
$secret = YII_CONFIG['components']['recaptcha']['secret'];
$bots = ['facebook.com', 'ok.ru', 'l.instagram.com', 't.co', 'away.vk.com', 'click.my.mail.ru'];
$referer = $_SERVER['HTTP_REFERER'] ?? null;

$useragent = $_SERVER['HTTP_USER_AGENT'];
$isSocialNetwork = !empty(array_filter(
    $bots,
    function($bot) use ($referer) {
        return strpos($referer, $bot) !== false;
    }));
$isAndroid = strpos($useragent, 'Android') !== false;
$isIndexer = preg_match('#(yandex|google|mail|bing)#i', $useragent);
$isPassed = $_SESSION[$session_key] ?? false;

$isCheck = false;
if (!$isIndexer && !$isPassed) {
    if (!$referer && $isAndroid) {
        $isCheck = true;
    } elseif ($isSocialNetwork) {
        $isCheck = true;
    }
}

$lang = 'ru';
if ($isCheck || isset($_SESSION[$session_key_form_request])) {
    if (isset($_POST['g-recaptcha-response'])) {
        $recaptcha = new \ReCaptcha\ReCaptcha($secret);

        $resp = $recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
                          ->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
        if ($resp->isSuccess()) {
            $_SESSION[$session_key] = true;

            unset($_SESSION[$session_key_form_request]);
            header('Location: '.$_SERVER['REQUEST_URI']);
            exit;
        }
    }

    if (empty($_SESSION[$session_key])) {
        $_SESSION[$session_key_form_request] = true;
        ?>
        <html>
            <head>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            </head>
            <body>
            <div style="font-size: 1.5rem;" class="text-center p-3">
                <div class="container d-flex justify-content-center">
                        <form method="post">
                            <div class="form-group">
                                <p>Пожалуйста, поставьте галочку и нажмите кнопку Войти</p>
                                <div class="g-recaptcha form-field d-flex justify-content-center p-3" data-sitekey="<?php echo $siteKey; ?>"></div>
                                <button type="submit" class="btn btn-primary btn-block">Войти</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang; ?>"></script>
            </body>
        </html>
        <?php
        exit;
    }
}
