<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/login.css'); ?>
<?php $user_type = element('user_type', $view); ?>
<div class="login_bg"></div>
<div class="login">
    <div class="header">
        <img src="<?= base_url('assets/images/basic/logo_big.png') ?>"/>
        <p>아파트키퍼</p>
    </div>
    <?php
    $attributes = array('name' => 'login_form', 'id' => 'login_form');
    echo form_open(base_url('login'));
    ?>
    <?= validation_errors() ? validation_errors('<p class="notice">', '</p>') : '' ?>
    <label for="user_email">
        <input type="text" class="form_default animate-3" name="id" placeholder="아이디"
        autocomplete="off" required/>
    </label>
    <label for="user_pass">
        <input type="password" class="form_default animate-3" placeholder="비밀번호" name="pw"
        autocomplete="off" required/>
    </label>
    <div class="btn_panel">
        <input type="submit" class="btn_default btn_dark btn_circle btn_long animate-3" value="로그인"/>
    </div>

    <?php echo form_close(); ?>
    <div class="btn_panel">
        <a id="btn_forgat_id">아이디</a> /
        <a id="btn_forgat_pw">비밀번호</a> 찾기
    </div>
</div>
<div id="forgat_id" class="forgat animate-3">
    <div class="search_content_wrapper">
        <p class="header">아이디 찾기</p>
        <p>등록한 정보로 아이디를 찾을 수 있습니다.</p>
        <div class="forgat_input_div">
            <label>
                <span>이름</span>
                <input type="text" id='name'>
            </label>
            <div>
                <label>
                    <span>전화번호</span>
                    <input type="tel" id="id_tel" class="tel" placeholder="'-'빼고 입력해주세요.">
                </label>
                <button type="button" class="forgat_btn" id="id_btn" onclick="tel_send('id_btn')">인증</button>
            </div>
            <div class="tel_check_box">
                <input type="hidden" id="id_tel_check" class="tel_check" value="">
                <div>
                    <label>
                        <span>인증번호</span>
                        <input type="tel" id="id_num" class="num">
                    </label>
                    <button type="button" class="forgat_btn check_num" onclick="check_num('id_btn')">확인</button>
                </div>
            </div>
        </div>
        <button type="button" id="get_id_btn" class="btn_default forgat_btn_radius disabled animate-3" onclick="get_id()">아이디찾기</button>
        <div class="result_div">
            <p class="header"><span></span>으로 찾은 결과 입니다.</p>
            <p>아이디 찾기가 완료되었습니다.</p>
            <ul>
                <li id="li_1">
                    <span>아이디</span>
                    <span></span>
                </li>
                <li id="li_2">
                    <span>가입날짜</span>
                    <span></span>
                </li>
            </ul>
            <a class="btn_default btn_white btn_line_dark btn_find_pw">비밀번호 찾기</a>
        </div>
    </div>
</div>
<div id="forgat_pw" class="forgat animate-3">
    <div class="search_content_wrapper">
        <p class="header">비밀번호 찾기</p>
        <p>등록한 정보로 비밀번호를 찾을 수 있습니다.</p>
        <div class="forgat_input_div">
            <label>
                <span>아이디</span>
                <input type="text" id='pw_id'>
            </label>
            <label>
                <span>이름</span>
                <input type="text" id='pw_name'>
            </label>
            <div>
                <label>
                    <span>전화번호</span>
                    <input type="tel" id="pw_tel" class="tel" placeholder="'-'빼고 입력해주세요.">
                </label>
                <button type="button" class="forgat_btn" id="pw_btn" onclick="tel_send('pw_btn')">인증</button>
            </div>
            <div class="tel_check_box">
                <input type="hidden" id="pw_tel_check" class="tel_check" value="213">
                <label>
                    <span>인증번호</span>
                    <input type="tel" id="pw_num" class="num">
                </label>
                <button type="button" class="forgat_btn check_num" onclick="check_num('pw_btn');">확인</button>
            </div>
        </div>
        <button id="change_pw_btn" type="button" class="btn_default forgat_btn_radius btn_dark btn_circle btn_long animate-3"
        onclick="check_user()">비밀번호 변경하기
    </button>
    <div class="change_pw_div">
        <form>
            <p class="header">변경할 비밀번호를 입력해주세요.</p>
            <div>
                <input type="hidden" id="idx" value="">
                <label>
                    <span>새 비밀번호</span>
                    <input type="password" onkeydown="pw_check()" id="pw" minlength="6"
                    autocomplete="off">
                </label>
                <label>
                    <span>비밀번호 확인</span>
                    <input type="password" onkeydown="pw_check()" id="pw_confirm" minlength="6"
                    autocomplete="off">
                </label>
            </div>
            <button type="button" class="forgat_btn" onclick="change_pw()">변경하기</button>
        </form>
    </div>
</div>
</div>

