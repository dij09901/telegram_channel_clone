<?php

namespace App\Telegram;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use Illuminate\Support\Facades\Log;
use DefStudio\Telegraph\Telegraph;

class Handler extends WebhookHandler
{
    /**
     * @param string $name
     * @return void
     */
    public function hello(string $name = ''): void
    {
        $this->reply(message: "Привіт $name це твій перший бот");
    }

    /**
     * @param \Stringable $text
     * @return void
     */
    protected function handleUnknownCommand(\Stringable $text): void
     {
        if ($text->value() == '/start' ){
            $this->reply(message: "Привіт Денис");
        }else{
            $this->reply(message: "Невідома команда");
        }
     }

//    protected function handleChatMessage(\Stringable $text): void
//    {
//        Log::info('Received Telegram message:', ['text' => $text]);
//
//        $sourceChannelId = config('telegraph.source_channel_id');
//        $destinationChatId = config('telegraph.destination_chat_id');
//
//        $message = $this->message->text;
//        $chatId = $this->message->chat->id;
//
//        if ($chatId != $sourceChannelId) {
//            Log::info('Message ignored from chat ID: ' . $chatId);
//            return;
//        }
//
//        if ($this->isMessageRelevant($message)) {
//            Telegraph::message($message)
//                ->chat($destinationChatId)
//                ->send();
//
//            Log::info('Message forwarded:', ['text' => $message]);
//        } else {
//            Log::info('Message ignored due to filter:', ['text' => $message]);
//        }
//    }

    protected function handleChatMessage(\Stringable $text): void
    {
        logger(json_encode($this->message->toArray(), JSON_UNESCAPED_UNICODE));
    }
}
