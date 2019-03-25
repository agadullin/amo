<?php
/**
 * Created by PhpStorm.
 * User: aagadullin
 * Date: 25.03.2019
 * Time: 9:26
 */

    class Authorization
    {
        public function getAuth()
        {
            $user=array(
                'USER_LOGIN'=>'aagadullin@team.amocrm.com',
                'USER_HASH'=>'caa6ad4f93ab7f3ad323f10bda66a6f0f34d4cc4'
            );
            $subdomain='aagadullin';
            $link='https://'.$subdomain.'.amocrm.ru/private/api/auth.php?type=json';
            $curl=curl_init();
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
            curl_setopt($curl,CURLOPT_URL,$link);
            curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
            curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($user));
            curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
            curl_setopt($curl,CURLOPT_HEADER,false);
            curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt');
            curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt');
            curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
            curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
            $out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
            $code=curl_getinfo($curl,CURLINFO_HTTP_CODE); #Получим HTTP-код ответа сервера
            curl_close($curl);
            $code=(int)$code;
            $errors=array(
                301=>'Moved permanently',
                400=>'Bad request',
                401=>'Unauthorized',
                403=>'Forbidden',
                404=>'Not found',
                500=>'Internal server error',
                502=>'Bad gateway',
                503=>'Service unavailable'
            );
            try
            {
                if($code!=200 && $code!=204)
                    throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
            }
            catch(Exception $E)
            {
                die('Ошибка: '.$E->getMessage().PHP_EOL.'Код ошибки: '.$E->getCode());
            }
            $Response=json_decode($out,true);
            $Response=$Response['response'];
            if(isset($Response['auth']))
                return 'Авторизация прошла успешно';
            return 'Авторизация не удалась';
        }
    }


    class Number
    {
        private $num;

        private function setNum()
        {
            $this->num = $_POST['getValue'];
        }

        private function getNum()
        {
            $arrNum = [];

            for ($i = 0; $i < $this->num; $i++) {
                $arrNum[] = $i;
            }

            return array_chunk($arrNum, 250, TRUE);
        }

        public function checkNum ()
        {
            $this->setNum();

            if ($this->num > 0 && $this->num < 10001) {
                return $this->getNum();
            } else {
                echo 'Введите корректное число!';
            }
        }
    }

    class Curl
    {
        public function getCurl($data, $link)
        {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-undefined/2.0");
            curl_setopt($curl, CURLOPT_HTTPHEADER, ["Accept: application/json"]);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_URL, "https://aagadullin.amocrm.ru/api/v2/{$link}");
            curl_setopt($curl, CURLOPT_HEADER,false);
            curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
            curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
            $out = curl_exec($curl);
            curl_close($curl);
            return $result = json_decode($out,TRUE);
        }
    }










//    echo '<pre>';
//var_dump($num->checkNum());
//    echo '</pre>';