<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Experience;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;


class ProfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Select * from Profiles;
        $profiles = Profile::all();
        return view('admin.profile.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $profile = "";
        return view('admin.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vval = $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_lengkap' => 'required|string|max:55',
            'alamat' => 'nullable|string|max:250',
            'no_telpon' => 'required|string|max:15',
            'email' => 'required|string|email|max:55',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'description' => 'nullable|string',
        ]);
        //menghandle file upload-an
        $name = null;
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $path = $image->store('public/image');
            $name = basename($path); //menyimpan nama filenya saja
            $vval['picture'] = $name;
        }
        // Insert into profiles () values ();
        Profile::create($vval);
        return redirect()->route('profiles.index')->with('success', 'Data berhasil ditambah');
    }

    // recycle
    public function recycle()
    {

        $profiles = Profile::onlyTrashed()->paginate(15);
        return view('admin.profile.recycle', compact('profiles'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Profile::findOrFail($id);
        $idprofile = $data->id;
        $experience = Experience::where('profile_id', $idprofile)->get();

        $pdf = Pdf::loadView('admin.generate-pdf.index', compact(['data', 'experience']));
        return $pdf->download('Portofolio.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Profile::findOrFail($id);
        return view('admin.profile.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profile = Profile::findOrFail($id);
        $vval = $request->validate([
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_lengkap' => 'nullable|string|max:55',
            'alamat' => 'nullable|string|max:250',
            'no_telpon' => 'nullable|string|max:15',
            'email' => 'nullable|string|email|max:55',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('picture')) {
            if ($profile->picture) {
                Storage::delete('public/images . $profile->picture');
            }
            $image = $request->file('picture');
            $path = $image->store('public/image');
            $name = basename($path);
            $profile->picture = $name;
        }
        $profile->nama_lengkap = $request->nama_lengkap;
        $profile->alamat = $request->alamat;
        $profile->no_telpon = $request->no_telpon;
        $profile->email = $request->email;
        $profile->facebook = $request->facebook;
        $profile->twitter = $request->twitter;
        $profile->linkedin = $request->linkedin;
        $profile->instagram = $request->instagram;
        $profile->description = $request->description;
        $profile->save();
        return redirect()->route('profiles.index')->with('success', 'Data Dihapus Sementara');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $profile = Profile::withTrashed()->findOrFail($id);
        $profile->forceDelete();
        if ($profile->picture) {
            Storage::delete('public/image/' . $profile->picture);
        }

        return redirect()->route('profiles.index')->with('success', 'Data Dihapus Permanen');
    }
    public function softdelete(string $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Data Dihapus Sementara');
    }

    // RESTORE
    public function restore($id)
    {
        $profile = Profile::withTrashed()->findOrFail($id);
        $profile->restore();

        return redirect()->route('profiles.index')->with('success', 'Data Berhasil di Restore');
    }

    public function updateStatus($id): JsonResponse
    {
        // Select profile bukan berdasarkan id baru di update menjadi 0
        Profile::where('id', '!=', $id)->update(['status' => 0]);

        $profile = Profile::findOrFail($id);
        $profile->status = 1;
        $profile->save();

        return response()->json(['success' => 'Status berhasil di perbaharui.']);
    }
}
