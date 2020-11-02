<?php

namespace App\Interfaces;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

interface CategoryInterface
{
    /**
     * Get all Categorys
     *
     * @method  GET api/Categorys
     * @access  public
     */
    public function getAllCategories();

    public function CategoryJson();



    /**
     * Get Category By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/Categorys/{id}
     * @access  public
     */
    public function getCategoryById($id);

    /**
     * Create | Update Category
     *
     * @param   \App\Http\Requests\CategoryRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/Categorys       For Create
     * @method  PUT     api/Categorys/{id}  For Update
     * @access  public
     */
    public function requestCategory(CategoryRequest $request, $id = null);

    /**
     * Delete Category
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/Categorys/{id}
     * @access  public
     */
    public function deleteCategory(Request $request);
}
