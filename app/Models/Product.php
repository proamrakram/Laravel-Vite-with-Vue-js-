<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'image',
        'name',
        'production_date',
        'expiry_date',
        'price',
        'barcode_number',
        'unit',
        'is_available',
        'description',
    ];

    #Filter Scope
    public function scopeFilter(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
        ], $filters);

        if ($filters['search'] !== '') {

            $builder->where(function (Builder $builder) use ($filters) {

                $builder

                    ->where('name', 'like', "%{$filters['search']}%")

                    ->orWhere('barcode_number', 'like', "%{$filters['search']}%")

                    ->orWhere('unit', 'like', "%{$filters['search']}%")

                    ->orWhere('price', 'like', "%{$filters['search']}%")

                    ->orWhereHas('category', function (Builder $builder) use ($filters) {
                        $builder->where('ar_name', 'like', "%{$filters['search']}%");
                    });
            });
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
