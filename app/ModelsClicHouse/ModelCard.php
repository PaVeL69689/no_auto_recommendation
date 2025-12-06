<?php
    namespace App\ModelsClicHouse;
    use ClickHouseDB;

    class ModelCard{

        protected $table = 'car_card';

        protected $connect = null;

        public function __construct() {
            $config = [
                'host' => env('CLICKHOUSE_HOST'),
                'port' => env('CLICKHOUSE_PORT'),
                'username' => env('CLICKHOUSE_USER'),
                'password' => env('CLICKHOUSE_PASSWORD'),
                'https' => false
            ];
            
            $this->connect = new ClickHouseDB\Client($config);
            $this->connect->database(env('CLICKHOUSE_DATABASE'));
            $this->connect->setTimeout(1.5);      // 1 second , support only Int value
            $this->connect->setTimeout(10);       // 10 seconds
            $this->connect->setConnectTimeOut(5); // 5 seconds
            $this->connect->ping(true); // если не удается подключиться, возникает исключение
        }

        public function get($user){
            $data = $this->connect->select("SELECT * FROM $this->table WHERE `user_id`=$user");
            return $data->rows();
        }
        public function createOf($message, $user){
            $this->connect->insert($this->table,
                [
                    [
                        $message->id,
                        $message->category_id,
                        $message->model_id,
                        $message->drive_id,
                        $message->transmission_id,
                        $message->bodywork_id,
                        $message->color_id,
                        (int)$message->sign,
                        $message->mark_id,
                        $message->engine_id,
                        $user,
                    ],
                ],
                [
                    'id',
                    'category_id', 
                    'model_id', 
                    'drive_id',
                    'transmission_id', 
                    'bodywork_id', 
                    'color_id', 
                    'sign',
                    'mark_id',
                    'engine_id',
                    'user_id',
                ]
            );
        }
        public function deleteOf(){
            $this->connect->write("DELETE FROM example_table 
                 WHERE `name`='mishail' AND `age`='32' AND `user_id`='2'
            ");
        }

                    // id UInt32,
                    // category_id UInt32,
                    // model_id UInt32,
                    // drive_id UInt32,
                    // transmission_id UInt32,
                    // bodywork_id UInt32,
                    // color_id UInt32,
                    // sign UInt32,
                    // mark_id UInt32,
                    // engine_id UInt32,
                    // timestamp DateTime64(3), 
    }