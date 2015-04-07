<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
				<div class="form-group">
					<label>Title</label>
					<input id="input-vacancies-title" data-key="title" class="form-control" placeholder="Title">
				</div>
				<div class="form-group" id="type-radio">
					<label>Type</label>
					<div class="radio">
	                    <label>
	                        <input type="radio" name="typeRadios" value="onboard" checked="">onboard
	                    </label>
	                </div>
	                <div class="radio">
	                    <label>
	                        <input type="radio" name="typeRadios" value="onshore" checked="">onshore
	                    </label>
	                </div>
				</div>
				<div class="form-group">
                    <label>Description</label>
                    <textarea id="input-vacancies-desc" data-key="desc" style="resize:vertical" class="form-control" rows="3" placeholder="description"></textarea>
                </div>
                <button id="accept-form" class="btn btn-default"><?php echo $view; ?></button>
			</div>
		</div>
	</div>
</div>