<?php
use App\Http\Controllers\ChatController;

Route::post('/chat', action: [ChatController::class, 'sendChat']);
