<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Profile;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $profile = Profile::where('status', 1)->first();
        $experience = Experience::all();
        // dd($experience);
        return view('admin.experience.index', compact('experience'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profile = Profile::all();
        return view('admin.experience.create', compact('profile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'profile_id' => 'required',
            'title' => 'required|string|max:55',
            'position' => 'required|string|',
            'description' => 'required|string',
        ]);
        //menghandle file upload-an
        // Insert into profiles () values ();
        // $request->profile_id;
        // $request->title;
        // $request->position;
        // $request->description;
        Experience::create($data);
        return redirect()->route('experience.index')->with('success', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Experience::findOrFail($id);
        return view('admin.experience.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        $data = $request->validate([
            'profile_id' => 'required|nullable',
            'title' => 'required|string|max:55',
            'position' => 'required|string|',
            'description' => 'required|string',
        ]);
        $experience->update($data);
        return redirect()->route('experience.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $experience = Experience::withTrashed()->findOrFail($id);
        $experience->forceDelete();

        return redirect()->route('experience.index')->with('success', 'Data Dihapus Permanen');
    }

    public function softdelete(string $id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();

        return redirect()->route('experience.index')->with('success', 'Data Dihapus Sementara');
    }

    public function restore($id)
    {
        $experience = Experience::withTrashed()->findOrFail($id);
        $experience->restore();

        return redirect()->route('experience.index')->with('success', 'Data Berhasil di Restore');
    }

    public function recycle()
    {

        $experience = Experience::onlyTrashed()->paginate(15);
        return view('admin.experience.recycle', compact('experience'));
    }
}
