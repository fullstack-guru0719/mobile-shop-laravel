<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Admin\NetworkRepositoryEloquent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Image;

class NetworkController extends Controller
{
    protected $phone_carrier;

    public function __construct(NetworkRepositoryEloquent $phone_carrier_repo)
    {
        $this->phone_carrier = $phone_carrier_repo;
    }

    /**
     * View for the index page of Phone Carrier settings
     * 
     * @return view
     */
    public function index()
    {
        $data['carriers'] = $this->phone_carrier->all('id','ASC');
        $data['module'] = "phone-carriers";
        $data['tvsettings'] = true;
        // $data['carriers'] = $this->phone_carrier->paginate(10,'created_at','DESC',['id','name','created_at']);

        return view('admin.settings.phone-carriers.index',$data);
    }

    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                "name" => "required",
                "image" => "nullable|file|image"
            ]);

            if($validator->fails()){
                return response()->json([
                    "status" => false,
                    "errors" => $validator->errors(),
                ]);
            }

            $file_name = null;
            if($request->file('image')){
                $image = $request->file('image');
                $path = public_path('uploads/phone-carriers/');
                $file_name = $this->image_upload($image,$path);
            }

            $this->phone_carrier->create([
                'title' => $request->name,
                'image' => $file_name
            ]);

            return response()->json([
                "status" => true,
                "message" => "success",
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request,$id)
    {
        try {
            $validator = Validator::make($request->all(),[
                "name" => "required",
                "image" => "nullable|file|image"
            ]);

            if($validator->fails()){
                return response()->json([
                    "status" => false,
                    "errors" => $validator->errors(),
                ]);
            }

            $file_name = null;
            if($request->file('image')){
                $image = $request->file('image');
                $path = public_path('uploads/phone-carriers/');
                $file_name = $this->image_upload($image,$path);
            }

            $data = [ 'title' => $request->name ];

            $file_name ? $data['image'] = $file_name : null;

            $this->phone_carrier->update($data,$id);

            return response()->json([
                "status" => true,
                "message" => "successfully updated",
            ]);

        } catch (\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ]);
        }
        $this->phone_carrier->update([
            'title' => $request->name,
        ],$id);
    }

    public function delete($id)
    {
        try {
            $this->phone_carrier->delete($id);
            
            return response()->json([
                "status" => true,
                "message" => "Successfully Deleted",
            ]);
        } catch (\Exception $e){
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ]);
        }   
    }


    private function image_upload($image,$path){
        $file_name = time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->save($path.''.$file_name);
        return $file_name;
    }
}
