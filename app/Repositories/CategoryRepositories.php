<?php

namespace App\Repositories;

use App\Http\Requests\CategoryRequest;
use App\Interfaces\CategoryInterface;
use App\Traits\ResponseAPI;
use App\Models\Category;
use DB;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryRepository implements CategoryInterface
{
    use ResponseAPI;

    public function getAllCategories()
    {
        $category = Category::get();
        return $this->success('All Category', $category);
    }

    public function CategoryJson()
    {
        $category = Category::orderBy('id');
        return DataTables::of($category)
            ->addColumn('check', function ($row) {
                return '<input type="checkbox" name="cb_element[]" id="cb_element" class="cb_element" value="' . $row->id . '" />';
            })
            ->addColumn('link', function ($row) {
                return '<a class="btn editoffer"
                     data-ids = "' . $row->id . '"
                     data-name = "' . $row->name . '" >
                     <i class="feather icon-edit f-20 text-c-black"></i></a>';
            })
            ->rawColumns(['check', 'link'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getCategoryById($id, $withchild = false)
    {
        try {
            $category = Category::find($id);
            if (!$category) return $this->error("No Category with ID " . $id, 404);

            return $this->success("Category Detail", $category);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function requestCategory(CategoryRequest $request, $id = null)
    {

        DB::beginTransaction();
        try {
            // If Employee exists when we find it
            // Then update the Employee
            // Else create the new one.
            $category = $id ? Category::find($id) : new Category;

            // Check the Employee
            if ($id && !$category) return $this->error("No Category with ID " . $id, 404);
            $category->name = $request->name;
            $category->save();

            DB::commit();

            return $this->success(
                'Category Success Saved',
                [],
                200
            );
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage(), 500);
        }
    }

    public function deleteCategory(Request $request)
    {
        DB::beginTransaction();
        try {
            $ids = $request->id;
          
            Category::whereIn('id', explode(",", $ids))->delete();
            DB::commit();
            return response()->json(['status' => true, 'message' => "Data Category Berhasil di Hapus."]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 421);
        }
    }
}