<script type="text/javascript">
    (function () {

        /* 아이디 찾기 */
        $('#btn_forgat_id').click(function () {
            $('#forgat_id').css('opacity', '1');
            $('#forgat_id').css('height', '100%');
            $('#forgat_id').find('.search_content_wrapper').css('height', '570px');
        });

        /* 비밀번호 찾기 */
        $('#btn_forgat_pw').click(function () {
            $('#forgat_pw').css('opacity', '1');
            $('#forgat_pw').css('height', '100%');
            $('#forgat_pw').find('.search_content_wrapper').css('height', '570px');
        });

        /* 아이디 찾기 후 비밀번호 찾기 */
        $('.btn_find_pw').click(function(){
            $('.tel_check_box').css('display','block')
            $('#forgat_id').css('opacity', '0');
            $('#forgat_id').css('height', '0');
            $('#forgat_id').find('.search_content_wrapper').css('height', '0');

            $('#forgat_pw').css('opacity', '1');
            $('#forgat_pw').css('height', '100%');
            $('#forgat_pw').find('.search_content_wrapper').css('height', '570px');
        });

    })(jQuery);

    //인증번호 전송
    function tel_send(id) {
        var phone;

        if (id == 'id_btn') {
            phone = $("#id_tel").val();
        } else {
            phone = $("#pw_tel").val();
        }

        if (phone == "") {
            alert("정확한 핸드폰 번호를 입력하세요.");
            return;
        }

        $.ajax({
            type: "POST",
            dataType: "text",
            url: "<?= base_url('curl')?>",
            data: {hp: phone},
            success: function (data) {
                if (data != false) {
                    alert("인증번호를 전송했습니다.");
                }
            },
            error: function (data, status, error) {
                alert("문제가 발생했습니다." + data + "다음" + status + "다음" + error);
            }
        });
    }

    //인증번호 확인
    function check_num(id) {
        var phone;
        var num;

        if (id == 'id_btn') {
            phone = $("#id_tel").val();
            num = $("#id_num").val();
        } else {
            phone = $("#pw_tel").val();
            num = $("#pw_num").val();
        }

        if (num == "") {
            alert("인증번호를 입력해주세요");
            return;
        }

        $.ajax({
            type: "POST",
            dataType: "text",
            url: "<?= base_url('curl')?>",
            data: {
                hp: phone,
                num: num
            },
            success: function (data) {
                if (data != false) { //수정 필요할 듯.
                    if (data == 200) {
                        alert("인증이 성공했습니다.");
                        $(".tel_check_box").hide();
                        $("#get_id_btn").removeClass('disabled');
                        $("#change_pw_btn").show();
                        $(".tel_check").val(num);
                    } else if (data == 400) {
                        alert("인증이 실패했습니다.");
                    } else {
                        alert("인증이 실패했습니다.");
                    }
                } else {
                    alert("문제가 발생했습니다.");
                }
            }
        });
    }

    function get_id() {
        var name = $("#name").val();
        var tel = $("#id_tel").val();
        var id_tel_check = $("#id_tel_check").val();

        if (name == "" || tel == "" || id_tel_check == "") {
            alert("다시 입력해주세요.");
            return;
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?= base_url('forgat/forgat_id')?>",
            data: {name: name, tel: tel, id_tel_check: id_tel_check},
            success: function (data) {
                //alert(data);
                if (data != false) {
                    var target = $('.result_div');
                    target.find('p.header').find('span').text(name + '/' + phone_format(tel));

                    $("#li_1").find('span:nth-child(2)').text(data['id']);
                    $("#li_2").find('span:nth-child(2)').text(data['date']);

                    target.slideDown();
                } else {
                    alert('일치하는 회원정보가 없습니다.');
                }
            },
            error: function (request, status, error) {
                alert("code:" + request.status + "\n message:" + request.responseText + "\n error" + error);
            }
        });
    }

    function check_user() {
        var id = $("#pw_id").val();
        var name = $("#pw_name").val();
        var tel = $("#pw_tel").val();
        var tel_check = $("#pw_tel_check").val();

        if (id == "" || name == "" || tel == "" || tel_check == "") {
            alert("다시 입력해주세요.");
            return;
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?= base_url('forgat/check_id')?>",
            data: {id: id, name: name, tel: tel, tel_check: tel_check},
            success: function (data) {
                if (data != false) {
                    $("#idx").val(data['idx']);
                    $(".change_pw_div").show();
                } else {
                    alert('일치하는 회원이 없습니다.');
                    window.location.reload();
                }
            },
            error: function (request, status, error) {
                alert("code:" + request.status + "\n message:" + request.responseText + "\n error" + error);
            }
        });
    }

    function change_pw() {
        var idx = $("#idx").val();
        var pw = $("#pw").val();
        var pw_confirm = $("#pw_confirm").val();

        if (pw == "" || pw_confirm == "" || idx == "") {
            alert('다시 입력해주세요.');
            return;
        }

        $.ajax({
            type: "POST",
            dataType: "text",
            url: "<?= base_url('forgat/change_pw')?>",
            data: {idx: idx, pw: pw, pw_confirm: pw_confirm},
            success: function (data) {
                if (data == 1) {
                    alert('비밀번호가 변경되었습니다.');
                    window.location.reload();
                } else {
                    alert('비밀번호 변경에 실패하였습니다.');
                    window.location.reload();
                }
            },
            error: function (request, status, error) {
                alert("code:" + request.status + "\n message:" + request.responseText + "\n error" + error);
            }
        });
    }

    // 비밀번호 일치 여부 체크
    function pw_check() {
        var pw = $("#pw").val();
        var pw_confirm = $("#pw_confirm").val();

        if (pw.length < 5 || pw_confirm < 5) {
            $("#pw_confirm_text").empty().append("<span display='inline-block'>6자 이상입력해주세요.</span>");
        } else if (pw == pw_confirm) {
            $("#pw_confirm_text").empty().append("<span display='inline-block'>비밀번호가 일치합니다.</span>");
        } else if (pw != pw_confirm) {
            $("#pw_confirm_text").empty().append("<span display='inline-block'>비밀번호가 일치하지 않습니다.</span>");
        }
    }

    $("#pw").focusout(function () {
        pw_check();
    })

    $("#pw_confirm").focusout(function () {
        pw_check();
    });
</script>
