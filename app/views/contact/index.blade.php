@extends('layouts.main')

@section('content')

@if(Session::has('message'))

	<div class="alert alert-danger">{{ Session::get('message') }}</div>

@endif

@if($errors->has())
	<div class="alert alert-danger">
		<p> The following errors has occurred:</p>

		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
<div class="container-fluid">
	<div class="row">
		<ul id="main-slider" class="col-xs-12">
			<li>
				<img src="{{ url() }}/images/slider4.jpg" width="100%" height="auto" alt="Physiotherapysts Association" title="Physiotherapysts Association">
				<p>Contact Us Here, But Play Outside</p>
			</li>
			<h3 id="breadcrumb">Contact Us</h3>
		</ul>
	</div>
</div>
<div class="container page-wrapper" id="about-wrapper">
	<div class="row">
		<div class="col-xs-12 col-md-3">
			<h3>Head Office</h3>
			<p>
				DieSachbearbeiter<br/>
				Schonahauser Allee 167c<br/>
				10435 Berlin<br/>
				Germany<br/>
			</p>

			<p>Telephone: <a href="tel:+94111231232">011-1231232</a></p>
			<p>Fax: 011-4212232</p>

		</div>
		<div class="col-xs-12 col-md-9" id="contact-info">
			<h3>Quick Contact Form</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
			
			<form method = "post" action = "contact">
				<label>Name</label>
				<input type="text" name="name" id="name-txt">
				<label>Email</label>
				<input type="text" name="email" id="email-txt">
				<label>Phone</label>
				<input type="text" name="phone" id="phone-txt">
				<label>Message</label>
				<textarea name="message" id="message-txta"></textarea><br>
				<input type="submit" value = "Submit">
			</form>
		</div>
	</div>
</div>
@stop