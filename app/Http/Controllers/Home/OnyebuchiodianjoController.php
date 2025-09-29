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
        return view('admin.onyebuchi_odianjo_page.onyebuchi_odianjo_all', compact('onyebchiodianjopage'));


    }//End Method

    public function UpdateOnyebuchiodianjo(Request $request)
    {

        $onyebuchiodianjo_id = $request->id;

        if ($request->file('onyebuchiodianjo_image')) {
            $image = $request->file('onyebuchiodianjo_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(523, 605)->save('upload/onyebuchi/' . $name_gen);
            $save_url = 'upload/home_aonyebuchibout/' . $name_gen;

            Onyebuchiodianjo::findOrFail($onyebuchiodianjo_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $save_url,

            ]);
            $notification = array(
                'message' => 'Onyebuchi page is Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);



        } else {
            Onyebuchiodianjo::findOrFail($onyebuchiodianjo_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,



            ]);

            $notification = array(
                'message' => 'Onyebuchi page Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } //End else


    }//End Method

    public function HomeOnyebuchiodianjo()
    {
        $onyebuchiodianjopage = Onyebuchiodianjo::find(1);
        return view('frontend.onyebuchiodianjo_page', compact('onyebchiodianjopage'));

    }//End Method



}