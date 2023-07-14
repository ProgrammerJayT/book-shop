<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceOrderMailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // $todayDate = Carbon::now();
        // $orders = Order::whereDate('created_at', $todayDate)->paginate(10);

        $todayDate = Carbon::now()->format('Y-m-d');

        $orders = Order::when($request->date != null, function($q) use($request){
           return $q->whereDate('created_at', $request->date);

        }, function($q) use($todayDate){
           return $q->whereDate('created_at', $todayDate);
        })
        ->when($request->status != null, function($q) use($request){
           return $q->where('status', $request->status);

        })
        ->paginate(5);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(int $orderId)
    {
        $order = Order::where('order_id', $orderId)->first();
        if ($order) {
            return view('admin.orders.view', compact('order'));
        } else {
            return redirect('admin/orders')->with('message', 'Order Id Not Found');
        }
    }

    public function updateOrderStatus(int $orderId, Request $request)
    {
        $order = Order::where('order_id', $orderId)->first();
        if ($order) {
            if ($request->order_status == '') {
                return redirect('admin/orders/' . $orderId)->with(
                    'message', 'Nothing to Update'
                );
            } else {
                $order->update([
                    'status' => $request->order_status,
                ]);
                return redirect('admin/orders/' . $orderId)->with(
                    'message', 'Order Status Updated'
                );
            }
            

        } else {
            return redirect('admin/orders/'.$orderId)->with(
                'message', 'Order Id Not Found'
            );
        }
    }

    public function viewInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('admin.invoice.generate-invoice', compact('order'));
    }

    public function generateInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];
        $todayDate = Carbon::now()->format('d-m-Y');
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        return $pdf->download('invoice-'.$orderId.'-'.$todayDate.'.pdf');
    }

    public function mailInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];
        $email = $order->user->email;
        $messageText = 'Hi '.$order->user->name.'! Thank you for your Order.';
        $maildata = [
            "subject" => "Your Order Invoice",
            "message" => $messageText,
        ];
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);

        if ($email) {
            try {
                Mail::to($email)->send(new InvoiceOrderMailable($pdf, $maildata));
                return redirect('admin/orders/' . $orderId)->with('message', 'Invoice Mail has been sent to ' . $email);
            } catch (\Exception $e) {
                return redirect('admin/orders/' . $orderId)->with('message', 'Something went wrong');
            }
        } else {
            return redirect('admin/orders/' . $orderId)->with('message', 'Please provide email');
        }         
    }
}
