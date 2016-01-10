<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_products', 'product_id', 'category_id');
    }

    public static function getAllProduct($isPaginate = false)
    {
        if ($isPaginate) {
            return static::where('del_flag', UN_DELETE)->paginate(PAGINATE_NUM);
        }
        return static::where('del_flag', UN_DELETE)->get();
    }

    public function getCategoryOfProduct()
    {
        $categories = $this->categories->lists('title')->toArray();

        $strTitle = '';
        foreach($categories as $categoryTitle) {
            $strTitle .= $categoryTitle . ', ';
        }

        return rtrim($strTitle, ', ');
    }

    public function updateProduct($inputData)
    {
        $this->name = $inputData['name'];
        $this->model = $inputData['model'];
        $this->save();
        if (isset($inputData['photo'])) {
            $ext = $inputData['photo']->getClientOriginalExtension();
            $photoName = $this->id . '.' . $ext;
            $this->photo = asset(IMG_DIR . $photoName);

            $inputData['photo']->move(public_path(IMG_DIR), $photoName);
            $this->save();
        }

        $this->categories()->sync($inputData['category_id']);
    }

    public static function deleteProduct($id)
    {
        static::where('id', $id)->update(['del_flag' => DELETED]);
    }
}
