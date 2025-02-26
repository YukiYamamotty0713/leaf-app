<script setup>
import { ref, onMounted } from "vue";
import Echo from "laravel-echo";
import Pusher from "pusher-js";
import { usePage } from "@inertiajs/vue3";

const message = ref("");
const messages = ref([]);
const socketId = ref("");

const sendMessage = async () => {
    await fetch("/send-message", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ 
            message: message.value,
            socket_id: socketId.value // socket_idも送信
        }),
    });

    console.log(message.value);
    console.log(messages.value);
    message.value = "";
};

const pageProps = usePage().props;

onMounted(() => {
    window.Pusher = Pusher;
    window.Echo = new Echo({
        broadcaster: "pusher",
        key: pageProps.pusher.key,
        cluster: pageProps.pusher.cluster,
        forceTLS: true,
    });

        window.Echo.channel("chat").listen("MessageSent", (event) => {
        console.log("Received event:", event);  // イベント全体を確認
        console.log("Message:", event.message);  // メッセージの中身を確認        
        messages.value.push(event.message);
        console.log("Socket ID from event:", event.socket_id); // socket_id を確認
    });

    window.Echo.connector.pusher.connection.bind('connected', function() {
        socketId.value = window.Echo.connector.pusher.connection.socket_id;
        console.log("Socket ID: ", socketId.value); // socket_idを確認
    });

    // Pusherの接続状態を監視
    window.Echo.connector.pusher.connection.bind('state_change', (states) => {
        console.log('Pusher Connection State:', states.current);
    });

    // 接続成功時にログを出力
    window.Echo.connector.pusher.connection.bind('connected', () => {
        console.log('✅ WebSocket接続が確立されました');
    });

    // 接続エラー時にログを出力
    window.Echo.connector.pusher.connection.bind('error', (err) => {
        console.error('❌ WebSocket接続エラー:', err);
    });
});
</script>
<template>
    <div class="p-6">
        <h1 class="text-xl font-bold">リアルタイムチャット</h1>
        <div class="border p-4 mt-4 h-64 overflow-y-auto">
            <div v-for="(msg, index) in messages" :key="index" class="p-2 border-b">{{ msg }}</div>
        </div>
        <div class="mt-4 flex">
            <input v-model="message" type="text" class="border p-2 flex-1" placeholder="メッセージを入力">
            <button @click="sendMessage" class="ml-2 bg-blue-500 text-white p-2">送信</button>
        </div>
    </div>
</template>
