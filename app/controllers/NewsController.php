<?php

class NewsController extends BaseController{
	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	//views create page
	public function getCreate(){
		return View::make('admin.news.add')
			->with('categories', Category::lists('name', 'id'));
	}

	//news add function
	public function postCreate(){
		$validator = Validator::make(Input::all(), News::$rules);

		if($validator->passes()){
			$news = new News;
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

			$news->created_by = '1'; //get user names form auth class
			
			$news->save();
			return Redirect::to('admin/news/create')
				->with('message', 'News has been added successfully!!!');
		}
		return Redirect::to('admin/news/create')
			->with('message', 'Following errors occured')
			->withErrors($validator);
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
}