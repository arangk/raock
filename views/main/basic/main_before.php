<link rel="stylesheet" type="text/css" href="<?php echo element('view_skin_url', $layout); ?>/css/main.css"/>

<div class="content section1" id="home">
    <div class="profile">
        <span></span>
        <span>
            <img src="<?= base_url('assets/images/profile/profile.jpg') ?>"/>
        </span>
        <p>WEB DEVELOPER</p>
        <p>ARANG KIM</p>
    </div>
    <div class="tech">
        <ul>
            <li><span><img src="<?= base_url('assets/images/profile/home_icon_01.png') ?>"/></span></li>
            <li><span><img src="<?= base_url('assets/images/profile/home_icon_02.png') ?>"/></span></li>
            <li><span><img src="<?= base_url('assets/images/profile/home_icon_03.png') ?>"/></span></li>
            <li><span><img src="<?= base_url('assets/images/profile/home_icon_04.png') ?>"/></span></li>
        </ul>
    </div>
</div>
<div class="content section2" id="about">
    <div class="left">
        <p>About</p>
        <ul>
            <li>
                <span>ARANG KIM(Cheongju-si, Chungbuk, Republic of Korea)</span>
            </li>
            <li>
                <span>E-mail</span>
                <span>amitoa@naver.com</span>
            </li>
            <li>
                <span>Skill</span>
                <span>PHP(Framework-CI) / MySQL / Node.js / jQuery / Javascript / HTML&CSS</span>
            </li>
            <li>
                <span>Qualification</span>
                <span>정보처리기사(Engineer Information Processing)</span>
            </li>
        </ul>
    </div>
    <div class="right">
        <p>Education & History</p>
        <ul>
            <li>
                <span>2019.04 ~ 재직중</span>
                <span>스마트아이오티(충북 청주)</span>
                <span>개발팀/대리</span>
            </li>
            <li>
                <span>2015.12 ~ 2018.02</span>
                <span>블루소프트(충북 청주)</span>
                <span>개발팀/사원</span>
            </li>
            <li>
                <span>2011.03 ~ 2016.02</span>
                <span>한국교통대학교 졸업</span>
                <span>소프트웨어학 학사(3.5/4.5)</span>
            </li>
            <li>
                <span>2008.03 ~ 2001.02</span>
                <span>충북청원고등학교 졸업</span>
                <span>문과</span>
            </li>
        </ul>
    </div>
</div>

<!-- 포트폴리오 -->
<div class="content section3" id="portfolio">
    <pre><?= var_dump($portfolio) ?></pre>
</div>
<!-- 포트폴리오 -->

<div class="content section4" id="contact">
    <div>

    </div>
    <div class="footer">
        <p>ⓒ 2020. 아랑 all rights reserved. </p>
    </div>
</div>