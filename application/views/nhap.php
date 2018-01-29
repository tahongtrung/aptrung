         <form action="" method="post" class="validate form-horizontal" role="form">
                    <Div class="row">
                        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/front_end/validationEngine.jquery.css') ?> "  media="all">
                        <script type="text/javascript" src="<?= base_url('assets/js/front_end/jquery.js') ?>" ></script>
                        <script type="text/javascript" src="<?= base_url('assets/js/front_end/jquery.validationEngine-en.js') ?>"></script>
                        <script type="text/javascript" src="<?= base_url('assets/js/front_end/jquery.validationEngine.js') ?>"></script>
                        <script>
                            $(document).ready(function () {
                                $(".validate").validationEngine();
                            });
                        </script>
                        <div class="form-group" >
                            <div class="col-xs-12">
                                <input type="text" placeholder="Họ tên:"  name="full_name" class="validate[required] form-control placeholder" id="personName"
                                       placeholder="Họ Tên" data-bind="value: name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="text" name="email" class="validate[required,custom[email]] form-control placeholder" id="personEmail"
                                       placeholder="Email"
                                       data-original-title="Your activation email will be sent to this address."
                                       data-bind="value: email, event: { change: checkDuplicateEmail }">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="text"  name="address" class="validate[required] form-control placeholder" id="personName"
                                       placeholder="Địa chỉ" data-bind="value: name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="text"  name="phone" class="validate[required,custom[phone]] form-control placeholder" id="phone"
                                       placeholder="Số Điện Thoại"
                                       data-original-title="Your activation email will be sent to this address."
                                       data-bind="value: email, event: { change: checkDuplicateEmail }">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <textarea name="comment" style="height: 165px;"  class="form-control placeholder"
                                          placeholder="Nội dung"></textarea>
                            </div>
                        </div>
                        <div class="form-group text-center row">
                        <input   name="sendcontact"  type="submit" value="Gửi Đi" id="signupuser"
                                style="background: #f01927; border: 1px solid #f01927; width: 65px;"
                                class="btn btn-success btn-sm">
                        <input type="reset" value="Nhập lại" class="btn btn-primary btn-sm">
                    </div>
                    </Div>
                </form>