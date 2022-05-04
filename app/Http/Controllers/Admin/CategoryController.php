<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Admin\CategoryRequest;
use DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
      
      $categories = New Category();
      
//        if($request->search){
//          $columnsToSearch = DB::getSchemaBuilder()->getColumnListing('categories');
//
//          $searchQuery = '%' . $request->search . '%';
//
//          foreach($columnsToSearch as $column) {
//              $categories = $categories->orWhere($column, 'LIKE', $searchQuery);
//          }
//        }
      
        $categories = $categories->paginate(config("motorTraders.paginate.perPage"));
      
        //$categories = Category::paginate(config("motorTraders.paginate.perPage"));
        return view("category.index", compact("categories"));
    }

    public function create()
    {
        $editCategory = "";
        return view("category.create", compact("editCategory"));
    }

    public function store(CategoryRequest $request, Category $category)
    {
        try {
            $category->create($request->validated());
            
            return redirect()
            ->route("category.index")
            ->with("success", "Category created successfully.");

        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
            ->back()
            ->with(
                "danger",
                "Something went wrong" . $exception->getMessage()
            );
        }
    }

    public function show(Category $category)
    {
        $editCategory = $category->findOrFail($category->id);

        return view("category.show", compact("editCategory"));
    }

    public function edit(Category $category)
    {
        $editCategory = $category->findOrFail($category->id);
        
        return view("category.create", compact("editCategory"));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category->findOrFail($category->id)->update($request->validated());
            
            return redirect()
            ->route("category.index")
            ->with("warning", "Category updated successfully.");

        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
            ->back()
            ->with(
                "danger",
                "Something went wrong" . $exception->getMessage()
            );
        }
    }

    public function destroy(Category $category)
    {
        $category->delete(); 
        return redirect()
        ->route("category.index")
        ->with("danger", "Category deleted successfully.");
    }


}
