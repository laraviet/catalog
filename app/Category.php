<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class Category extends Model
{
    protected $table = 'categories';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Product', 'category_products', 'category_id', 'product_id');
    }

    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id')->where('del_flag', UN_DELETE);
    }

    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id')->where('del_flag', UN_DELETE);
    }

    public static function getAllCategories($isPaginate = false)
    {
        if ($isPaginate) {
            return static::where('del_flag', UN_DELETE)->paginate(PAGINATE_NUM);
        }
        return static::where('del_flag', UN_DELETE)->get();
    }

    public function getSuperCategories()
    {
        return static::with('children')->where('del_flag', UN_DELETE)->where('parent_id', SUPER_PARENT_CATEGORY)->get();
    }

    public function getDropdownCategories($cat = null, $space = '')
    {
        if ($cat === null) {
            $categories = static::getSuperCategories();
        } else {
            $categories = $cat->children;
        }
        $arrCategories = [];
        foreach($categories as $category) {
            $temSpace = $space;
            $arrcategory = [];
            $arrcategory['id'] = $category->id;
            $arrcategory['title'] = $temSpace . $category->title;
            $arrCategories[] = $arrcategory;
            if($category->children->count()) {
                $temSpace .= '--';
                $arrCategories = array_merge($arrCategories, $category->getDropdownCategories($category, $temSpace));
            }
        }

        return $arrCategories;
    }
    /**
     * get all categories array format of system
     *
     * @return array
     */
    public static function getAllParentCategory($category = null)
    {
        $arrCategories = static::where('del_flag', UN_DELETE)->lists('title', 'id')->toArray();
        $arrCategories = ['— select parent —'] + $arrCategories;
        if ($category) {
            $exceptCategories = static::getChildCats($category->id);
            $exceptCategories = $exceptCategories +[$category->id => $category->title];
            $arrCategories = array_except($arrCategories, array_keys($exceptCategories));
        }

        return $arrCategories;
    }

    public function getCategoryTitle($parentID)
    {
        if ($parentID === SUPER_PARENT_CATEGORY) {
            return STR_SUPER_PARENT_CATEGORY;
        }
        return self::findOrFail($parentID)->title;
    }

    public static function getCategoryById($ids)
    {
        return Category::with('children')->findOrFail($ids, ['id', 'title']);
    }

    public static function getChildCatIds($parentCatIds)
    {
        $childIds = [];
        $parentCategory = static::getCategoryById($parentCatIds);
        $catDirectChildren = $parentCategory->children->lists('id')->toArray();
        $childIds = array_merge($childIds, $catDirectChildren);

        foreach($catDirectChildren as $catId) {
            $childIds = array_merge($childIds, static::getChildCatIds($catId));
        }

        return $childIds;
    }

    public static function getProductByCatIds($catId)
    {
        $catIds = static::getChildCatIds($catId);
        $catIds = array_merge($catIds, (array) (int)$catId);
        $categories = static::whereIn('id', $catIds)->get();
        $arrProduct = [];
        foreach($categories as $category) {
            foreach($category->products as $product) {
                $arrProduct[] = $product->id;
            }
        }

        return $products = Product::whereIn('id', $arrProduct)->paginate(PAGINATE_NUM);
    }

    public static function getChildCats($parentIds)
    {
        $childIds = static::getChildCatIds($parentIds);

        return static::whereIn('id', $childIds)->get()->lists('title', 'id')->toArray();
    }

    public function isEndChild()
    {
        if ($this->children->count()) {
            return false;
        }
        return true;
    }

    public static function getAllEndChildrenCategory()
    {
        $allCategories = static::getAllCategories();
        $endChildrenCategory = new EloquentCollection;
        foreach($allCategories as $category) {
            if ($category->isEndChild()) {
                $endChildrenCategory->push($category);
            }
        }
        return $endChildrenCategory->lists('title', 'id')->all();
    }

    public function updateCategory($inputData)
    {
        $this->title = $inputData["title"];
        $this->parent_id = $inputData["parent_id"];

        $this->save();
    }

    public static function deleteCategory($id)
    {
        $childIds = static::getChildCatIds($id);
        $ids = array_merge($childIds, [(int) $id]);

        static::whereIn('id', $ids)->update(['del_flag' => DELETED]);

        $categories = static::whereIn('id', $ids)->get();
        foreach($categories as $category) {
            $arrProduct = [];
            foreach($category->products as $product) {
                $arrProduct[] = $product->id;
            }
            $category->products()->detach($arrProduct);
        }
    }
}
