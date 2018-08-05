@extends('layouts.master')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h2 class="inner-title main-color">Liên Hệ</h2>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index">Trang Chủ</a> / <span>Liên Hệ</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
</div>
<div class="beta-map">
	
	<div class="abs-fullwidth beta-map wow flipInX"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d961.8484715931163!2d105.52570905354273!3d21.012864011671915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b32ca5086d%3A0xa3c62e29d8ab37e4!2sFPT+University!5e0!3m2!1sen!2s!4v1532451125221"></iframe></div>
</div>
<div class="container">
	<div id="content" class="space-top-none">
		
		<div class="space50">&nbsp;</div>
		<div class="row">
			<div class="col-sm-8">
				<h2>Mẫu Liên Hệ</h2>
				<div class="space20">&nbsp;</div>
				<p style="color: #f90">Trải qua nhiều năm phát triển,Chúng tôi luôn luôn cung cấp đến người sử dụng những
					trải nghiệm tốt nhất.Chúng tôi luôn sẵn sàng lắng nghe những suy nghĩ của bạn.Nếu bạn có
					góp ý gì xin hãy gửi tới chúng tôi theo mẫu dưới đây.Chúng tôi sẽ cố gắng hồi đáp lại một cách nhanh nhất có thể.</p>
				<div class="space20">&nbsp;</div>
				<form action="#" method="post" class="contact-form">	
					<div class="form-block">
						<input name="your-name" type="text" placeholder="Tên Của bạn">
					</div>
					<div class="form-block">
						<input name="your-email" type="email" placeholder="Địa chỉ email của bạn">
					</div>
					<div class="form-block">
						<input name="your-subject" type="text" placeholder="Tiêu Đề">
					</div>
					<div class="form-block">
						<textarea name="your-message" placeholder="Nội dung tin nhắn của bạn"></textarea>
					</div>
					<div class="form-block">
						<button type="submit" class="beta-btn primary">Gửi Thư <i class="fa fa-chevron-right"></i></button>
					</div>
				</form>
			</div>
			<div class="col-sm-4">
				<h2>Thông Tin Liên Hệ</h2>
				<div class="space20">&nbsp;</div>

				<h6 class="contact-title">Địa Chỉ</h6>
				<p>
					km29 - Đại Lộ Thăng Long<br>
					xã Thạch Hòa, huyện Thạch Thất<br>
					Hà Nội
				</p>
				<div class="space20">&nbsp;</div>
				<h6 class="contact-title">Thắc Mắc Kinh Doanh</h6>
				<p>
					Những vấn đề thắc mắc về kinh doanh và quảng cáo<br>
					xin mời bạn liên hệ qua email. <br>
					<a href="lien-he">thepetfamily@gmail.com</a>
				</p>
				<div class="space20">&nbsp;</div>
				<h6 class="contact-title">Việc Làm</h6>
				<p>
					Chúng tôi luôn luôn tìm kiếm những người có tài năng để <br>
					gia nhập đội ngũ chúng tôi. <br>
					<a href="lien-he">thepetfamily@gmail.com</a>
				</p>
			</div>
		</div>
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection