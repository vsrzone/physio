<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
				<div class="form-group">
					<label>Title</label>
					<input id="input-news-title" data-key="title" class="form-control" placeholder="Title">
				</div>

				<div class="form-group">
					<label>Intro</label>
					<input id="input-news-intro" data-key="intro" class="form-control" placeholder="Intro">
				</div>

				<div class="form-group">
                    <label>News Content</label>
                    <textarea id="input-news-body" data-key="body" style="resize:vertical" class="form-control" rows="3" placeholder="News Content"></textarea>
                </div>
                <?php

                    if($view == 'edit') {

                    echo '<div class="form-group">
                        <label>Active</label>
                        <input type = "checkbox" name = "input-news-active" id = "input-news-active" data-key="active">
                    </div>';
                    }
                ?>

                <div class="form-group">
                    <label>Photo</label>
                    <input id="photo-input" type="file">
                </div>

                <canvas id="photo-canvas"></canvas>
            </br>
                <button id="accept-form" class="btn btn-default"><?php echo $view; ?></button>
			</div>
		</div>
	</div>
</div>