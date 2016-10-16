<?php
class Crypto {

    private $algorithm = 'sha256';

    public function setAlgorithm($algorithm) {
        $this->algorithm = $algorithm;
    }

    public function generateHash() {
       // return sha1(uniqid().rand(0, 9999));
        return hash_hmac('ripemd160', uniqid(), md5(time()));
    }    

    public function generateSalt($max_length = 7) {
    	$max_length = (int) $max_length;
    	$hash = $this->generateHash();
        return substr($hash, 0, $max_length); 
    }   
  

    public function passwordHashing($password) {
        $salt = '$5$'.$this->generateSalt(11).'$'; // SHA-256
        $hashed_password = crypt($password, $salt);
        return array('hashed_password' => $hashed_password,
                     'salt' => $salt);
    }

    /**
     * @desc <string> hashed_password - Зашифрованный пароль
     * @desc <string> password        - Пароль, отправленный пользователем
     * @desc <string> salt            - Соль, например из базы данных
     *
     * @return <boolean> true           Если пароль + соль ==  хешированный пароль
     * @return <boolean> false          Если пароль + соль !=  хешированный пароль
     *
     */

    public function checkPassword($hashed_password, $password, $salt) {
       if(crypt($password, $salt) == $hashed_password) {
           return true;
       } else {
           return false;
       }
    }


}
?>