<?php
class CategoryController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('admin');
	}

	//views create page
	public function getCreate(){
		return View::make('admin.category.add');
	}

	//category create function
	public function postCreate(){

		$validator = Validator::make(Input::all(), Category::$rules);
		if($validator->passes()){

			$name = Input::get('name');
			$cat = DB::table('categories')->where('name', '=', $name)->get();

			if(!$cat){
				$category = new Category;
				$category->name = $name;

				$category->save();
				return Redirect::to('admin/category/create')
					->with('message', 'New category created successfully!!!');
			}

			return Redirect::to('admin/category/careate')
				->with('message', 'Category name already exists. Pleas try with a different name');
			
		}
		
		return Redirect::to('admin/category/create')
			->with('message', 'Following errors occured')
			->withErrors($validator);
		
	}

	//view all categories 
	public function getIndex(){
		return View::make('admin.category.index')
			->with('categories', Category::paginate(10));
	}

	//view edit page
	public function postEdit(){
		$category = Category::find(Input::get('id'));
		if($category){
			return View::make('admin.category.edit')
				->with('category', $category);
		}
		return Redirect::to('admin/category/index')
			->with('message', 'Something went wrong. Please try again');
	}

	//update function
	public function postUpdate(){		
		$category = Category::find(Input::get('id'));

		if($category){
			$category->name = Input::get('name');
			$category->save();

			return Redirect::to('admin/category/index')
				->with('message', 'Category details updated successfully!!!');
		}

		return Redirect::to('admin/category/index')
			->with('message', 'Something went wrong. Please try again');
	}

	//category delete function
	public function postDestroy(){
		$category = Category::find(Input::get('id'));

		if($category){
			$category->delete();
			return Redirect::to('admin/category/index')
				->with('message', 'Category deleted successfully!!!');
		}

		return Redirect::to('admin/category/index')
			->with('message', 'Smething went wrong. Please try again.');
	}
}