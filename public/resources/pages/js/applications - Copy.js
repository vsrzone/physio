var curr_page = 1;


// view
var populateTable = function(page){
	var action = 'getAllApplicationsWithVacancyTitle';
	var controller = 'applications';
	var variables = { page : page };
	var callback = function(res){
		clearTable();
		var additional_cells = [];
		additional_cells[0] = '<td class="view-cell"><a class="view-icon">view</a></td>';
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
	var action = 'getAllApplicationsCount';
	var controller = 'applications';
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
	var action = 'deleteApplicationsById';
	var controller = 'applications'
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
	var action = 'addApplicationsRecord';
	var controller = 'applications';
	var variables = {};

	$('.form-control').each(function () {
		variables[$(this).data('key')] = $(this).val();
	});

	$('#accept-form').html('sending..');

	var callback = function (res) {
		window.location.href = 'applications.php'
	}

	sendRequestToServer(url,action,controller,variables,callback);
};

//edit

var populateEditForm = function(){
	var action = 'getApplicationsById';
	var controller = 'applications';
	var variables = {id:record_id}

	var callback = function (res) {
		data = JSON.parse(res);
		$('.form-control').each(function () {
			$(this).val(data[$(this).data('key')]);
		});
	}

	sendRequestToServer(url,action,controller,variables,callback);
}

var updateRecord = function(){
	var action = 'updateApplicationsRecord';
	var controller = 'applications';
	var update = {};
	$('.form-control').each(function () {
		update[$(this).data('key')] = $(this).val();
	});

	var variables = {id:record_id,update:update};	

	$('#accept-form').html('sending..');

	var callback = function (res) {
		window.location.href = 'applications.php'
	}

	sendRequestToServer(url,action,controller,variables,callback);
}

//view
var viewRecord = function(id,element){
	window.open("applications/application.php?id="+id);
}
