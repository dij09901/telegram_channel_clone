<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class TelegramController extends Controller
{
    public function receiveMessage(Request $request)
    {
        logger('Received message from Pyrogram: ');
//        logger('Received message from Pyrogram: ' . json_encode($request->all()));

        // Ваш код для обробки повідомлення, наприклад, збереження в базу даних або пересилання до іншого каналу
        // ...

        return response()->json(['status' => 'success']);
    }
}
