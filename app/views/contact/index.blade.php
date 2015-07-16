<?php 
	$page = 'contact';
?>

@extends('layouts.main')

@section('content')

@if(Session::has('message'))

	<div class="alert alert-danger">{{ Session::get('message') }}</div>

@endif

<div id="banner-container">
		<ul id="main-slider" class="">
			<li style="background-image:url({{ url() }}/images/slider/03.jpg)">
				<p>"Looking after your health today gives you a better hope for tomorrow."</p>
			</li>
		</ul>
	</div>
</div>

<div class="container page-wrapper" id="about-wrapper">
	<div class="row">
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
		<div class="col-xs-12 col-md-3">
			<h3>Head Office</h3>
			<p>
				Government Physiotherapist's Association,<br/>
				Department of Physical Medicine<br/>
				National Hospital, Colombo.<br/>
				Sri Lanka<br/>
			</p>

			<p>Telephone: <a href="tel:+94111231232">077-2485468</a></p>
			<p>Email: secretarygpa@gmail.com</p>

		</div>
		<div class="col-xs-12 col-md-9" id="contact-info">
			<h3>Quick Contact Form</h3>
			<p>If you want to find out more about our services simply fill below and we will get back to you right away.</p>
			
			<form method = "post" action = "contact">
				<label>Name</label>
				<input type="text" name="name" id="name-txt">
				<label>Email</label>
				<input type="text" name="email" id="email-txt">
				<label>Phone</label>
				<input type="text" name="phone" id="phone-txt">
				<label>Message</label>
				<textarea name="message" id="message-txta"></textarea><br>
				<label>&nbsp;</label>
				<input type="submit" value = "Submit" class="btn">
			</form>
		</div>
	</div>
</div>
@stop