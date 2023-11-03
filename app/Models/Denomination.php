<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denomination extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'value','image'];

    /*public function getImagenAttribute(){

        if($this->image != null)
            return (file_exists('storage/denominations/' . $this->image)? 'denominations/' .$this->image : 'noimg.jpg')
            ;
        else
            return 'noimg.jpg';
    }
    public function getImagenAttribute() {
        return asset('storage/denominations/' . ($this->image ? $this->image : 'noimg.jpg'));
    }
    */

    public function getImagenAttribute() {
        $imagePath = 'storage/denominations/' . ($this->image ? $this->image : 'noimg.jpg');

        // Verifica si la imagen existe en la ruta especificada
        if (file_exists(public_path($imagePath))) {
            return asset($imagePath);
        } else {
            // Si la imagen no existe, muestra la imagen por defecto
            return asset('assets/img/noimg.jpg');
        }
    }
}
