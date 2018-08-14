<?php

namespace App;


use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\OrderLine;


class Product extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'image_link', 'quantity'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id', 'id');
    }

    /*public function bill_detail(){
    	return $this->hasMany('App\BillDetail','id_product','id');
    }*/

    public function getProductsByType($catalog_id, $category_id, $number_record)
    {
        if (is_null($catalog_id)) {
            return redirect()->back();
        } else {
            $link = '';
            $catalog = Catalog::find($catalog_id);
            $link .= $catalog->name;
            if (is_null($category_id)) {
                $products = $this->getProductsByCatalogID2($catalog_id, $number_record, ['*'], 'p4');
                return ['products' => $products,
                    'link' => $link
                ];
            } else {
                $category = Category::find($category_id);
                $link .= " / " . $category->name;
                $products = $this->getProductsByCategoryId2($category_id, $number_record, ['*'], 'p4');
                return ['products' => $products,
                    'link' => $link
                ];
            }
        }
    }

    public function getProductsByCategoryId2($id, $number_record, $s1, $s2)
    {
        return Product::where([['category_id', '=', $id], ['delete_flag', '=', 0], ['quantity', '>', 0]])->latest()->paginate($number_record, $s1, $s2);
    }

    public function getProductsByCatalogID2($catalog_id, $number_record, $s1, $s2)
    {
        $cate = new Category();
        $cata = Catalog::find($catalog_id);
        $categories = $cate->getCategoriesInOneCatalog($cata);
        $idCategoryArray = array();
        foreach ($categories as $category) {
            $idCategoryArray[] = $category->id;
        }
        $listProduct = Product::where([
            ['delete_flag', '=', '0'],
            ['quantity', '>', 0]
        ])->whereIn('category_id', $idCategoryArray)->latest()->paginate($number_record, $s1, $s2);
        return $listProduct;
    }

    public function getProductsByCatalogID($catalog_id, $number_record)
    {
        $cate = new Category();
        $cata = Catalog::find($catalog_id);
        $categories = $cate->getCategoriesInOneCatalog($cata);
        $idCategoryArray = array();
        foreach ($categories as $category) {
            $idCategoryArray[] = $category->id;
        }
        $listProduct = Product::where([
            ['delete_flag', '=', '0'],
            ['quantity', '>', 0]
        ])->whereIn('category_id', $idCategoryArray)->latest()->paginate($number_record, ['*'], 'p1');
        return $listProduct;
    }

    public function getNewProducts($number_record)
    {
        $listProduct = Product::where([
            ['delete_flag', '=', '0'],
            ['quantity', '>', 0]
        ])->limit($number_record)->latest()->get();
        return $listProduct;
    }

    public function getSaleProducts($number_record)
    {
        return Product::where([
            ['delete_flag', '=', '0'],
            ['quantity', '>', 0],
            ['discount', '>', 0]
        ])->paginate($number_record, ['*'], 'p2');
    }

    public function getSaleProducts2($number_record, $s1, $s2)
    {
        return Product::where([
            ['delete_flag', '=', '0'],
            ['quantity', '>', 0],
            ['discount', '>', 0]
        ])->paginate($number_record, $s1, $s2);
    }


    public function getProductById($id)
    {
        return Product::find($id);
    }

    public function getProductDetailById($id)
    {
        $product = Product::find($id);
        $category = $product->category;
        $catalog = Category::find($category->id)->catalog;
        $supplier = $product->user;
        return [
            'product' => $product,
            'category' => $category,
            'catalog' => $catalog,
            'supplier' => $supplier
        ];
    }

    public function getProductsByCategoryId($id, $number_record)
    {
        return Product::where([['category_id', '=', $id], ['delete_flag', '=', 0], ['quantity', '>', 0]])->latest()->paginate($number_record, ['*'], 'p3');
    }

    public function getProductsBySupplierId($id, $number_record)
    {
        return Product::where([['user_id', '=', $id], ['delete_flag', '=', 0], ['quantity', '>', 0]])->latest()->paginate($number_record);
    }

    public function postProduct($th, $request)
    {
        $th->validate(\request(), [
            'productname' => 'between:1,100',
            'soluong' => 'min:1|max:100000|numeric',
            'price' => 'min:0|max:1000000000|numeric',
            'discount' => 'min:0|max:100|numeric',
            'description' => 'between:1,1000'
        ], [
            'productname.between' => 'Tên sản phẩm không vượt quá 100 kí tự',
            'soluong.min' => 'Số lượng không ít hơn 1',
            'soluong.max' => 'Số lượng không nhiều hơn 100 000',
            'soluong.numeric' => 'Số lượng phải là số',
            'price.min' => 'Giá không nhỏ hơn 0',
            'price.max' => 'Chúng tôi chưa hỗ trợ bán sản phẩm có giá quá 1 tỷ đồng',
            'price.numeric' => 'Giá tiền phải là số',
            'description.between' => 'Mô tả không quá 1000 kí tự'
        ]);

        $product = new Product();
        $sup_id = Auth::user()->id;
        $product->user_id = $sup_id;
        $product->category_id = $request->category;
        $product->name = \request('productname');
        $product->price = \request('price');
        $product->quantity = \request('soluong');
        if (\request('discount') == null) {
            $product->discount = 0;
        } else {
            $product->discount = \request('discount');
        }
        $product->description = \request('description');
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $fileExtension = $avatar->GetClientOriginalExtension();
            $filename = $avatar->getClientOriginalName();
            $allowedfileExtension = ['pdf', 'jpg', 'png', 'PNG', 'JPG', 'PDF'];

//            $followExtensions = ['jpg', 'PNG', 'JPEG', 'GIF', 'TIFF'];
            if (in_array($fileExtension, $allowedfileExtension)) {
                $filenameFinal = time() . '.' . $filename;
                $product->image_link = $filenameFinal;
                $avatar->storeAs('public/products', $filenameFinal);
                $category = trim($request->category_new, ' ');
                if (!empty($category)) {
                    $cate = new Category();
                    $cate->catalog_id = $request->catalog;
                    $cate->name = $category;
                    $cate->save();
                    $product->category_id = $cate->id;
                }
                $product->save();
                return [
                    'error' => false,
                    'product_id' => Product::where('user_id', Auth::user()->id)->latest()->first()
                ];
            } else {
                return [
                    'error' => true,
                    'code' => 'errorFile',
                    'message' => 'Chỉ chấp nhận file ảnh, xin mời chọn lại'
                ];
            }
        } else {
            return [
                'error' => true,
                'code' => 'errorNull',
                'message' => 'xin mời chọn ảnh'
            ];
        }

    }

    public function getProductsAjax($start, $length, $search, $oderColunm, $oderSortType, $draw)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            4 => 'quantity',
            5 => 'price',
            6 => 'discount',
        );

        $totalData = Product::where('user_id', Auth::user()->id)->where('delete_flag', 0)->count();
        if (empty($search)) {
            $products = Product::whereHas('category', function ($query) {
                $query->whereHas('catalog', function ($query2) {
                    $query2->whereIn('id', [1, 2]);
                });
            })
                ->where('user_id', Auth::user()->id)->where('delete_flag', 0)
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $totalData;
        } else {
            $products = Product::whereHas('category', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")->whereHas('catalog', function ($query2) use ($search) {
                    $query2->whereIn('id', [1, 2]);
                });
            })
                ->where([['delete_flag', '=', 0], ['user_id', '=', Auth::user()->id]])
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('created_at', 'like', "%$search%")
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $products->count();
        }
        $data = array();
        if ($products) {
            foreach ($products as $product) {
                $nestedData = array();
                $nestedData['id'] = $product->id;
                $nestedData['user_id'] = $product->user_id;
                $nestedData['category'] = $product->category->name;
                $nestedData['name'] = $product->name;
                $nestedData['price'] = number_format($product->price);
                $nestedData['price_modal'] = $product->price;
                $nestedData['salePrice'] = number_format($product->price - (($product->price * $product->discount) / 100));
                $nestedData['quantity'] = $product->quantity;
                $nestedData['discount'] = $product->discount;
                $nestedData['created_at'] = $product->created_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['updated_at'] = $product->updated_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['catalog'] = $product->category->catalog->name;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($draw),
            // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData),
            // total number of records
            "recordsFiltered" => intval($totalFiltered),
            // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data
        );
        return $json_data;
    }

    ///san pham can giao
    public function getOrderProductsAjax($start, $length, $search, $oderColunm, $oderSortType, $draw)
    {
        $columns = array(
            13 => 'created_at',
        );
        $totalData = OrderLine::whereHas('product', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->whereHas('status', function ($query) {
            $query->whereIn('id', [1, 2, 3, 4]);
        })->count();
        if (empty($search)) {
            $orderLines = OrderLine::whereHas('product', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
                ->whereHas('status', function ($query) {
                    $query->whereIn('id', [1, 2, 3, 4]);
                })
                ->whereHas('order', function ($query) {
                    $query->where('delete_flag', 0);
                })
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $totalData;
        } else {
            $orderLines = OrderLine::whereHas('product', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
                ->whereHas('status', function ($query) use ($search) {
                    $query->whereIn('id', [1, 2, 3, 4]);
                    $query->where('stt', 'like', "%$search%");
                })
                ->whereHas('order', function ($query) {
                    $query->where('delete_flag', 0);
                })
                ->orWhere('created_at', 'like', "%$search%")
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $orderLines->count();
        }
        $data = array();
        if ($orderLines) {
            foreach ($orderLines as $orderLine) {
                $nestedData = array();
                $nestedData['order_code'] = $orderLine->order->id . '-' . $orderLine->id;
                $nestedData['orderLine_id'] = $orderLine->id;
                $nestedData['product_id'] = $orderLine->product->id;
                $nestedData['product_name'] = $orderLine->product->name;
                $nestedData['catalog'] = $orderLine->product->category->catalog->name;
                $nestedData['category'] = $orderLine->product->category->name;
                $nestedData['price'] = number_format($orderLine->product->price);
                $nestedData['salePrice'] = number_format($orderLine->product->price - (($orderLine->product->price * $orderLine->product->discount) / 100));
                $nestedData['quantity'] = $orderLine->quantity;
                $nestedData['amount'] = number_format($orderLine->amount);
                $nestedData['discount'] = $orderLine->product->discount;
                $nestedData['created_at'] = $orderLine->created_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['updated_at'] = $orderLine->updated_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['status'] = $orderLine->status->stt;
                $nestedData['status_id'] = $orderLine->status->id;
                $nestedData['warehouse'] = $orderLine->warehouse->name;
                $nestedData['warehouse_address'] = $orderLine->warehouse->address;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($draw),
            // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData),
            // total number of records
            "recordsFiltered" => intval($totalFiltered),
            // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data
        );
        return $json_data;
    }

}

