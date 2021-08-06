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
use App\Models\Customer\CustomerInfo;
use App\Models\Customer\Payment;

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

    public function saveCustomerInfo(Request $request)
    {
        $customerInfo = CustomerInfo::where('customer_id', Auth::guard('customer')->user()->id)->first();
        if(empty($customerInfo))
        {
            $customerInfo = new CustomerInfo();
            $customerInfo->country = $request->country;
            $customerInfo->fullname = $request->fullname;
            $customerInfo->mobile_no = $request->mobile_no;
            $customerInfo->address = $request->address;
            $customerInfo->city = $request->city;
            $customerInfo->pin_code = $request->pin_code;
            $customerInfo->customer_id = Auth::guard('customer')->user()->id;
            $customerInfo->save();
            return response()->json(['success' => 'Address Details are Saved!']);
        }
        else{
            $input_data = array (
                'country' => $request->country,
                'fullname' => $request->fullname,
                'mobile_no' => $request->mobile_no,
                'address' => $request->address,
                'city' => $request->city,
                'pin_code' => $request->pin_code,
            );
    
            CustomerInfo::whereId($customerInfo->id)->update($input_data);
            return response()->json(['success' => 'Address Details Updated Successfully!']);
        }
    }

    public function payment(Request $request, $id)
    {
        $order = Order::findorfail($id);
        $customer = Customer::where('id', $order->customer_id)->first();
        $customerInfo = CustomerInfo::where('customer_id', $order->customer_id)->first();
        $salt = '21e6bc3bc2070fcfe11d36fd9ada68ed8ebf8618'; //Pass your SALT here

        $data = array(
            'api_key' => '4fa5f91d-4f53-47ba-9849-425fc0f314cd',
            'order_id' => $order->order_number,
            'mode' => 'TEST',
            'amount' => $order->grand_total,
            'currency' => 'INR',
            'description' => 'Product Payment',
            'name' => $order->name,
            'email' => $customer->email,
            'phone' => $customerInfo->mobile_no,
            'city' => $customerInfo->city,
            'country' => $customerInfo->country, 
            'zip_code' => $customerInfo->pin_code,
            'return_url' => url('/customer/success') 
        );
        $data['hash'] = $this->generateHash($data,$salt);
        $payment_url = 'https://biz.aggrepaypayments.com/v2/paymentrequest';
        ?>
            <html>
            <body OnLoad="OnLoadEvent();">
            <form name="form1" action="<?php echo $payment_url; ?>" method="post">
                <?php foreach ($data as $key => $value) {
                    echo '<input type="hidden" value="' . $value . '" name="' . $key . '"/>';
                } ?>
            </form>
            <script language="JavaScript">
                function OnLoadEvent() {
                    document.form1.submit();
                }
            </script>
            </body>
            </html>
        <?php
    }

    public function generateHash($input,$salt)
    {

        /* Columns used for generating the hash value */
        $hash_columns = [
            'address_line_1',
            'address_line_2',
            'amount',
            'api_key',
            'city',
            'country',
            'currency',
            'description',
            'email',
            'mode',
            'name',
            'order_id',
            'phone',
            'return_url',
            'state',
            'udf1',
            'udf2',
            'udf3',
            'udf4',
            'udf5',
            'zip_code',
        ];

        /*Sort the array before hashing*/
        ksort($hash_columns);

        /*Create a | (pipe) separated string of all the $input values which are available in $hash_columns*/
        $hash_data = $salt;
        foreach ($hash_columns as $column) {
            if (isset($input[$column])) {
                if (strlen($input[$column]) > 0) {
                    $hash_data .= '|' . $input[$column];
                }
            }
        }

        /* Convert the $hash_data to Upper Case and then use SHA512 to generate hash key */
        $hash = null;
        if (strlen($hash_data) > 0) {
            $hash = strtoupper(hash("sha512", $hash_data));
        }

        return $hash;

    }

    public function paymentSuccess(Request $request)
    {
        $order = Order::where('order_number', $request->order_id)->first();
       
        $payment = new Payment();
        $payment->order_id = $order->id;
        $payment->name = $request->name;
        $payment->email = $request->email;
        $payment->transaction_id = $request->transaction_id;
        $payment->payment_mode = $request->payment_mode;
        $payment->payment_channel = $request->payment_channel;
        $payment->payment_datetime = $request->payment_datetime;
        $payment->response_message = $request->response_message;
        $payment->save();

        if($request->response_message == "Transaction successful")
        {
            $message = "Completed";
        }
        else{
            $message = "Pending";
        }

        $order = Order::where('order_number', $request->order_id)->update(['payment_status' => $message]);

        return redirect()->route('customer.payment-success', $payment->id);
    }

    public function paymentDetail($id)
    {
        $paymentDetail = Payment::findorfail($id);
        return view('customer.success', compact('paymentDetail'));
    }
}
