<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"name", "slug", "price" },
 * @OA\Xml(name="Product"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", maxLength=191, example="IPhone 12"),
 * @OA\Property(property="slug", type="string", readOnly="true", description="slug for the product", example="Iphone-12"),
 * @OA\Property(property="description", type="text", example="IPhone 12 description and specification of item"),
 * @OA\Property(property="price", type="decimal", example="241000.50"),
 * @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp", readOnly="true"),
 * @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp", readOnly="true"),
 * 
 * )
 *
 * Class Product
 *
 */



class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'price'
    ];
}
