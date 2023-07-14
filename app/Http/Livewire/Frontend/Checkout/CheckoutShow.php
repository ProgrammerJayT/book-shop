<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\User;
use App\Models\Order;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceOrderMailable;
use Illuminate\Support\Facades\Mail;

class CheckoutShow extends Component
{
    public $categories, $carts, $totalBookAmount = 0;
    public $fullname, $email, $phone, $zipcode, $address, $payment_mode = NULL, $payment_id = NULL; 

    public function validationForAll()
    {
        $this->validate();
    }

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|max:11|min:10',
            'zipcode' => 'required|string|max:6|min:4',
            'address' => 'required|string|max:500',
        ];
    }

    public function placeOrder()
    {
        $this->validate();
        $order = Order::create([
            'user_id' => auth()->user()->user_id,
            'address' => $this->address,
            'zip_code' => $this->zipcode,
            'status' => 'In Progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);
        foreach ($this->carts as $cartItem) {
            $orderItems = OrderItem::create([
                'order_id' => $order->order_id,
                'book_id' => $cartItem->book_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->book->price,
            ]);
        }
        if ($order) {
            $user = User::findOrFail(auth()->user()->user_id);
            if ($user->phone == '' || $user->address == '' || $user->zip_code == '') {
                $order->user()->update([
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'zip_code' => $this->zipcode,
                ]);
            }
        }

        return $order;
    }

    public function cashOrder()
    {
        $this->payment_mode = 'Cash';
        $cashOrder = $this->placeOrder();
        if ($cashOrder) {
            CartItem::where('user_id', auth()->user()->user_id)->delete();
            try {
                $order = Order::findOrFail($cashOrder->order_id);
                $data = ['order' => $order];
                $email = $order->user->email;
                $messageText = 'Hi ' . $order->user->name . '! Thank you for your Order.';
                $maildata = [
                    "subject" => "Your Order Invoice",
                    "message" => $messageText,
                ];
                $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
                if ($email) {
                    Mail::to($email)->send(new InvoiceOrderMailable($pdf, $maildata));
                }else {
                    $this->dispatchBrowserEvent('error', [
                        'message' => "Invalid email",
                    ]);
                } 
            } catch (\Exception $e) {
                $this->dispatchBrowserEvent('error', [
                    'message' => "Something went wrong",
                ]);
            }
            session()->flash('message', 'Order Placed Successfully');
            $this->dispatchBrowserEvent('success', [
                'message' => "Order Placed Successfully",
            ]);

            return redirect()->to('thank-you');
        } else {
            $this->dispatchBrowserEvent('error', [
                'message' => "Something went wrong",
            ]);
        }
    }

    public function paidOnlineOrder()
    {
        $this->payment_id = random_int(1000000000000,9999999999999);
        $this->payment_mode = 'Online';
        
        $cashOrder = $this->placeOrder();
        if ($cashOrder) {
            CartItem::where('user_id', auth()->user()->user_id)->delete();
            try {
                $order = Order::findOrFail($cashOrder->order_id);
                $data = ['order' => $order];
                $email = $order->user->email;
                $messageText = 'Hi ' . $order->user->name . '! Thank you for your Order.';
                $maildata = [
                    "subject" => "Your Order Invoice",
                    "message" => $messageText,
                ];
                $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
                if ($email) {
                    Mail::to($email)->send(new InvoiceOrderMailable($pdf, $maildata));
                } else {
                    $this->dispatchBrowserEvent('error', [
                        'message' => "Invalid email",
                    ]);
                }
            } catch (\Exception $e) {
                $this->dispatchBrowserEvent('error', [
                    'message' => "Something went wrong",
                ]);
            }
            session()->flash('message', 'Order Placed Successfully');
            $this->dispatchBrowserEvent('success', [
                'message' => "Order Placed Successfully",
            ]);
            return redirect()->to('thank-you');
        } else {
            $this->dispatchBrowserEvent('error', [
                'message' => "Something went wrong",
            ]);
        }
    }
    public function totalBookAmount()
    {
        $this->totalBookAmount = 0;
        $this->carts = CartItem::where('user_id', auth()->user()->user_id)->get();
        foreach ($this->carts as $cartItem) {
            $this->totalBookAmount += $cartItem->book->price * $cartItem->quantity;
        }
        return $this->totalBookAmount;
    }

    public function mount($categories)
    {
        $this->categories = $categories;
    }

    public function render()
    {
        $this->fullname = auth()->user()->name ?? "";
        $this->email = auth()->user()->email ?? "";
        $this->phone = auth()->user()->phone ?? "";
        $this->address = auth()->user()->address ?? "";
        $this->zipcode = auth()->user()->zip_code ?? "";
        $this->totalBookAmount = $this->totalBookAmount();
        return view('livewire.frontend.checkout.checkout-show', [
            'categories' => $this->categories,
            'totalBookAmount' => $this->totalBookAmount,
        ]);
    }
}
