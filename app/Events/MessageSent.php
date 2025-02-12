<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;
    public $socket_id;

    public function __construct($message, $socket_id)
    {
        Log::debug('MessageSent Event Initialized');  // イベントが初期化されたことをログに出力
        Log::debug("Message: $message");  // 受け取ったメッセージをログに出力
        Log::debug("Socket ID: $socket_id");  // 受け取ったsocket_idをログに出力
        $this->message = $message;
        $this->socket_id = $socket_id;
    }

    public function broadcastOn()
    {
        Log::debug('broadcastOn Called');  // broadcastOnが呼ばれたことをログに出力
        return new Channel('chat');
    }

    public function broadcastWith()
    {
        Log::debug('broadcastWith Called');  // broadcastWithが呼ばれたことをログに出力
        return [
            'message' => $this->message,
            'socket_id' => $this->socket_id,
        ];
    }
}
