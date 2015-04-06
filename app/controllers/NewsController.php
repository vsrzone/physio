<?php

class NewsController extends BaseController{
	public function __construct() {
		//$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('admin');
	}

	//views create page
	public function getCreate(){
		return View::make('admin.news.add')
			->with('categories', Category::lists('name', 'id'));
	}

	//news add function
	public function postCreate(){
			
		$news = new News;
		$news->title = Request::input('title');
		$news->active = Request::input('active');
		$news->members_only = Request::input('member');
		$news->category_id = Request::input('category_id');
		$news->news_date = Request::input('date');
		$news->content = Request::input('content');
		if($news->active == null){
			$news->active = 0;
		}
		if($news->members_only == null){
			$news->members_only = 0;
		}
		if($news->news_date == null){
			$news->news_date = date('Y-m-d');
		}
		
		$news->created_by = Auth::user()->member_id; 
		
		$news->save();
		return $news->id;
		
	}

	//all news view page
	public function getIndex(){
		$news = DB::table('news')
			->leftJoin('categories', 'categories.id', '=', 'category_id')
			->select('news.id','title', 'news_date','name')						
	        ->paginate(10);
		return View::make('admin.news.index')
			->with('allnews', $news);
	}

	//view edit page
	public function postEdit(){
		$news = News::find(Input::get('id'));

		if($news){

			return View::make('admin.news.edit')
				->with('news', $news)
				->with('categories', Category::lists('name', 'id'));

		}
		return Redirect::to('admin/news/index')
			->with('message', 'Something went wrong. Pease try again');
	}

	//edit function
	public function postUpdate(){
		$news = News::find(Input::get('id'));

		if($news){
			$validator = Validator::make(Input::all(), News::$rules);

			if($validator->passes()){
				$news->title = Input::get('title');
				$news->active = Input::get('active');
				$news->members_only = Input::get('member');
				$news->category_id = Input::get('category_id');
				$news->news_date = Input::get('date');
				$news->content = Input::get('content');
				if($news->active == null){
					$news->active = 0;
				}
				if($news->members_only == null){
					$news->members_only = 0;
				}
				if($news->news_date == null){
					$news->news_date = date('Y-m-d');
				}

				$news->created_by = '1'; //get user names form auth class
				
				$news->save();
				return Redirect::to('admin/news/index')
					->with('message', 'News has been updated successfully!!!');
			}

			return Redirect::to('admin/news/index')
				->with('message', 'Following errors occured')
				->withErrors($validator);
		}

		return Redirect::to('admin/news/index')
			->with('message', 'Something went wrong');
	}

	//delete news
	public function postDestroy(){
		$news = News::find(Input::get('id'));

		if($news){
			while( $image = DB::table('images')->where('news_id', '=', $news->id)->first()){
				$dat = Image::find($image->id);
				$target = "uploads/images/".$dat->name;
			
				if(file_exists($target)){
					unlink($target);
				}

				$dat->delete();
			}
			$news->delete();

			return Redirect::to('admin/news/index')
				->with('message', 'News deleted successfully');
		}

		return Redirect::to('admin/news/index')
			->with('message', 'Something went wrong. Please try again');
	}

	// save the image album to the database
	public function postAlbum() {

		$img_data = Request::input('image');
		$img_id = Request::input('id');

		if($img_data){
			$image = DB::table('images')->max('id');
				if(!$image) {
					$img_name = time().'.jpeg';
				} else {
					$img_name = $image.time().'.jpeg';
				}
			
			//$img_name = time().'.jpeg';
			$im = imagecreatefromjpeg($img_data);
			imagejpeg($im, 'uploads/images/'.$img_name, 70);
			imagedestroy($im);
		}

		$img = new Image;
		$img->name = $img_name;
		$img->news_id = $img_id;

		$img->save();
		return $img_name;
	}
}