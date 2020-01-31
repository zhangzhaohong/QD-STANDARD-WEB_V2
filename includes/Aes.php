<?php
    
    class Security {
        
        //public static $key_128 = "iloveywy.5201314";
        
        //public static $key_256 = "com.autumn.reptile@autumn|zzh626";

        public static $key_128 = "";

        public static $key_256 = "";

        public static function get_256_key(){
            Security::$key_256 = $GLOBALS['key_256'];
        }

        public static function get_128_key(){
            Security::$key_128 = $GLOBALS['key_128'];
        }

        public static function set_256_key($string){
            Security::$key_256 = $string;
        }

        /*public static function set_128_key($string){
            Security::$key_128 = $string;
        }*/

        /**
         *
         * @param string $string 需要加密的字符串
         * @param string $key 密钥
         * @return string
         */

        public static function encrypt($string) {

            //Security::get_256_key();

            if (Security::$key_256 == null || Security::$key_256 == "")
                exit(JSON(array("code"=>-100,"msg"=>"KEY无效，请联系管理员")));

            // openssl_encrypt 加密不同Mcrypt，对秘钥长度要求，超出16加密结果不变
            $data = openssl_encrypt($string, 'AES-256-ECB', Security::$key_256, OPENSSL_RAW_DATA);

            $data = strtolower(bin2hex($data));

            return $data;

        }

        /**
         * @param string $string 需要解密的字符串
         * @param string $key 密钥
         * @return string
         */

        public static function decrypt($string) {

            //Security::get_256_key();

            if (Security::$key_256 == null || Security::$key_256 == "")
                exit(JSON(array("code"=>-100,"msg"=>"KEY无效，请联系管理员")));

            $decrypted = openssl_decrypt(hex2bin($string), 'AES-256-ECB', Security::$key_256, OPENSSL_RAW_DATA);

            return $decrypted;

        }
        
        /**
         *
         * @param string $string 需要加密的字符串
         * @param string $key 密钥
         * @return string
         */
        
        public static function public_encrypt($string) {

            Security::get_256_key();

            if (Security::$key_256 == null || Security::$key_256 == "")
                exit(JSON(array("code"=>-100,"msg"=>"KEY配置无效，请联系管理员")));

            // openssl_encrypt 加密不同Mcrypt，对秘钥长度要求，超出16加密结果不变
            $data = openssl_encrypt($string, 'AES-256-ECB', Security::$key_256, OPENSSL_RAW_DATA);
            
            $data = strtolower(bin2hex($data));
            
            return $data;
            
        }
        
        /**
         * @param string $string 需要解密的字符串
         * @param string $key 密钥
         * @return string
         */
        
        public static function public_decrypt($string) {

            Security::get_256_key();

            if (Security::$key_256 == null || Security::$key_256 == "")
                exit(JSON(array("code"=>-100,"msg"=>"KEY配置无效，请联系管理员")));

            $decrypted = openssl_decrypt(hex2bin($string), 'AES-256-ECB', Security::$key_256, OPENSSL_RAW_DATA);
            
            return $decrypted;
            
        }
        
        /**
         *
         * @param string $string 需要加密的字符串
         * @param string $key 密钥
         * @return string
         */
        
        public static function encryptOldVersion($string) {

            Security::get_128_key();

            if (Security::$key_128 == null || Security::$key_128 == "")
                exit(JSON(array("code"=>-100,"msg"=>"KEY配置无效，请联系管理员")));
            
            // openssl_encrypt 加密不同Mcrypt，对秘钥长度要求，超出16加密结果不变
            $data = base64_encode(openssl_encrypt($string, 'AES-128-ECB', Security::$key_128, OPENSSL_RAW_DATA));
            
            //$data = strtolower(bin2hex($data));
            
            return $data;
            
        }
        
        /**
         * @param string $string 需要解密的字符串
         * @param string $key 密钥
         * @return string
         */
        
        public static function decryptOldVersion($string) {

            Security::get_128_key();

            if (Security::$key_128 == null || Security::$key_128 == "")
                exit(JSON(array("code"=>-100,"msg"=>"KEY配置无效，请联系管理员")));

            $decrypted = openssl_decrypt(base64_decode($string), 'AES-128-ECB', Security::$key_128, OPENSSL_RAW_DATA);
            
            return $decrypted;
            
        }
        
    }

?>
