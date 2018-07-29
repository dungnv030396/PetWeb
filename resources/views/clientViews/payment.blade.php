<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
<div>
    <aside class="col-sm-auto">
        <p style="color: #0f3e68"><b>Thanh toán trực tuyến</b></p>

        <article class="card">
            <div class="card-body p-5">
                <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
                            <i class="fa fa-credit-card"></i> Credit Card</a></li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
                            <i class="fab fa-paypal"></i> Paypal</a></li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
                            <i class="fa fa-university"></i> Bank Transfer</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="nav-tab-card">
                        <p> <img src="http://bootstrap-ecommerce.com/main/images/icons/pay-visa.png">
                            <img src="http://bootstrap-ecommerce.com/main/images/icons/pay-mastercard.png">
                            <img src="http://bootstrap-ecommerce.com/main/images/icons/pay-american-ex.png">
                        </p>
                        <!-- <p class="alert alert-success"></p> -->
                        <form role="form">
                            <div class="form-group">
                                <label for="username">Full name (on the card)*</label>
                                <input type="text" class="form-control" name="payment_name" placeholder="Họ tên" >
                            </div> <!-- form-group.// -->

                            <div class="form-group">
                                <label for="cardNumber">Card number*</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="payment_cardnumber" placeholder="Số thẻ"
                                           >
                                    <div class="input-group-append">
                                    </div>
                                </div>
                            </div> <!-- form-group.// -->

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label><span class="hidden-xs">Expiration</span> </label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" placeholder="MM" min="1" max="12" name="month">
                                            <input type="number" class="form-control" placeholder="YY" min="{{ date('Y') }}" max="2100" name="year">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label data-toggle="tooltip" title=""
                                               data-original-title="3 digits code on back side of the card">CVV* <i
                                                    class="fa fa-question-circle"></i></label>
                                        <input type="number" class="form-control" name="cvv">
                                    </div> <!-- form-group.// -->
                                </div>
                            </div> <!-- row.// -->
                        </form>
                    </div> <!-- tab-pane.// -->
                    <div class="tab-pane fade" id="nav-tab-paypal">
                        <p>Paypal là cách dễ nhất để thanh toán trực tuyến</p>
                        <p>
                            <button type="button" class="btn btn-primary"><i class="fab fa-paypal"></i> Log in my Paypal
                            </button>
                        </p>
                        <p><strong>Note:</strong>Chắc chắn rằng bạn có tài khoản paypal và sử dụng thành thạo</p>
                    </div>
                    <div class="tab-pane fade" id="nav-tab-bank">
                        <p>Thông tin tài khoản ngân hàng</p>
                        <dl class="param">
                            <dt>Ngân hàng:</dt>
                            <dd> Vietcombank</dd>
                        </dl>
                        <dl class="param">
                            <dt>Số tài khoản:</dt>
                            <dd> 12345678912345</dd>
                        </dl>
                        <dl class="param">
                            <dt>Chủ tài khoản:</dt>
                            <dd> Công ty The Pet Family</dd>
                        </dl>
                        <p><strong>Note:</strong> Khi chuyển khoản vui lòng kiểm tra kĩ thông tin tài khoản kèm nội dung: TPF-Thanh toán cho 'email'.</p>
                    </div> <!-- tab-pane.// -->
                </div> <!-- tab-content .// -->

            </div> <!-- card-body.// -->
        </article> <!-- card.// -->


    </aside> <!-- col.// -->
</div>
