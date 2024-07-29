<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use danog\MadelineProto\API;
use danog\MadelineProto\Exception;
use danog\MadelineProto\Settings;
use Revolt\EventLoop;
use Illuminate\Support\Facades\Http;

class TelegramClientCommand extends Command
{
    protected $signature = 'telegram:client';
    protected $description = 'Run Telegram client to fetch updates';

    public function handle()
    {
        $apiId = env('TELEGRAM_API_ID');
        $apiHash = env('TELEGRAM_API_HASH');
        $sourceChaneelID = env('TELEGRAM_SOURCE_CHANNEL_ID');
        $destinationChatID = env('TELEGRAM_DESTINATION_CHAT_ID');
        $botToken = env('TELEGRAM_BOT_TOKEN');

        $settings = new \danog\MadelineProto\Settings();
        $settings->getAppInfo()->setApiId($apiId)->setApiHash($apiHash);

        $madelineProto = new API('session.madeline', $settings);

        try {
            $madelineProto->start();

            $this->info('Logged in successfully!');
        } catch (\Throwable $e) {
            $this->error("Error during login: " . $e->getMessage());
            return;
        }

        // Set up signal handling
        EventLoop::unreference(EventLoop::onSignal(SIGINT, function (string $watcherId) {
            $this->info("SIGINT received. Terminating gracefully...");
            EventLoop::cancel($watcherId);
            exit(0);
        }));

        // Set up global error handler for the event loop
        EventLoop::setErrorHandler(function (\Throwable $e) {
            $this->error("Uncaught exception: " . $e->getMessage());
        });

        $offsetId = 0;
        while (true) {
            try {
                $updates = $madelineProto->getUpdates([
                    'offset' => $offsetId,
                    'limit' => 100,
                    'timeout' => 10
                ]);

//                $madelineProto->logger($offsetId);

                foreach ($updates as $update) {
//                    $madelineProto->logger($updates);
                    if ($offsetId != $update['update_id']) {
                        $offsetId = $update['update_id'];
                        if (isset($update['update']['message'])) {
                            $peer_id = $update['update']['message']['peer_id'];

                            if ($peer_id == $sourceChaneelID) {
                                $message = $update['update']['message']['message'];
                                if ($this->filterMessage($message)) {
                                    $this->sendMessageToTelegramBot($botToken, $destinationChatID, $message);

                                    #TODO
//                                $madelineProto->messages->sendMessage([
//                                    'peer' => '',
//                                    'message' => $message.'HUY'
//                                ]);
                                    $madelineProto->logger($message);
                                    $this->info("Message forwarded to bot");
                                }
                            }
                        }
                    }
                }
            } catch (Exception $e) {
                $this->error("Error during fetching updates: " . $e->getMessage());
            }
        }
    }

    /**
     * @param $messageText
     * @return bool
     */
    private function isMessageRelevant($messageText): bool
    {
        $keywords = [
            "key_1",
            "key_2",
            "key_3"
        ];

        foreach ($keywords as $keyword) {
            if (stripos($messageText, $keyword) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $messageText
     * @return bool
     */
    private function filterMessage($messageText): bool
    {
        // Retrievable array of keys, minds and values from .env
        $queryKeys = json_decode(env('QUERY_KEYS'), true);
        $querySigns = json_decode(env('QUERY_SIGNS'), true);
        $queryValues = json_decode(env('QUERY_VALUES'), true);

        // The change is initialized to confirm the filtering result
        $isValid = true;

        // We sort through the key, sign and meaning
        foreach ($queryKeys as $index => $key) {
            // Let's check the main sign and meaning for the stream index
            if (isset($querySigns[$index]) && isset($queryValues[$index])) {
                $sign = $querySigns[$index];
                $value = (float) $queryValues[$index];

                // Looks like the exact key is from a friend
                if (preg_match("/{$key}:\s*([\d.]+)/", $messageText, $matches)) {
                    $messageValue = (float) $matches[1];

                    // Let's check the mind behind the help of dynamic operators
                    $condition = eval("return \$messageValue $sign \$value;");

                    if (!$condition) {
                        $isValid = false;
                        break; // The cycle is overworked because the mind does not end
                    }
                } else {
                    $isValid = false; // If the key is not found on the account, please inform the invalid
                    break; // The cycle is iterated because the key is not found
                }
            } else {
                $isValid = false; // Since it is important or important on a daily basis, we would like to inform you that it is not valid
                break; // We rotate the cycle either mentally or daily
            }
        }

        // Rotating the filtering result
        return $isValid;
    }

    private function sendMessageToTelegramBot($botToken, $chatId, $message)
    {
        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";

        $response = Http::post($url, [
            'chat_id' => $chatId,
            'text' => $message
        ]);

        if ($response->failed()) {
            $this->error("Failed to send message through bot: " . $response->body());
        }
    }
}
