<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\NavController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;

class PostController extends Controller
{

	/**
	 * The Post Archive Page.
	 *
	 * @return Response
	 */

	public function archive()
	{
		return Inertia::render('Archive', [
			'posts' => Post::with('category:id,name')->orderBy('order')->get()->map(function ($post) {
				$post->body = Str::of($post->body)->markdown();
				return $post;
			}),
			'leftNavData' => NavController::leftNav(),
		]);
	}

	/**
	 * Show the form for creating a new Post.
	 *
	 * @return Response
	 */

	public function adminIndex()
	{
		$posts = Post::with('category:id,name')->orderBy('order')->get();
		return Inertia::render('Admin/Posts', [
			'posts' => $posts,
			'categories' => Category::orderBy('cat_order')->get(),
		]);
	}

	/**
	 * The Post Archive Page.
	 *
	 * @return Response
	 */

	public function single($param)
	{
		$post = Post::where('slug', $param)
			->with('category')
			->firstOrFail();

		$post->body = Str::of($post->body)->markdown();

		return Inertia::render('Single', [
			'post' => $post,
			'leftNavData' => NavController::leftNav(),
		]);
	}

	/**
	 * Create/Update a Post.
	 *
	 * @todo: Add validation.
	 *
	 * @return Response
	 */
	public function update(Request $request)
	{
		$id   = $request->input('id') ? $request->input('id') : '';
		$post = Post::where('id', $id)->firstOrNew();

		$validatedData = $request->validate([
			'title' => 'required|max:255',
			'body' => 'required',
			'category_id' => 'required|exists:categories,id',
			'remove_featured_image' => 'boolean',
			'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);

		$post->title = $validatedData['title'];
		$post->body = $validatedData['body'];

		if ($request->file('img')) {
			$img_name = $request->img->getClientOriginalName();
			$img_obj = $request->img->move( public_path('featured_images'), $img_name );
			$img_path = strstr($img_obj->getPathname(), '/featured_images');
			$post->featured_image = $img_path;
		} elseif ($request->input('remove_featured_image')) {
			$post->featured_image = '';
		}

		// Save a copy of the post as a Markdown file
		$filename = Str::substr( Str::slug($post->title), 0, 30) . '.md';
		$content = "# {$post->title}\n\n{$post->body}";
		$return = Storage::put('public/markdown/' . $filename, $content);

		// Update the slug.
		$post->slug = Str::slug($post->title);
		$post->save();

		// Update the order numbers of all posts.
		$order = !empty($request->input('order')) ? $request->input('order') : 1;
		$this->updateOrder($post, $order);

		// Update the category of the post.
		$category_id = !empty($request->input('category_id')) ? intVal($request->input('category_id')) : 0;
		$this->updatePostCategory($post, $category_id);

		return back();
	}

	/**
	 * Delete a Post.
	 *
	 * @return Response
	 */
	public function delete(Request $request)
	{
		if ($request->has('id')) {
			Post::find($request->input('id'))->delete();
			return back();
		}
	}


	public function search(Request $request)
	{

		if (empty($request->input('query'))) {
			return response()->json([]);
		}

		$validatedData = $request->validate([
			'query' => 'string|max:255',
		]);

		$query = $validatedData['query'];
		$posts = DB::table('posts')->where('title', 'like', '%' . $query . '%')
			->orWhere('body', 'like', '%' . $query . '%')->get();

		return response()->json($posts);
	}

	public function updateOrder(Post $post, int $position)
	{
		$targetPostId = $post->id;
		$all = Post::orderBy('order')->get()->filter(function ($item) use ($targetPostId) {
			return $item->id !== $targetPostId;
		});

		$post->update(['order' => $position]);

		$order = 1;
		// loop through all posts and update the order, setting the target post to the new position.
		foreach ($all as $item) {
			if ($order === $position) {
				$order++;
			}
			$item->update(['order' => $order]);
			$order++;
		}
	}

	public function updatePostCategory(Post $post, int $catId)
	{
		// Convert the post to a model instance.
		$post = Post::find($post->id);
		$cat = Category::find($catId);

		// Associate the category with the post.
		$post->category()->associate($cat);
		$post->save();
	}
}
