<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User\Product;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Customer\CustomerInfo;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    public function placedOrder(Request $request)
    {
        $customer = DB::table('customers')->where('id', Auth::guard('customer')->user()->id)->first();
        // dd($user);
        $total = \Cart::getSubTotal();
        // dd($total);
        $order = Order::create([
            'order_number'      =>  'ORD-'.strtoupper(uniqid()),
            'customer_id'           => Auth::guard('customer')->user()->id,
            'status'            =>  'pending',
            'grand_total'       =>  $total,
            'item_count'        =>  \Cart::getTotalQuantity(),
            'payment_status'    =>  "Pending",
            'name'        =>  Auth::guard('customer')->user()->name,
            'mobile_no'      =>  "",
        ]);
    
        if ($order) {
    
            $items = \Cart::getContent();
    
            foreach ($items as $item)
            {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                $product = Product::where('id', $item->id)->first();
    
                $orderItem = new OrderItem([
                    'user_id'     =>  $product->user_id,
                    'product_id'    =>  $product->id,
                    'quantity'      =>  $item->quantity,
                    'price'         =>  $item->getPriceSum()
                ]);
    
                $order->items()->save($orderItem);
                \Cart::clear();
            }
        }
        return redirect()->route('customer.order.details', $order->id)->with('success', "Order Placed Successfully!");
    }

    public function orderDetails($id){
        $order = Order::findorfail($id);
        $orderItems = OrderItem::where('order_id', $id)->get();
        $customerInfo = CustomerInfo::where('customer_id', $order->customer_id)->first();
        return view('customer.order.index', compact('order', 'orderItems', 'customerInfo'));
    }
}
