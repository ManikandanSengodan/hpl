<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use File;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $profiles = new Profile();

        $profiles = $profiles->orderBy('created_at', 'DESC')->paginate(config("motorTraders.paginate.perPage"));

        return view("company-profile.index", compact("profiles"));
    }

    public function create()
    {
        $editProfile = "";
        return view("company-profile.create", compact('editProfile'));
    }

    public function store(ProfileRequest $request)
    {

        try {
            $validatedFields = $request->validated();
            unset($validatedFields["image"]);

            $profile = Profile::create($request->all());

            if ($request->hasFile("image")) {
                $file = $request->file("image");
                // if(Storage::disk('folds')->makeDirectory("{$foldCreate->id}", 0755, true))
                if(!File::exists('profileImage'))
                {
                    File::makeDirectory("profileImage", 0755, true);
                }

                $filePath = $file->store("{$profile->id}", [
                    "disk" => "profile",
                ]);
            }

            if (isset($filePath)) {
                $profile->update([
                    "image" => $filePath,
                ]);
            }
            return redirect()->route("company-profile.index")->with("success", "Profile created successfully.");
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


    public function edit(Profile $profile)
    {
        $editProfile = "";
        $editProfile = Profile::where('id',$profile->id)->first();
        return view("company-profile.create", compact("editProfile"));
    }


    public function update(ProfileRequest $request, Profile $profile)
    {

        try {
            $validatedFields = $request->validated();
            unset($validatedFields["image"]);

            $profile->update($request->all());

            if ($request->hasFile("image")) {
                $file = $request->file("image");
                // if(Storage::disk('folds')->makeDirectory("{$fold->id}", 0777, true))
                if(!File::exists('profileImage'))
                {
                    File::makeDirectory("profileImage", 0755, true);
                }
                $filePath = $file->store("{$profile->id}", [
                    "disk" => "profile",
                ]);
            }

            if (isset($filePath)) {
                $profile->update([
                    "image" => $filePath,
                ]);
            }

            return redirect()
                ->route("company-profile.index")
                ->with("warning", "Profile created successfully.");

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

    public function show($profile)
    {
        $profile = Profile::findOrFail($profile);
        return view("company-profile.show", compact("profile"));
    }


    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect()
            ->route("company-profile.index")
            ->with("danger", "Profile deleted successfully.");
    }
}
