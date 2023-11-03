<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'barcode','cost','price','stock','alerts','image','category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /*public function getImagenAttribute(){

        if(file_exists('storage/products/' . $this->image))
            return $this->image;
        else
            return 'noimg.jpg';
    }

    public function getImagenAttribute() {
        return asset('storage/products/' . ($this->image ? $this->image : 'noimg.jpg'));
    }
    */

    public function getImagenAttribute() {
        $imagePath = 'storage/products/' . ($this->image ? $this->image : 'noimg.jpg');

        // Verifica si la imagen existe en la ruta especificada
        if (file_exists(public_path($imagePath))) {
            return asset($imagePath);
        } else {
            // Si la imagen no existe, muestra la imagen por defecto
            return asset('assets/img/noimg.jpg');
        }
    }

}
