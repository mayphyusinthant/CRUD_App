<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->paginate(10);
        $categories->withQueryString();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Create a new category
     */
    public function create()
    {
        return view('categories.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the 'status' field exists in the form data
        $status = $request->has('status') ? $request->input('status') : 'Not Published';

        $category = new Category();
        $category->name = $request->input('name');
        $category->status = $status;

        $category->save();
    
        // Redirect to the index page with a success message
        return redirect()->route('categories.index')->with('info', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function edit($id){
        $category = Category::find($id);
        if(!$category){
            return redirect("/categories")->with('error', 'Category not found.');
        }
        return view('categories.edit', [ 'category' => $category]);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Check if the 'status' field exists in the form data
        $status = $request->has('status') ? $request->input('status') : 'Not Published';

        $category = Category::find($id);

        $category->name = $request->input('name');
        $category->status = $status;

        $category->save();

        // Redirect to the index page with a success message
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $id, Request  $request)
    {
        $category = Category::find($id);
        if(!$category){
            return redirect()->route('categories.index')->with('error', 'Category not fond.');

        }
        $category->each->delete();
          
        // Use the existing paginator from the index page
        $paginator = Category::orderBy('id', 'asc')->paginate(10);
        $currentPage = $paginator->currentPage();
        $redirectToPage = ($request->page <= $paginator->lastPage())
                           ? $request->page 
                           : $paginator->lastPage();
        // Redirect to the index page with a success message
   
        return redirect()->route('categories.index', ['page' => $redirectToPage]);
    }

     /**
     * Update Status - Publish or Not Published.
     */
    public function status($id, $status, Request  $request)
    {
        $category = Category::find($id);
        $category->status = $status;

        $category->save();
        return redirect()->route('categories.index', ['page' => $request->page]);

    }


}
