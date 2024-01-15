<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Owner;

use Illuminate\Http\Request;

class ItemApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::orderBy('id', 'asc')->paginate(10);
        $items->withQueryString();

        return view('items.index', [
            'items' => $items
        ]);
    }

    /**
     * Create a new item
     */
    public function create()
    {
        $categories = Category::all();
        return view('items.add', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the 'status' field exists in the form data
        $status = $request->has('status') ? $request->input('status') : 'Not Published';
    
        // Find the owner or create a new one
        $owner = Owner::where('name', $request->input('owner'))
                ->where('contact_num', $request->input('number'))
                ->first();


        // Create a new item
        $item = new Item();

        if ($owner) {
            $item->owner_id = $owner->id;
        }
        else{
            // Create a new owner
            $owner = new Owner();
            $owner->name = $request->input('owner');
            $owner->contact_num = $request->input('number');
            $owner->address = $request->input('address');
            $owner->save();
            $newOwnerId = $owner->id;

            $item->owner_id = $newOwnerId;
        }

        $item->name = $request->input('name');
        $item->category_id = $request->input('category_id');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->condition = $request->input('condition');
        $item->type = $request->input('type');
        $item->status = $status;

        // Save the item to the database
        $item->save();
    
        // Redirect to the index page with a success message
        return redirect()->route('items.index')->with('info', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function edit($id){
        $item = Item::find($id);
        if(!$item){
            return redirect("/items")->with('error', 'Item not found.');
        }

        $categories = Category::all();
        return view('items.edit', ['item' => $item], [ 'categories' => $categories]);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Check if the 'status' field exists in the form data
        $status = $request->has('status') ? $request->input('status') : 'Not Published';

        // Find the owner or create a new one
        $owner = Owner::where('name', $request->input('owner'))
                ->where('contact_num', $request->input('number'))
                ->first();

        $item = Item::find($id);

        if ($owner) {
            $item->owner_id = $owner->id;
        }
        else{
            // If input request owner doesnt exist, create a new owner
            $owner = new Owner();
            $owner->name = $request->input('owner');
            $owner->contact_num = $request->input('number');
            $owner->address = $request->input('address');
            $owner->save();
            $newOwnerId = $owner->id;

            $item->owner_id = $newOwnerId;

        
        }
        
        $item->name = $request->input('name');
        $item->category_id = $request->input('category_id');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->condition = $request->input('condition');
        $item->type = $request->input('type');
        $item->status = $status;

        $item->save();

        // Redirect to the index page with a success message
        return redirect()->route('items.index')->with('info', "Item {$item->id} : $item->name} updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $id, Request  $request)
    {
        $item = Item::find($id);
        if(!$item){
            return redirect()->route('items.index')->with('error', 'Item not fond.');

        }
        $item->each->delete();

        // Use the existing paginator from the index page
        $paginator = Item::orderBy('id', 'asc')->paginate(10);
        $currentPage = $paginator->currentPage();
        $redirectToPage = ($request->page <= $paginator->lastPage())
                        ? $request->page 
                        : $paginator->lastPage();
        // Redirect to the index page with a success message

        return redirect()->route('items.index', ['page' => $redirectToPage]);
    }

 

     /**
     * Update Status - Publish or Not Published.
     */
    public function status($id, $status, Request  $request)
    {
        $item = Item::find($id);
        $item->status = $status;

        $item->save();
        return redirect()->route('items.index', ['page' => $request->page]);
       
    }


}
