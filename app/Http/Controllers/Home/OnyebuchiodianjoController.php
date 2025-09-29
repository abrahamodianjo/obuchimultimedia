<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Onyebuchiodianjo;
use App\Models\MultiImage;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;


class OnyebuchiodianjoController extends Controller
{
    public function Onyebuchiodinajo()
    {
        $onyebuchiodianjopage = Onyebuchiodianjo::find(1);
        return view('admin.onyebuchi_odianjo_page.onyebuchi_odianjo_all', compact('onyebuchiodianjopage'));


    }//End Method

    public function UpdateOnyebuchiodianjo(Request $request)
    {
        $onyebuchiodianjo_id = $request->id;

        // Find the record
        $onyebuchiodianjo = Onyebuchiodianjo::findOrFail($onyebuchiodianjo_id);

        // Validate request
        $request->validate([
            'onyebuchiodianjo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // max 5MB upload
            'title' => 'required|string|max:255',
            'short_title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
        ]);

        // Prepare data to update
        $data = [
            'title' => $request->title,
            'short_title' => $request->short_title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
        ];

        // Process new image if uploaded
        if ($request->hasFile('onyebuchiodianjo_image')) {
            $image = $request->file('onyebuchiodianjo_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_path = 'upload/onyebuchi/' . $name_gen;

            $img = Image::make($image);

            // Resize proportionally
            $img->resize(523, 605, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            // Compress image iteratively to <1MB
            $quality = 90;
            $img->encode(null, $quality);
            while (strlen($img) > 1024 * 1024 && $quality > 10) {
                $quality -= 5;
                $img->encode(null, $quality);
            }

            // Save final image
            $img->save($save_path);

            // Add image path to update data
            $data['onyebuchiodianjo_image'] = $save_path;
        }

        // Update the record
        $onyebuchiodianjo->update($data);

        // Notification
        $notification = [
            'message' => 'Onyebuchi page updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }


    public function HomeOnyebuchiodianjo()
    {
        $onyebuchiodianjopage = Onyebuchiodianjo::find(1);
        return view('frontend.onyebuchiodianjo_page', compact('onyebchiodianjopage'));

    }//End Method



}