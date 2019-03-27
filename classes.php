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

    class Curl extends Number
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
            $result = json_decode($out,TRUE);
            $result = $result["_embedded"]["items"];
            foreach ($result as $item){
                $id [] = $item["id"];
            }
            return $id;
        }
    }

    class Essence extends Curl
    {
        private $idFild;

        public function createEssence ($arr, string $essense, string $link) {
            $arrIdEssense = [];
            $id=[];
            foreach ($arr as $item) {
                $data = [];
                foreach($item as $value) {
                    $data["add"][] = ['name'=>$essense . $value];
                }
//
                $arrIdEssense[]=$this->getCurl($data, $link);
            }
            foreach ($arrIdEssense as $key) {
                       foreach ($key as $value){
                             $id[] = $value;
                }
            }
            return $arrIdEssense;
        }

        public function createId($arr){
            $id = [];
            foreach ($arr as $key) {
                foreach ($key as $value){
                    $id[] = $value;
                }
            }
            return $id;
        }

        public function createEssenceCustomer ($arr, string $essense, string $link)
        {
            $arrIdEssense = [];
            $id = [];
            foreach ($arr as $item) {
                $data = [];
                foreach ($item as $value) {
                    $data["add"][] = ['name' => $essense . $value, 'next_date' => '1561798500'];
                }
                $arrIdEssense[] = $this->getCurl($data, $link);
            }
            foreach ($arrIdEssense as $key) {
                foreach ($key as $value){
                    $id[] = $value;
                }
            }
            return $id;
        }


        public function upEssence ($arr, $idContacts, $idLeads, $idCustomers, $link)
        {
            $j = 0;
            foreach ($arr as $value){
                $data = [];
                foreach ($value as $item) {
                    $data['update'][] = ['id'=>$item,'updated_at'=>'1572173100','leads_id'=>$idLeads[$j],
                                         'contacts_id'=>$idContacts[$j],'customers_id'=>$idCustomers[$j]];
                    $j++;
                }
                $headers[] = "Accept: application/json";
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
                curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-undefined/2.0");
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curl, CURLOPT_URL, $link);
                curl_setopt($curl, CURLOPT_HEADER,false);
                curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
                curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
                $out = curl_exec($curl);
                curl_close($curl);
                $result = json_decode($out,TRUE);
            }
        }

        public function createFilds () {
            $data = array (
                'add' =>
                    array (
                        0 =>
                            array (
                                'name' => 'Мультисписок',
                                'type' => '5',
                                'element_type' => '1',
                                'origin' => '33333',
                                'is_editable' => '1',
                                'enums' =>
                                    array (
                                        0 => '1',
                                        1 => '2',
                                        2 => '3',
                                        3 => '4',
                                        4 => '5',
                                        5 => '6',
                                        6 => '7',
                                        7 => '8',
                                        8 => '9',
                                        9 => '10',
                                    ),
                            ),
                    ),
            );
            $this->idFild = $this->getCurl($data,'fields');
            return $this->idFild;
        }

        public function getIdFilds(){
            $b = [];
            $a = $this->idFild;
            $link = 'https://aagadullin.amocrm.ru/api/v2/account?with=custom_fields';
            $headers[] = "Accept: application/json";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-undefined/2.0");
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_URL, $link);
            curl_setopt($curl, CURLOPT_HEADER,false);
            curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
            curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
            $out = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($out,TRUE);
            $result = $result['_embedded']['custom_fields']['contacts'][$a[0]]['enums'];
            foreach($result as $key => $value){
                $b[] = $key;
            }
            return $b;
        }

        public function upContact($arr, $idLeads, $idCustomers, $getIdfields,$link)
        {
            $j = 0;
            foreach ($arr as $value) {
                $data = [];
                foreach ($value as $item){
                    $data['update'][] = ['id'=>$item, 'updated_at'=>'1572173100', 'leads_id'=>$idLeads[$j],
                                         'customers_id'=>$idCustomers[$j], 'custom_fields'=>[0=>['id'=>$this->idFild[0],
                                         'values'=>[$getIdfields[rand(0,9)],$getIdfields[rand(0,9)],
                                             $getIdfields[rand(0,9)],$getIdfields[rand(0,9)],$getIdfields[rand(0,9)]]]]];
                    $j++;
                }
                $headers[] = "Accept: application/json";
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
                curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-undefined/2.0");
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curl, CURLOPT_URL, $link);
                curl_setopt($curl, CURLOPT_HEADER,false);
                curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
                curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
                $out = curl_exec($curl);
                curl_close($curl);
                $result = json_decode($out,TRUE);
            }
        }

        public $idFieldText;

        public function addFieldText($link, $a){
            $data = array (
                'add' =>
                    array (
                        0 =>
                            array (
                                'name' => 'text',
                                'type' => "1",
                                'element_type' => $a,
                                'origin' => '321',
                                'is_editable' => '1',
                            ),
                    ),
            );
            return $this->idFieldText=$this->getCurl($data,$link);
        }

        public function createFieldText($valueId, $value, $link, $idFil = 0){
            $data = array (
                'update' =>
                    array (
                        0 =>
                            array (
                                'id' => $valueId,
                                'updated_at' => '1582480800',
                                'custom_fields' =>
                                    array (
                                        0 =>
                                            array (
                                                'id' => $idFil,
                                                'values' =>
                                                    array (
                                                        0 =>
                                                            array (
                                                                'value' => $value,
                                                            ),
                                                    ),
                                            ),
                                    ),
                            ),
                    ),
            );
            echo "<pre>";
            print_r($data);
            echo "</pre>";
            return $this->getCurl($data, $link);
        }

        public function response(){
            $link = 'https://aagadullin.amocrm.ru/api/v2/account?with=custom_fields';
            $headers[] = "Accept: application/json";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-undefined/2.0");
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_URL, $link);
            curl_setopt($curl, CURLOPT_HEADER,false);
            curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
            curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
            $out = curl_exec($curl);
            curl_close($curl);
            return $result = json_decode($out,TRUE);
        }

        public function addNote(string $link,string $idElement,string $typeEssence,string $typeNote,string $text)
        {
            $data = array(
                'add' =>
                    array(
                        0 =>
                            array(
                                'element_id' => $idElement,
                                'element_type' => $typeEssence,
                                'note_type' => $typeNote,
                                'text' => $text,
                            ),
                    ),
            );
            $headers[] = "Accept: application/json";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-undefined/2.0");
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_URL, $link);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . "/cookie.txt");
            curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . "/cookie.txt");
            $out = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($out, TRUE);
            echo "<pre>";
            var_dump($result);
            echo "</pre>";
        }

        public function addTask ($idEssence, $typeEssence, $dateFinish, $taskType, $text, $responsibleUser) {

            $data = array (
                'add' =>
                    array (
                        0 =>
                            array (
                                'element_id' => $idEssence,
                                'element_type' => $typeEssence,
                                'complete_till' => $dateFinish,
                                'task_type' => $taskType,
                                'text' => $text,
                                'responsible_user_id' => $responsibleUser,
                            ),
                    ),
            );
            $link = "https://aagadullin.amocrm.ru/api/v2/tasks";
            $headers[] = "Accept: application/json";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-undefined/2.0");
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_URL, $link);
            curl_setopt($curl, CURLOPT_HEADER,false);
            curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
            curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
            $out = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($out,TRUE);
            return $result = $result["_embedded"]["items"][0]['id'];
        }

        public function closeTask($idTask, $dataClose, $text){
            $data = array (
                'update' =>
                    array (
                        0 =>
                            array (
                                'id' => $idTask,
                                'updated_at' => $dataClose,
                                'text' => $text,
                                'is_completed' => '1',
                            ),
                    ),
            );
            $link = "https://aagadullin.amocrm.ru/api/v2/tasks";
            $headers[] = "Accept: application/json";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-undefined/2.0");
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_URL, $link);
            curl_setopt($curl, CURLOPT_HEADER,false);
            curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
            curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
            $out = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($out,TRUE);
        }
    }










