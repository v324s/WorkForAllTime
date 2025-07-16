<?php

require_once('settings.php');
require_once('telegram.php');
require_once('logs.php');

$tg = new Telegram();
$logs = new Logs();

echo "<pre>";

// Раскоментировать если требуется удалить выбхук

// $resdelwh=json_decode($tg->deleteWebhook(),true);
// $resdelwh['ok'] ? logs('✔️ Предыдущий Webhook был успешно удален') : logs('❌ Не удалось удалить предыдущий Webhook. Причина: '+$resdelwh['description']);

$res=json_decode($tg->getWebhookInfo(),true);
print_r($res);

if ($res['ok']==1) {
    if (!$res['result']['url']) {
        logs('Webhook не обнаружен. Устанавливаем webhook...');
        $res=json_decode($tg->setWebhook(WEBHOOK_URL, WEBHOOK_SECRET_TOKEN),true);
        if ($res['ok'] && $res['result']) {
            logs('✔️ Webhook установлен.');
            echo $res['description'];
        }else {
            logs('❌ Не удалось установить Webhook. Причина: '+$res['description']);
        }
    }
    if ($res['result']['pending_update_count'] > 0) {
        logs("❌ Telegram ожидает {$res['result']['pending_update_count']} ответа(-ов). Последняя ошибка: (".date("d.m.Y H:i:s",$res['result']['last_error_date']).") \"{$res['result']['last_error_message']}\"");
    }elseif ($res['result']['pending_update_count'] == 0) {
        logs("✔️ Telegram не ожидает ответов на запросы");
    }
}

function logs($text) : void {
    global $logs;
    $logs->main($text);
}
?>
