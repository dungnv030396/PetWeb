<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use function Sodium\add;

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
//            1 => 'name',
            2 => 'category_id',
            3 => 'price',
            4 => 'quantity',
            5 => 'discount',
            6 => 'image_link',
            7 => 'description',
            8 => 'created_at',
            9 => 'updated_at'
        );
        // $page = floor($start / $length) + 1;
        $productList = Product::where('user_id', Auth::user()->id)->where('delete_flag', 0);
        $totalData = $productList->count();
        if (empty($search)) {
            $products = Product::where('user_id', Auth::user()->id)->where('delete_flag', 0)
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $totalData;
        } else {
            $products = Product::where(function ($query) use ($search, $oderColunm, $oderSortType) {
                $query->where('user_id', Auth::user()->id)->where('name', 'like', "%$search%");
            })
                ->where('delete_flag', '=', 0)
                ->where('user_id', Auth::user()->id)
                ->Where('created_at', 'like', "%$search%")
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
//                $nestedData['category'] = $product->categories['name'];
                $nestedData['name'] = $product->name;
                $nestedData['price'] = $product->price;
                $nestedData['quantity'] = $product->quantity;
                $nestedData['discount'] = $product->discount;
                $nestedData['image_link'] = $product->image_link;
                $nestedData['description'] = $product->description;
                $nestedData['created_at'] = $product->created_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['updated_at'] = $product->updated_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['productDetail'] = '<a href="' . route('productDetailBySupplier', $product->id) . '">Chi Tiết Sản Phẩm</a>';
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
