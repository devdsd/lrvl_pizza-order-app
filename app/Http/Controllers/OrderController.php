<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Order;
use App\Models\Pizza;

// Packages
use Auth;
use Carbon\Carbon;


class OrderController extends Controller
{
        // Unauthenticated User 
    public function publicViewOrder() {
        // $orders = Order::latest()->paginate(5);
        $orders = Order::all();

        return view('admin/orders/orders', compact('orders'));
    }

    public function allOrders() {
            // Current Orders
        $orders = Order::latest()->paginate(5);
            // Trashed Orders
        $trashed_orders = Order::onlyTrashed()->latest()->paginate(3);
        $pizzas = Pizza::all();
        
        return view('admin/orders/all_orders', compact('orders', 'trashed_orders', 'pizzas'));
    }

    public function addOrder(Request $request) {
        $validateData = $request->validate([
            'no_of_order' => 'required',
        ],
        [
            'no_of_order.required' => "Please input number of order",
        ]);

        $pizza_id = $request->get("pizza");
        $pizza = Pizza::find($pizza_id);
        $no_of_order = $request->no_of_order;
        $total_amount = $no_of_order * $pizza->price;

            // Eloquent ORM First Method
        Order::insert([
            'user_id' => Auth::user()->id,
            'pizza_id' => $pizza_id,
            'no_of_order' => $no_of_order,
            'total_amount' => $total_amount,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Order Successfully Placed!');

    }

    public function editOrder($id) {
            // Getting the Order and Pizza Data
        $order_data = Order::find($id);
        $pizzas = Pizza::all();

        return view('admin.orders.edit_order', compact('order_data', 'pizzas'));

    }

    public function updateOrder(Request $request, $id) {
        $new_pizza = $request->get('new_pizza');
        if ($new_pizza) {
            $pizza_id = $new_pizza;
        } else {
            $pizza_id = $request->old_pizza;
        }
        $order_data = Order::find($id);

        $total_amount = $order_data->pizzarelation->price * (integer) $request->no_of_order;

        error_log("Number of Orders: ".$request->no_of_order);

        Order::find($id)->update([
            'user_id' => $request->user_id,
            'pizza_id' => $pizza_id,
            'no_of_order' => $request->no_of_order,
            'total_amount' => $total_amount,
        ]);

        return Redirect()->route('all_orders')->with('success', 'Order Updated Successfully!');
    }


    public function removeOrder($id) {
        $order_removed = Order::find($id)->delete();

        return Redirect()->back()->with("removed", "Order moved to trash!");
    }

    public function restoreOrder($id) {
        $order_restore = Order::withTrashed()->find($id)->restore();

        return Redirect()->back()->with("success", "Order successfully restored!");
    }

    public function deleteOrder($id) {
        $order_restore = Order::onlyTrashed()->find($id)->forceDelete();

        return Redirect()->back()->with("deleted", "Order deleted successfully!");
    }
}
