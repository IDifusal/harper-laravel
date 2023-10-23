<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Mail\RequestProduct;
use Illuminate\Http\Request;
use App\Models\CustomAddress;
use App\Models\RequestRecord;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    // Retrieve a list of products
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Create a new product
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'initial_stock' => 'required|integer',
            // Add validation rules for other fields
        ]);

        $product = Product::create($data);
        return response()->json($product, 201);
    }

    // Retrieve a single product by ID
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'initial_stock' => 'required|integer',
            // Add validation rules for other fields
        ]);

        $product = Product::findOrFail($id);
        $product->update($data);

        return response()->json($product);
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function getProductsAndDeliveryMethods()
    {
        $products = Product::with(['deliveryMethods' => function ($query) {
            $query->select('delivery_methods.id', 'delivery_methods.name as title'); // Specify table aliases
        }])->get(['products.id', 'products.name as title']); // Specify table aliases for products
    
        return response()->json(['products' => $products]);
    }

    public function requestProduct(Request $request){
        $product = Product::findOrFail($request->product_id);
        $requestRecord = new RequestRecord();
        $requestRecord->delivery_method = $request->delivery_method;
        $requestRecord->product_name = $product->name;
        $requestRecord->quantity_requested = $request->quantity_requested;
        $requestRecord->requester_email = $request->requester_email;$requestRecord->delivery_method = $request->delivery_method;
        $requestRecord->save();        


        if ($request->delivery_method === 3) {
            $customAddress = new CustomAddress();
            $customAddress->request_id = $requestRecord->id; 
            $customAddress->address = $request->custom_address;
            $customAddress->save();
        } 
        // LOOGIC EMAIL
        // $admins = User::where('role', 'admin')->get();
        
        $requestRecord->save();
        // $admins = User::where('role', 'admin')->pluck('email')->toArray();
        $admins = ['difusal115@gmail.com'];
        // In case you want to send emails one-by-one (individual emails to each admin)
        foreach ($admins as $admin) {
            Mail::to($admin)->send(new RequestProduct($request->all()));
        }
    
        return response()->json(['message' => 'Request sent successfully']);
    }
}
