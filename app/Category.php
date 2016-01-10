<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany('App\Category', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public static function getAllCategories()
    {
        return static::where('del_flag', UN_DELETE)->get();
    }
    /**
     * get all categories array format of system
     *
     * @return array
     */
    public static function getAllParentCategory($category = null)
    {
        $arrCategories = static::get()->lists('title', 'id')->toArray();
        $arrCategories = array_merge([STR_SUPER_PARENT_CATEGORY], $arrCategories);
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

    public static function getChildCats($parentIds)
    {
        $childIds = static::getChildCatIds($parentIds);

        return static::whereIn('id', $childIds)->get()->lists('title', 'id')->toArray();
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

        static::whereIn('id', array_merge($childIds, [(int) $id]))->update(['del_flag' => DELETED]);
    }
}
