<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use App\Models\Category;

class NavController extends Controller
{
	public static function leftNav() {
		$cats = Category::orderBy('cat_order')->get()->map(function( $item ) {
			$item->posts = Post::where('category_id', $item->id)->orderBy('order')->get();
			return $item;
		});

		return $cats;
	}
}
