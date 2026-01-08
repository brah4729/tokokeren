<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function checkout()
    {
        $cart = $this->getCart();
        
        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        
        return view('checkout.index', compact('cart'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:stripe,paypal,mock',
            'stripeToken' => 'required_if:payment_method,stripe'
        ]);

        $cart = $this->getCart();

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total_amount' => $cart->total(),
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending'
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ]);
            }

            if ($request->payment_method === 'stripe') {
                \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
                
                $charge = \Stripe\Charge::create([
                    'amount' => $cart->total() * 100,
                    'currency' => 'usd',
                    'source' => $request->stripeToken,
                    'description' => 'Order ' . $order->order_number,
                ]);

                $order->update([
                    'payment_status' => 'paid',
                    'stripe_payment_id' => $charge->id,
                    'status' => 'paid'
                ]);
            } elseif ($request->payment_method === 'mock') {
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'paid',
                    'payment_method' => 'mock_test_payment'
                ]);
            }

            foreach ($cart->items as $item) {
                $item->product->reduceStock($item->quantity);
            }

            $cart->items()->delete();

            DB::commit();

            DB::commit();

            return redirect()->route('checkout.success', $order);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        return view('checkout.success', compact('order'));
    }

    private function getCart()
    {
        if (auth()->check()) {
            return Cart::with('items.product')->firstOrCreate(['user_id' => auth()->id()]);
        }
        
        $sessionId = session()->getId();
        return Cart::with('items.product')->firstOrCreate(['session_id' => $sessionId]);
    }
}
?>