var curr_page = 1;


// view
var populateTable = function(page){
	var action = 'getAllNews';
	var controller = 'news';
	var variables = { page : page };
	var callback = function(res){
		clearTable();
		var additional_cells = [];
		additional_cells[0] = '<td class="edit-cell"><a class="edit-icon">edit</a></td>';
		additional_cells[1] = '<td class="delete-cell"><a class="delete-icon">delete</a></td>';
		drawTable(JSON.parse(res),additional_cells);
	}
	sendRequestToServer(url,action,controller,variables,callback);
}

var clearTable = function(){
	$('#data-table tbody tr').remove();
}


var drawTable = function(data,additional_cells){
	for (var i = 0; i < data.length; i++) {
		var row = $('<tr></tr>');
		for(var key in data[i]){
			var class_name = 'data-' + key;
			row.append('<td class="'+class_name+'">'+data[i][key]+'</td>');
		}
		for (var j = 0; j < additional_cells.length; j++) {
			row.append($(additional_cells[j]));
		};
		if(data[i]['id'] != undefined){row.data('id',data[i]['id']);}
		$('#data-table').append(row);
	}
}

var drawPagination = function(){
	var action = 'getAllNewsCount';
	var controller = 'news';
	var variables = '';

	$(table_pagination).html('');

	var callback = function (res) {
		res = Math.ceil(res/pagination_count);
		for (var i = 1; i <= res; i++) {
			var button = $('<li class="paginate_button"><a>'+i+'</a></li>');
			button.data('page',i);
			$('#table_pagination').append(button);
		};
	}
	sendRequestToServer(url,action,controller,variables,callback);
}

var deleteRecord = function(id,element){
	var action = 'deleteNewsById';
	var controller = 'news'
	var variables = {id:id};
	var callback = function (res) {
		if(res==1){
			populateTable(curr_page);
			drawPagination();
		}
	}

	sendRequestToServer(url,action,controller,variables,callback);
}



//add
var addRecord = function(){
	var action = 'addNewsRecord';
	var controller = 'news';
	var variables = {};

	$('.form-control').each(function () {
		variables[$(this).data('key')] = $(this).val();
	});

	if(uploadImage != undefined){
		variables['photo'] = encodeURIComponent(uploadImage);
	}

	$('#accept-form').html('sending..');

	var callback = function (res) {
		window.location.href = 'news.php'
	}

	sendRequestToServerPost(url,action,controller,variables,callback);
};

//edit

var populateEditForm = function(){
	var action = 'getNewsById';
	var controller = 'news';
	var variables = {id:record_id}

	var callback = function (res) {
		data = JSON.parse(res);
		$('.form-control').each(function () {
			$(this).val(data[$(this).data('key')]);
		});

		if(data['active'] == 1){
			$('#input-news-active').prop('checked',true);
		} else {
			$('#input-news-active').prop('checked',false);
		}

		canvas = document.getElementById('photo-canvas');
		ctx = canvas.getContext("2d");
		var image = new Image();
		image.onload = function(){
			canvas.width = image.width;
			canvas.height = image.height;
			ctx.drawImage(image,0,0,canvas.width,canvas.height);
		};
		image.src = http_path+'images/uploads/'+data['photo'];
	}
	sendRequestToServer(url,action,controller,variables,callback);
}

var updateRecord = function(){
	var action = 'updateNewsRecord';
	var controller = 'news';
	var update = {};
	$('.form-control').each(function () {
		update[$(this).data('key')] = $(this).val();
	});


	if($('#input-news-active:checked').length == 1) {
		update['active'] = 1;
	} else {
		update['active'] = 0;
	}

	if(uploadImage != undefined){
		update['photo'] = encodeURIComponent(uploadImage);
	}

	var variables = {id:record_id,update:update};	
	$('#accept-form').html('sending..');

	var callback = function (res) {
		window.location.href = 'news.php'
	}

	sendRequestToServerPost(url,action,controller,variables,callback);
}

var fr;
var img;
var uploadImage;

$('#photo-input').change(function(){
	var file = this.files[0];
	fr = new FileReader();
	fr.onload = loadPhoto;  
	fr.readAsDataURL(file);
});

loadPhoto = function(){
	img = new Image();
	img.onload = drawImage;
	img.src = fr.result;
}

drawImage = function(){
	canvas = document.getElementById('photo-canvas');
	var maxWidth = 640;
	var maxHeight = 480;
	if(maxWidth > img.width){
		canvas.width = img.width;
		canvas.height = img.height
	}else{
		canvas.width = maxWidth;
		canvas.height = (img.height / img.width) * maxWidth;
	}

	if(canvas.height > maxHeight){
		canvas.width = (canvas.width / canvas.height) * maxHeight;
		canvas.height = maxHeight;
	}

	ctx = canvas.getContext("2d");

	ctx.drawImage(img,0,0,canvas.width,canvas.height);
	uploadImage = canvas.toDataURL('Image/jpeg',.7);
	uploadImage = encodeURIComponent(uploadImage);
}