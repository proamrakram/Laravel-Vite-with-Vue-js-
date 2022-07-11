<?php

namespace App\Http\Controllers\ModelsControllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Traits\Checking;
use App\Traits\Uploading;

class ProductController extends Controller

{
    #Notes Here we have two trait for working with images and checking disk storage
    # =====> For uploading images
    use Uploading;
    # =====> For checking disk storage
    // (for example, if the image is exist or not,
    // if yes not upload it again, just take it from storage)
    use Checking;

    public function index()
    {
        $products  = Product::with('category')->paginate(10);
        return response()->json([
            'products' => $products, ]);
    }

    public function trash()
    {
        $products = Product::onlyTrashed()->with('category')->paginate(10);
        return response()->json([
            'products' => $products, ]);
    }

    public function store(StoreProductRequest $request)
    {
        ($request->image_path) ? $image_path = $this->imageExsit($request, $request->image_path, '/products-management/images/') : $image_path = null;

        (!$image_path) ? $image_path = $this->resizeImagePost($request, '/products-management/images/') : null;


        $product = Product::create([
            'category_id' => $request->category_id,
            'image' => $image_path,
            'name' => $request->name,
            'production_date' => $request->production_date,
            'expiry_date' => $request->expiry_date,
            'price' => $request->price,
            'barcode_number' => $request->barcode_number,
            'unit' => $request->unit,
            'is_available' =>  $request->is_available,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => __('Product has been created successfully'),
            'product' => $product,
        ]);

    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        ($request->image) ? $image = $this->imageExsit($request, $request->image, '/products-management/images/') : $image = null;

        (!$image) ? $image = $this->resizeImagePost($request, '/products-management/images/') : null;

        $product->update([
            'category_id' => $request->category_id,
            'image' => $image,
            'name' => $request->name,
            'production_date' => $request->production_date,
            'expiry_date' => $request->expiry_date,
            'price' => $request->price,
            'barcode_number' => $request->barcode_number,
            'unit' => $request->unit,
            'is_available' =>  $request->is_available,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => __('Product has been updated successfully'),
            'product' => $product,
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'success' => true,
            'message' => __('Product has been deleted successfully')
        ]);
        // return redirect()->back()->with('success', __('Product Deleted Successfully'));
    }

    public function restore($product_id)
    {
        $product = Product::withTrashed()->findOrFail($product_id);
        $product->restore();
        return redirect()->back()->with('success', __('Product Restored Successfully'));
    }

    public function forceDelete($product_id)
    {
        $product = Product::withTrashed()->findOrFail($product_id);
        $product->forceDelete();
        return response()->json([
            'success' => true,
            'message' => __('Product has been deleted successfully')
        ]);
    }

    public function units()
    {
        return response()->json([
            'units' => config('units.product-units'),
        ]);
    }
}
