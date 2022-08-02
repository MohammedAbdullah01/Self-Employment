<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClientController extends Controller
{


    public function index()
    {
        $clients = Client::withCount('projects')->latest()->paginate();
        return view('admin.pages.clients.index' , compact('clients'));
    }

    public function showProjectsClient($name)
    {
        $client = Client::where('name' , $name)->withCount('projects')->with('projects')->firstOrfail();

        $projects = $client->projects()->latest()->paginate();


            return view('admin.pages.clients.show_projects_client' , compact('client' ,'projects'));
    }


    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        $photo_path = public_path('storage/clients/' . $client->avatar);

        if (File::exists($photo_path)) {
            File::delete($photo_path);
        }
        Toastr::success('Successfully Deleted Client :) ');
        return redirect()->back();
    }
}
