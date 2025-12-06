<?php

namespace App\Listeners;

use App\Events\CardEvent;
use App\ModelsClicHouse\ModelCard;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Junges\Kafka\Facades\Kafka;

class CardNotification
{
    /**
     * Create the event listener.
     */

    public function __construct()
    {
       $consumer = Kafka::consumer(['topic-1'], 'group-id', 'broker');
    }

    /**
     * Handle the event.
     */
    public function handle(CardEvent $event): void
    {
        // try
        // {
        //     (new ModelCard())->createOf($event->message);
            
        // }
        // catch(Exception $error)
        // {
        //     Log::error('Failed to process Kafka message via Event', [
        //         'topic' => $event->topic,
        //         'offset' => $event->offset,
        //         'error' => $error->getMessage(),
        //     ]);
        // }
        // $this->release(60);
    }

}
