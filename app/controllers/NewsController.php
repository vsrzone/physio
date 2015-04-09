<?php

class NewsController extends BaseController{
	public function __construct() {
		//$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('admin', array('except' => array('index', 'allMembersOnlyNews', 'newsSearchByCategory', 'show', 'latestFourNews')));
		$this->beforeFilter('member', array('only'=>'allMembersOnlyNews'));
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
		$news->news_date = Request::input('date').' '.date('h:i:s', time());
		$news->content = Request::input('content');
		$news->summary = Request::input('summary');
		if($news->active == null){
			$news->active = 0;
		}
		if($news->members_only == null){
			$news->members_only = 0;
		}
		if(Request::input('date') == null){
			$news->news_date = date('Y-m-d h:i:s', time());
		}
		
		$news->created_by = Auth::user()->member_id; 
		
		$news->save();

		$img = new Image;
		$img->name = "default.gif";
		$img->news_id = $news->id;

		$img->save();

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
				$news->news_date = Request::input('date').' '.date('h:i:s', time());
				$news->content = Input::get('content');
				$news->summary = Input::get('summary');
				$alert = '';
				if(strlen($news->summary) > 420 ){
					$alert = '<br>Summary has been chuncked since it has exceeded the length!!!';
					$news->summary = substr($news->summary, 1, 420);	
				}
				if($news->active == null){
					$news->active = 0;
				}
				if($news->members_only == null){
					$news->members_only = 0;
				}
				if(Request::input('date') == null){
					$news->news_date = date('Y-m-d h:i:s', time());
				}

				$news->created_by = '1'; //get user names form auth class
				
				$news->save();
				return Redirect::to('admin/news/index')
					->with('message', 'News has been updated successfully!!!'.$alert);
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
			
				if(file_exists($target) && $dat->name != 'default.gif'){
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

		DB::table('images')->where('news_id', '=', $img_id)->where('name', '=', 'default.gif')->delete();

		$img = new Image;
		$img->name = $img_name;
		$img->news_id = $img_id;

		$img->save();
		return $img_name;
	}

	//returns all the public news
	public function index(){

		$news = DB::table('news')
			->join('categories', 'news.category_id', '=', 'categories.id')
			->join('images', function($join)
		        {
		            $join->on('news.id', '=', 'images.news_id')
		                 ->on('images.id', '=',
		                 		DB::raw('(select max(id) from images where news.id = images.news_id)'));	          
		        })
			->where('members_only', '=', 0)
			->where('active', '=', 1)
			->orderby('news_date', 'DESC')
			->select('news.id as news_id' , 'summary', 'categories.name as category_name', 'title', 'news_date', DB::raw('substr(content, 1, 420) as content'), 'images.name as image')					
	        ->paginate(6);
	   
	    $request = Request::create('/categories', 'GET');
	    $categories = Route::dispatch($request)->getContent();
	    
	    //return $news;
		return View::make('news.index')
			->with('news', $news)
			->with('categories', $categories);
	}


	//returns all the public news
	public function allMembersOnlyNews(){

		$news = DB::table('news')
			->join('categories', 'news.category_id', '=', 'categories.id')
			->join('images', function($join)
		        {
		            $join->on('news.id', '=', 'images.news_id')
		                 ->on('images.id', '=',
		                 		DB::raw('(select max(id) from images where news.id = images.news_id)'));	          
		        })
			->where('members_only', '=', 1)
			->where('active', '=', 1)
			->orderby('news_date', 'DESC')
			->select('categories.name as category_name', 'summary', 'title', 'news_date', DB::raw('substr(content, 1, 420) as content'), 'images.name as image')						
	        ->paginate(6);

	    $request = Request::create('/categories', 'GET');
	    $categories = Route::dispatch($request)->getContent();

		return View::make('news.index')
			->with('news', $news)
			->with('categories', $categories);
	}

	//returns all news search by a category
	public function newsSearchByCategory($id){

		$news = DB::table('news')
			->join('categories', 'news.category_id', '=', 'categories.id')
			->where('members_only', '=', 0)
			->join('images', function($join)
		        {
		            $join->on('news.id', '=', 'images.news_id')
		                 ->on('images.id', '=',
		                 		DB::raw('(select max(id) from images where news.id = images.news_id)'));	          
		        })
			->where('active', '=', 1)
			->where('category_id', '=', $id)
			->orderby('news_date', 'DESC')
			->select('title', 'news_date', 'summary','news.id as news_id' ,'categories.name as category_name', DB::raw('substr(content, 1, 420) as content'), 'images.name as image')						
	        ->paginate(6);

	   $request = Request::create('/categories', 'GET');
	   $categories = Route::dispatch($request)->getContent();

		return View::make('news.index')
			->with('news', $news)
			->with('categories', $categories);
	}

	//return contets of a requested news
	public function show($id){
		$news = DB::table('news')
			->where('news.id', '=', $id)
			->where('active', '=', 1)				
			->select('title', 'news_date', 'members_only', 'content')						
	        ->get();
	    if($news){
	    	$images = DB::table('images')
		    			->where('news_id', '=', $id)
		    			->select('name')
		    			->get();
		   
			if(Auth::check()){
				$all_news = DB::table('news')
							->where('active', '=', 1)
							->orderby('news_date', 'DESC')
			  				->select('id', DB::raw('substr(title, 1, 25) as title'))
			  				->take(10)
			  				->get();
			}else{
				 $all_news = DB::table('news')
					->where('members_only', '=', 0)
					->where('active', '=', 1)
					->orderby('news_date', 'DESC')
	  				->select('id', DB::raw('substr(title, 1, 25)'))
	  				->take(10)
	  				->get();
			}

		    if($news){
		    	if($news[0]->members_only == 1){
			    	if(!Auth::check()){    		
			    		return Redirect::to('/');
			    	}
			    }  	    
		    }	 

		   return View::make('news.news')
		   		->with('news', $news)
		   		->with('images', $images)
		   		->with('all_news', $all_news);
	    }

	    return Redirect::to('/news');	    
	}

	//returns the latest 4 news
	public function latestFourNews(){
		if(Auth::check()){
			$news = DB::table('news')
				->join('images', function($join)
		        {
		            $join->on('news.id', '=', 'images.news_id')
		                 ->on('images.id', '=',
		                 		DB::raw('(select max(id) from images where news.id = images.news_id)'));	          
		        })
				->where('active', '=', 1)
				->orderby('news_date', 'DESC')
				->select('news.id', 'summary', 'title', DB::raw('substr(content,1,300) as content'), 'name as image')
				->take(4)
				->get();
		
			return View::make('home.index')
				->with('latest_news', $news);
		}

		$news = DB::table('news')
			->join('images', function($join)
		        {
		            $join->on('news.id', '=', 'images.news_id')
		                 ->on('images.id', '=',
		                 		DB::raw('(select max(id) from images where news.id = images.news_id)'));	          
		        })
			->where('active', '=', 1)
			->where('members_only', '=', 0)
			->orderby('news_date', 'DESC')
			->select('news.id as id', 'summary', 'title', DB::raw('substr(content,1,300) as content'), 'name as image')
			->take(4)
			->get();

			
			return View::make('home.index')
				->with('latest_news', $news);
	}
}