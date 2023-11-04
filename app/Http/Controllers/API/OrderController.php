<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;

// use App\Services\Midtrans\CreatePaymentUrlService;
// use App\Models\User;
// use Kreait\Firebase\Messaging\CloudMessage;
// use Kreait\Firebase\Messaging\Notification;

class OrderController extends Controller
{
    // public function sendNotificationToUser($userId, $message)
    // {
    //     // Dapatkan FCM token user dari tabel 'users'

    //     $user = User::find($userId);
    //     $token = $user->fcm_token;

    //     // Kirim notifikasi ke perangkat Android
    //     $messaging = app('firebase.messaging');
    //     $notification = Notification::create('Order Masuk', $message);

    //     $message = CloudMessage::withTarget('token', $token)
    //         ->withNotification($notification);

    //     $messaging->send($message);
    // }
    public function order(Request $request)
    {
        
        // dd($request);
        // $order = Order::create([
        //     'id_user' => 1,
        //     'id_member' => $request->id_member,
        //     'total_item' => $request->total_item,
        //     'total_harga' => $request->total_harga,
        //     'alamat' => $request->alamat,
        //     'status' => 'Pending',
            
        // ]);
        
        // foreach ($request->items as $item) {
        //     OrderItem::create([
        //         'id_penjualan' => $order->id_penjualan,
        //         'id_produk' => $item['id_produk'],
        //         'harga_jual' => $item['harga_jual'],
        //         'jumlah' => $item['jumlah'],
        //         'diskon' => $item['diskon'],
        //         'subtotal' => $item['subtotal'],
        //     ]);
        // }

        // $this->sendNotificationToUser($request->seller_id, 'Order ' . $request->total_price . ' Masuk, Menunggu Pembayaran');
        // $midtrans = new CreatePaymentUrlService();
        // $paymentUrl = $midtrans->getPaymentUrl($order->load('user', 'orderItems'));


        // $order->update([
        //     'payment_url' => $paymentUrl
        // ]);
        return response()->json([
            'success'=>true,
            'data' => $request->items
        ],201);
    }
}
