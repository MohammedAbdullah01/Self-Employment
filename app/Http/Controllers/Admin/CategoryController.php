<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categorie::latest()->paginate(2);
        // dd($categories);
        return view('admin.pages.categories.index', compact('categories'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|min:4|between:3,50|string',
            'parent_id'   => 'nullable|integer|exists:categories,id',
            'description' => 'required|between:5,255|string',
            'img'         => 'required|mimes:png,jpg,jpeng|image'
        ]);

        if ($request->hasFile('img')) {
            $name_photo = time() . '_' . $request->name . '.' . $request->img->getClientOriginalName();
            $uplode_photo = $request->img->storeAs('categories/', $name_photo, 'public');
        }

        $category = Categorie::create([
            'name'        => $request->post('name'),
            'slug'        => $request->post('name'),
            'description' => $request->post('description'),
            'parent_id'   => $request->post('parent_id'),
            'img'         => $name_photo,
        ]);
        Toastr::success('Successfully Added Category');
        return redirect()->back();
    }



    public function update(Request $request,  $id)
    {
        $request->validate([
            'name'        => 'required|min:4|between:3,50|string',
            'parent_id'   => 'nullable|integer|exists:categories,id',
            'description' => 'required|between:5,255|string',
            'img'         => 'mimes:png,jpg,jpeng|image'
        ]);

        $category = Categorie::findOrFail($id);

        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $photo_path = public_path('storage/categories/' . $category->img);
            if (File::exists($photo_path)) {
                File::delete(($photo_path));
            }
            $name_photo = time() . '_' . $request->name . '.' . $request->img->getClientOriginalName();
            $uplode_photo = $request->img->storeAs('categories/', $name_photo, 'public');

            $category->img     = $name_photo;
        }

        $category->name        = $request->post('name');
        $category->slug        = Str::slug($request->post('name'));
        $category->description = $request->post('description');
        $category->parent_id   = $request->post('parent_id');
        $category->save();

        Toastr::success('Successfully Updated Category');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $category = Categorie::findOrFail($id);
        $category->delete();
        $photo_path = public_path('storage/categories/' . $category->img);

        if (File::exists($photo_path)) {
            File::delete($photo_path);
        }
        Toastr::success('Successfully Deleted Category :) ');
        return redirect()->back();
    }
}
