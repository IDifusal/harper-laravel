<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Mail\RequestProduct;
use Illuminate\Http\Request;
use App\Models\CustomAddress;
use App\Models\RequestRecord;
use Illuminate\Support\Facades\App;
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
    public function getMyRequests(Request $request)
    {
        $requests = RequestRecord::select('request_records.*', 'delivery_methods.name as delivery_method_name')
            ->where('requester_email', $request->email)
            ->join('delivery_methods', 'request_records.delivery_method', '=', 'delivery_methods.id')
            ->get();
    
        return response()->json(['requests' => $requests]);
    }
    
    public function getPendingRequests()
    {
        $requests = RequestRecord::select('request_records.*', 'delivery_methods.name as delivery_method_name')
            ->where('approved', 0)
            ->join('delivery_methods', 'request_records.delivery_method', '=', 'delivery_methods.id')
            ->get();
    
        return response()->json(['requests' => $requests]);
    }

    public function getAllRequests(){
        $requests = RequestRecord::select('request_records.*', 'delivery_methods.name as delivery_method_name')
            ->join('delivery_methods', 'request_records.delivery_method', '=', 'delivery_methods.id')
            ->get();
    
        return response()->json($requests);
    }
    

    public function requestProduct(Request $request){
        $product = Product::findOrFail($request->product_id);
        $requestRecord = new RequestRecord();
        $requestRecord->delivery_method = $request->delivery_method;
        $requestRecord->product_id = $product->id;
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
        if (App::environment('development')) {
            $admins = ['difusal11@gmail.com'];
        } else {
            // Production or any other environment
            $admins = [
                'difusal115@gmail.com',
                // ... add more admin emails as needed
            ];
        }
    
        return response()->json(['message' => 'Request sent successfully']);
    }
}
