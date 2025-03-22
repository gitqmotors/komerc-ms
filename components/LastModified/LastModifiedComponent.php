<?php

namespace app\components\LastModified;

use yii\base\Component;

class LastModifiedComponent extends Component {

    public $timestamp;

    public function init() {
        parent::init();
    }

    protected function handler() {
        $timestamp = $this->getTime();
        $IfModifiedSince = false;
        if (isset($_ENV['HTTP_IF_MODIFIED_SINCE'])) {
            $IfModifiedSince = strtotime(substr($_ENV['HTTP_IF_MODIFIED_SINCE'], 5));
        }

        if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
            $IfModifiedSince = strtotime(substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 5));
        }

        if ($IfModifiedSince && $IfModifiedSince >= $timestamp) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
            exit;
        }
        header('Cache-Control: max-age=86400, must-revalidate');
        header('Last-Modified: ' . $this->formatDate());
        //header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 2592000));
    }

    public function getTime() {
        return $this->timestamp;
    }

    public function setTime($timestamp) {
        $this->timestamp = $timestamp;
    }

    public function formatDate() {
        return gmdate('D, d M Y H:i:s \G\M\T', $this->timestamp);
    }
    
    public function get($timestamp) {
        $this->setTime($timestamp);
        $this->handler();
        return $this->formatDate();
    }

}
