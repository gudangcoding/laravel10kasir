<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Produk;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Setting;
use App\Services\Midtrans\CreatePaymentUrlService;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class OrderController extends Controller
{


    public function order(Request $request)
    {
        $order = Order::create([
            'id_member' => $request->user()->id,
            'total_item' => $request->total_item,
            'total_harga' => $request->total_harga,
            'payment_status' => 1,
            'delivery_address' => $request->delivery_address,
        ]);

        foreach ($request->items as $item) {
            OrderItem::create([
                'id_penjualan' => $order->id,
                'id_produk' => $item['id'],
                'jumlah' => $item['jumlah']
            ]);
        }

        $this->sendNotificationToUser($request->seller_id, 'Order ' . $request->total_price . ' Masuk, Menunggu Pembayaran');
        $midtrans = new CreatePaymentUrlService();
        $paymentUrl = $midtrans->getPaymentUrl($order->load('user', 'orderItems'));


        $order->update([
            'payment_url' => $paymentUrl
        ]);
        return response()->json([
            'data' => $order
        ]);
    }
}
