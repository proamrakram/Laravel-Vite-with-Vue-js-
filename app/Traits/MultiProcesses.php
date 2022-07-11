<?php

namespace App\Traits;

use App\Models\Category;
use App\Models\Product;

trait MultiProcesses
{
    public function deleteProducts($request)
    {
        if ($request->ids != []) {
            Product::destroy(request()->ids);
        }
        return response()->json(['success' => __('Products deleted successfully')]);
    }

    public function restoreProducts()
    {
        foreach (request()->ids as $id) {
            $product = Product::withTrashed()->findOrFail($id);
            $product->restore();
        }
        return response()->json(['success' => __('Products restored successfully')]);
    }

    public function forceDeleteProducts($request)
    {
        foreach ($request->ids as $id) {
            $product = Product::withTrashed()->findOrFail($id);
            $product->forceDelete();
        }
        return response()->json(['success' => __('Products deleted successfully')]);
    }

    public function editCategoryProducts($request)
    {
        $category = Category::findOrFail($request->category_id);

        foreach ($request->ids as $id) {
            $product = Product::findOrFail($id);
            $product->update([
                'category_id' => $category->id,
            ]);
        }

        return response()->json(['success' => __('Product categories have been modified successfully')]);
    }

    public function editPriceProducts($request)
    {
        foreach ($request->ids as $id) {
            $product = Product::findOrFail($id);

            $product->update([
                'price' => $request->price,
            ]);
        }

        return response()->json(['success' => __('Product prices have been modified successfully')]);
    }

    public function editAvailabilityProducts($request)
    {
        foreach ($request->ids as $id) {
            $product = Product::findOrFail($id);

            $product->update([
                'is_available' => $request->is_available,
            ]);
        }

        return response()->json(['success' => __('Product availability have been modified successfully')]);
    }

    public function editDescriptionProducts($request)
    {
        foreach ($request->ids as $id) {
            $product = Product::findOrFail($id);

            $product->update([
                'description' => $request->description,
            ]);
        }

        return response()->json(['success' => __('Product descriptions have been modified successfully')]);
    }

    public function editBarcodeProducts($request)
    {
        foreach ($request->ids as $id) {
            $product = Product::findOrFail($id);

            $product->update([
                'barcode_number' => $request->barcode_number,
            ]);
        }

        return response()->json(['success' => __('Product barcodes have been modified successfully')]);
    }

    public function editUnitProducts($request)
    {
        foreach ($request->ids as $id) {
            $product = Product::findOrFail($id);

            $product->update([
                'unit' => $request->unit,
            ]);
        }

        return response()->json(['success' => __('Product units have been modified successfully')]);
    }

    public function editProductionDateProducts($request)
    {
        foreach ($request->ids as $id) {
            $product = Product::findOrFail($id);

            $product->update([
                'production_date' => $request->production_date,
            ]);
        }

        return response()->json(['success' => __('Product production dates have been modified successfully')]);
    }


    public function editExpiryDateProducts()
    {
        foreach (request()->ids as $id) {
            $product = Product::findOrFail($id);

            $product->update([
                'expiry_date' => request()->expiry_date,
            ]);
        }

        return response()->json(['success' => __('Product expiry dates have been modified successfully')]);
    }
}
