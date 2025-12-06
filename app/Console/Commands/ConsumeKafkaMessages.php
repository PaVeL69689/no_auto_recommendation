<?php

namespace App\Console\Commands;

use App\ModelsClicHouse\ModelCard;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Junges\Kafka\Facades\Kafka;

class ConsumeKafkaMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:consume-messages';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $this->info('Starting Kafka Consumer at: ' . now()->toDateTimeString());
        $cons = Kafka::consumer(['first-topic'], 'advice-back-group', 'kafka:9092')
        ->withOptions([
            'auto.offset.reset' => 'earliest',
            'enable.auto.commit' => 'false',
        ])
        ->withHandler(function($message, $consumer) {
            $this->info('Received message:');

            try 
            {
                $data = json_decode($message->getBody());
                if($data->action == 'setRecomenndation'){
                    foreach($data->data as $card){
                        (new ModelCard)->createOf($card, $data->user_id);
                    }

                    $consumer->commit($message);
                }

                if($data->action == 'getRecomendation'){
                    $cards = (new ModelCard)->get($data->user_id);
                    
                    $this->producerMessage($cards, $data->correlation_id);
                    $consumer->commit($message);
                }

            }
            catch(Exception $error){
                Log::info('error', [
                    'message' => $message->getBody(),
                    'error' => $error->getMessage()
                ]);
                $this->info("error".$error->getMessage());
            }
        })->build();

            $this->info('Consumer built successfully');
            $this->info('Listening for messages...');
        $cons->consume();
    }
    protected function producerMessage($data, $correlationId){
        $producer = Kafka::publish('kafka:9092')
            ->onTopic('response-topic')
            ->withBody(json_encode([
                'cards'=>$data,
                'correlation_id' => $correlationId,
                'timestamp' => now()->toISOString(),
                'action' => 'getRecomenndation'
            ]))->send();
    }
}
