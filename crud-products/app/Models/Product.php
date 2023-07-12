<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['image_src'];

    public function getImageSrcAttribute(){
        $fileName = $this->image;
        $urlPath = env('APP_URL') . "/storage/products/" . $fileName;
        return $fileName ? $urlPath : null;
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->selectRaw('id, name');
    }
}
