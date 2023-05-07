<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Notifications\Facades\Vonage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller {

    public function redirect() {
        $user = Auth::user();
        $product = Product::paginate(3);
        if ($user->roles == 'user') {
            return view('user.product', compact('product'));
        } else {
            return view('admin.home');
        }
        // return $user;
    }

    public function index() {
        return view('user.home');
    }

    public function showCart() {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->get();
        $sum = 0;
        foreach ($cart as $value) {
            $sum += $value->quantity * $value->price;
        }
        $this->cleanup('carts');
        return view('user.showCart', compact('cart', 'sum'));
    }

    public function confirm(Request $request) {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->get();
        // dd($cart);
        foreach ($cart as $value) {
            $order = Order::create([
                'user_id' => $user->id,
                'quantity' => $value->quantity,
                'product_title' => $value->product->title,
                'product_price' => $value->price,
                //
            ]);
        }
        $product = order::Where('user_id', $user->id)->get();
        // $this->cleanup('carts');
        // $cart = Cart::where('user_id', $user->id)->delete();
        return view('user.payment', compact('product'));
    }

    public function cleanup($table_name) {
        DB::statement("SET @count = 0;");
        DB::statement("UPDATE `$table_name` SET `$table_name`.`id` = @count:= @count + 1;");
        DB::statement("ALTER TABLE `$table_name` AUTO_INCREMENT = 1;");
    }

    public function addCart(Request $request, $id) {

        $product = Product::find($id);
        if (empty($product->quantity)) {
            return redirect()->route('login');
        }
        if (Auth::user()) {
            $user = Auth::user();
            $cart = Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
            ]);
            return redirect()->back();
        }
    }

    public function destroy($id) {
        $product = Cart::findOrFail($id);
        $product->delete();
        $this->cleanup('cart');
        return redirect()->route('showCart');
    }

    public function editForm($id) {

        $cart = Cart::find($id);
        $product = Product::find($cart->product_id);
        return view('user.productEdit', compact('product', 'cart'));
    }

    public function edit(Request $request, $id) {
        $product = Cart::find($id);
        $product->update(['quantity' => $request->quantity]);
        return redirect()->route('showCart')->with('updated', 'product updated');

    }

    public function voucher(Request $request) {

        $discount = Coupon::where('code', $request->discount)->get();
        if (!$discount) {
            return view('user.payment');
        } else {
            session()->put('coupon', [
                'name' => $discount->code,
                'discount' => $this->showCart()->sum,
                'value' => $discount->value,
            ]);
            return view('user.payment');
        }
    }

    public function remove() {
        session()->forget('coupon');
        return view('user.payment');
    }

    public function payment(Request $request) {

        $dis = session()->has('coupon') ?
        (session()->get('coupon')['discount'] - (session()->get('coupon')['discount'] * session()->get('coupon')['value']) / 100)
        : $this->showCart()->sum;

        $request->validate(['email' => 'required','paymentType' => 'required' ,'city' =>'required','region' =>'required','street' => 'required']);
        $order = Order::where('user_id', Auth::user()->id)->get();
        //  $pay = payment::where('user_id',Auth::user()->id)->orderby('created_at','DESC')->first();
        //  $num = '#'.str_pad($pay->id + 0, 8, "0", STR_PAD_LEFT);

        foreach ($order as $value) {
            $payment = Payment::create([
                'user_id' => Auth::user()->id,
                'order_id' => $value->id,
                'city' => $request->city,
                'region' => $request->region,
                'street' => $request->street,
                'amount' => $dis,
                'payment_type' => $request->paymentType,
                'email' => $request->email,
            ]);
        }
        $this->remove();
        $cart = Cart::where('user_id', Auth::user()->id);
        $cart->delete();
        $this->cleanup('carts');
        return redirect('/invoice');
// $code++;
$this->sms();
$this->mail();


    }

    public function invoice() {
        $user = Auth::user();
        $order = payment::where('user_id', $user->id)->orderby('created_at', 'DESC')->first();
        $orders = payment::where('user_id', $user->id)->get();

        $num = '#' . str_pad($order->id + 0, 8, "0", STR_PAD_LEFT);
        foreach ($orders as $value) {
            Invoice::create(['payment_id' => $value->id, 'code' => $num]);
        }

        return redirect('/redirect');
    }

    public function reviewform($id) {
        $product = product::find($id);
        $review = Review::Select('comment')->WHERE('product_id', $product->id)->orderby('created_at', 'DESC')->get();

        return view('user.review', compact('product', 'review'));
    }

    public function review(Request $request, $id) {
        $product = product::find($id);

        $review = Review::create(['user_id' => Auth::user()->id, 'product_id' => $product->id, 'comment' => $request->comment, 'rating' => $request->star]);
        return redirect()->back();

    }

    public function sms() {

        vonage::message()->send([
            'to' => '+201201536903',
            'from' => '16105552344',
            'text' => 'order was shipped',
        ]);
    }

    public function mail() {
        $details = [
            'title' => 'The Mail title',
            'body' => 'body Mail',
        ];
        Mail::to('androwgamail@gmail.com')
            ->send(new \App\Mail\OrderShipped ($details));
    }
}