<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;   
 // Optional: Soft Deletes

class Purchase extends Model
{
    use HasFactory, SoftDeletes; // Optional: Soft Deletes

    protected $fillable = [
        'supplier_id',
        'raw_material_id',
        'quantity',
        'purchase_price',
        'purchase_date',
    ];

    protected $casts = [
        'quantity' => 'decimal:8,2',
        'purchase_price' => 'decimal:8,2',
        'purchase_date' => 'datetime',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class); // Assuming 'Supplier' model exists
    }

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class); // Assuming 'RawMaterial' model exists
    }

    // Optional: Soft Deletes methods (if enabled)
    public function restore()
    {
        parent::restore();
    }

    public function forceDelete()
    {
        parent::forceDelete();
    }
}