<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }


    public function index()
    {
        $categories = $this->categoryRepo->index();
        return view('admin.pages.categories.index', compact('categories'));
    }


    public function store(Request $request)
    {
        return $this->categoryRepo->store($request);
    }


    public function update(Request $request,  $id)
    {
        return $this->categoryRepo->update($request, $id);
    }


    public function destroy($id)
    {
        return $this->categoryRepo->destroy($id);
    }
}
