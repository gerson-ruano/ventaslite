<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];

    public function products()
    {
        return $this->hasMany(Product::class);
    } 

    /*public function getImagenAttribute(){

        if(file_exists('storage/categories/' . $this->image))
            return $this->image;
        else
            return 'noimg.jpg';
    }*/

    public function getImagenAttribute() {
        return asset('storage/categories/' . ($this->image ? $this->image : 'noimg.jpg'));
    }
}
