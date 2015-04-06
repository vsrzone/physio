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

				$image->delete();
				$path = "uploads/images/".$image->name;
				
				if(file_exists($path)){
					unlink($path);
				}
			}

			return Redirect::to('admin/news/index')
			->with('message', 'Images deleted successfully');
		}

		return Redirect::to('admin/news/index')
			->with('message', 'No images were selected');
		
	}
}