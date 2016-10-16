<?php
class Log {

    private $path;
    private $ip;

    public function __construct() {
        $this->setFilePath();
        $this->setIp();
    }

    public function setFilePath() {
        $this->path = 'application/logs/'.date('d.m.Y').'.txt';
    }

    public function setIp() {
        $ip = $_SERVER['REMOTE_ADDR'];
        if(!filter_var($ip, FILTER_VALIDATE_IP)){
            $this->ip = 'BAD_IP';
        } else {
            $this->ip = $ip; 
        }
    }

    /**
     * @desc Функция для записи в лог
     * @date 30.03.3016
     * @param <Text> text - Текст для записи
     *
     */
	function write($text) {
		$time = date('h:i:s');
		$text_to_log = "\n[$time][$this->ip]$text";
        $file = fopen($this->path, 'a+');
        flock($file, LOCK_EX);
        fwrite($file, $text_to_log);
        flock($file, LOCK_UN); //Снятие блокировки
        fclose($file);
	}

}
?>