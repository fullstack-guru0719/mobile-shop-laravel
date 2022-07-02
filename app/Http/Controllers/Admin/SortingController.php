<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\SettingsBrandRepositoryEloquent as Brand;
use App\Models\Admin\Product as ModelProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SortingController extends Controller
{
    protected $configRepo;
    protected $product;

    public function __construct(
        Brand $brandRepo,
        ModelProduct $product
    ) {
        $this->brandRepo = $brandRepo;
        $this->product = $product;
    }

    /**
     * Show the Products Ordering.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['module'] = 'sorting';
        $data['brands'] = $this->brandRepo->all();
        foreach ($data['brands'] as $key => $value) {
            $allProducts = ModelProduct::with(['photo'])
                ->where('brand_id', "=", $value['id'])
                ->orderBy('priority', 'asc')
                ->get();
            $brandProductsToShow = [];
            // $data['brands'][$key] = [];
            foreach ($allProducts as $key2 => $val) {
                $product = $this->product->where('status', 'active')->find($val['id']);
                if ($product) {
                    $brandProductsToShow[$key2] = $val;
                }
            }
            $data['brands'][$key]['products'] = $brandProductsToShow;
        }

        // $data['products'] = [];
        return view('admin.sorting.index', $data);
    }

    public function update(Request $request)
    {
        if (!isset($request['priorities'])) {
            return redirect()->back()->with('errormsg', 'Malformed data.');
        }

        $data = (array) json_decode($request['priorities']);
        foreach ($data as $id => $priority) {
            $product = $this->product->find(intval($id));
            if ($product) {
                $product = $this->product->where('id', intval($id))->update(['priority' => intval($priority)]);
            }
        }

        return redirect()->back()->with('msg', "Updated priorities");

        // return view('admin.sorting.index', []);

    }
}
