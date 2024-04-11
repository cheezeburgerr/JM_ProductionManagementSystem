<?php

namespace App\Http\Controllers;

use App\Models\Lineup;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\ProductionDetails;
use App\Models\Products;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //

    public function index () {
        $apparel = Products::all();
        return view('order-category', compact('apparel'));

    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'team_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'due_date' => 'required|date',
            //'price' => 'required|float',
            //'design' => 'required|image', // You may need to adjust this validation rule based on your requirements
            // Add validation rules for other fields as needed
        ]);

        $detailsData = $request->validate([
            'apparel' => 'nullable',
            'jersey_type' => 'nullable',
            'neck_type' => 'nullable',
            'short_type' => 'nullable',
            'polo_type' => 'nullable|string|max:255',
            'polo_collar' => 'nullable|string|max:255',
            'fabric' => 'required|string|max:255',
        ]);

        // Assuming the 'design' is an image file, you can handle file upload like this
        //$designPath = $request->file('design')->store('designs'); // Adjust the storage path as needed

        // Create a new Order instance
       $order = Order::create($validatedData);

       //dd($order->id);


        OrderDetails::create(array_merge($detailsData, [
            'order_id' => $order->id
        ]));

        ProductionDetails::create([
            'order_id' => $order->id
        ]);

        // $details = new OrderDetails();
        // $details->apparel = $validatedData['apparel'];
        // $details->jersey_cut = $request->input['jersey_type'];
        // $details->neck_type = $validatedData['neck_type'];
        // $details->short_type = $validatedData['short_type'];
        // //$details->polo_type = $validatedData['polo_type'];
        // //$details->polo_collar = $validatedData['polo_collar'];
        // $details->fabric = $validatedData['fabric'];
        // $details->order_id = $order->id;

        //$details->save();
        //$details->price = $validatedData['price'];
        //$order->design_path = $designPath; // Assuming 'design_path' is the field to store the design file path
        // Set other fields accordingly

        // Save the order to the database



        // Redirect the user or perform any other actions as needed
        return redirect()->route('order.lineup')->with('success', 'Order placed successfully!');

    }

    public function order ($id) {
        $product = Products::with(['options' => function ($query) {
            $query->withPivot('product_option_type');
        }])->find($id);
        // dd($product);

       // dd($product);
        return view('order', compact('product'));
    }

    public function edit ($id) {

        $editable = true;
        $product = Order::select('*', 'orders.id AS orderID')->leftJoin('order_details', 'orders.id', 'order_details.order_id')->where('orders.id', $id)->get();


       //dd($product);
        return view('order', compact('product'));
    }

    public function lineup($id) {
        $order = Order::leftJoin('order_details', 'orders.id', 'order_details.order_id')->findOrFail($id);
        // dd($order);

        return view('lineup', compact('order', 'id'));
    }

    public function store_lineup(Request $request, $id) {
        // $validatedData = $request->validate([
        //     'input.*.player_name' => 'required|string|max:255',
        //     'input.*.player_details' => 'nullable|string|max:255',
        //     'input.*.classification' => 'required|string|in:Adult,Kid',
        //     'input.*.gender' => 'required|string|in:Male,Female',
        //     'input.*.upper_size' => 'nullable|string|max:255',
        //     'input.*.short_size' => 'nullable|string|max:255',
        //     'input.*.short_name' => 'nullable|string|max:255',
        // ]);

       // dd($validatedData);
        // Loop through each player data and save it to the database
        // foreach ($validatedData as $index => $playerName) {
        //     $lineup = new Lineup();
        //     $lineup->player_name = $playerName;
        //     $lineup->player_details = $validatedData['player_details'][$index] ?? null;
        //     $lineup->classification = $validatedData['classification'][$index] ?? null;
        //     $lineup->gender = $validatedData['gender'][$index] ?? null;
        //     $lineup->upper_size = $validatedData['upper_size'][$index] ?? null;
        //     $lineup->short_size = $validatedData['short_size'][$index] ?? null;
        //     $lineup->short_name = $validatedData['short_name'][$index] ?? null;
        //     $lineup->order_id = $id;
        //     $lineup->save();
        // }

        $request->validate([
            'input.*.player_name'=>"required",
            'input.*.player_details'=>"required",
            'input.*.classification'=>"required",
            'input.*.gender'=>"required",
            'input.*.upper_size'=>"nullable",
            'input.*.short_size'=>"nullable",
            'input.*.short_name'=>"nullable",
        ],
        [
            'input.*.player_name'=>"Name is required",
            'input.*.player_details'=>"Number is required",
            'input.*.classification'=>"Age is required",
            'input.*.gender'=>"Gender is required"
        ]);


        foreach ($request->input as $key => $value){
            $value['order_id'] = $id;

            Lineup::create([
                'player_name' => $value['player_name'],
                'player_details' => $value['player_details'],
                'classification' => $value['classification'],
                'gender' => $value['gender'],
                'upper_size' => $value['upper_size'],
                'short_size' => $value['short_size'],
                'short_name' => $value['short_name'],
                'order_id' => $value['order_id']
            ]);
        }

        // Optionally, you can redirect the user after successful submission
        return redirect()->route('order.view')->with('success', 'Lineup data saved successfully.');

    }
}
