<?php
class ImageController extends Controller {

	public function getCreate() {

		$images = DB::table('images')->where('news_id', '=', Input::get('id'))->get();

		return View::make('admin.image.album')
			->with('news_id', Input::get('id'))
			->with('images', $images);
	}

	public function postAlbum() {

		$img_data = Request::input('image');
		$img_id = Request::input('id');
		$img_name = '';
		if($img_data){
			$image = DB::table('images')->max('id');
				if(!$image) {
					$img_name = time().'.jpeg';
				} else {
					$img_name = $image.time().'.jpeg';
				}
			
			$im = imagecreatefromjpeg($img_data);
			imagejpeg($im, 'uploads/images/'.$img_name, 70);
			imagedestroy($im);
		}

		$img = new Image;
		$img->name = $img_name;
		$img->news_id = $img_id;

		$img->save();

		DB::table('images')
			->where('name', '=', 'default.gif')
			->where('news_id', '=', $img_id)
			->delete();

		return $img_name;
	}

	
	//views album image delete page
	public function getEdit(){

		return View::make('admin.image.edit')
			->with('images', DB::table('images')->where('news_id', '=', Input::get('id'))->get());
	}

	//selected album images delete 
	public function postDestroy(){
		$images = Input::get('imgStatus');

		if($images){
			for ($i=0; $i < sizeof($images); $i++) { 
				$image = Image::find($images[$i]);
				if($image->name != 'default.gif'){
					$image->delete();
					$path = "uploads/images/".$image->name;
					
					if(file_exists($path)){
						unlink($path);
					}		
	
			}else{
				return Redirect::to('admin/news/index')
					->with('message', 'Add images to remove default image for the news');
			}
			
		}
		if(!DB::table('images')->where('news_id', '=', $image->news_id)->first()){
			$def = new Image;
			$def->name = 'default.gif';
			$def->news_id = $image->news_id;
			$def->save();
		}

		return Redirect::to('admin/news/index')
					->with('message', 'Images deleted successfully');			
				
		}

		return Redirect::to('admin/news/index')
			->with('message', 'No images were selected');
		
	}
}