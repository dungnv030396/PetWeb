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
                    <li class="nav-item active">
                        <a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
                            <i class="fa fa-credit-card"></i> Credit Card</a></li>
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
                </div> <!-- tab-content .// -->

            </div> <!-- card-body.// -->
        </article> <!-- card.// -->


    </aside> <!-- col.// -->
</div>
