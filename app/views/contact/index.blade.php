@extends('layouts.main')

@section('content')
	<ul id="slider" class="col-xs-12">
		<li>
			<img src="images/slider4.jpg" width="100%" height="auto" alt="Physiotherapysts Association" title="Physiotherapysts Association">
			<h2>Contact Us Here, But Play Outside</h2>
		</li>
		<h3 id="breadcrumb">Contact Us</h3>
	</ul>
	<div class="col-xs-12 col-md-3" id="news-section">
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
		<label>Name</label>
		<input type="text" name="name" id="name-txt">
		<label>Email</label>
		<input type="text" name="email" id="email-txt">
		<label>Phone</label>
		<input type="text" name="phone" id="phone-txt">
		<label>Message</label>
		<textarea type="text" name="message" id="message-txta"></textarea>
	</div>
@stop