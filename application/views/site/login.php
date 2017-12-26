<div class="page-header">
    <h3>Login</h3>
    <p class="lead">Disable the responsiveness of Bootstrap by fixing the width of the container and using the first grid system tier. <a href="http://getbootstrap.com/getting-started/#disable-responsive">Read the documentation</a> for more information.</p>
</div>

<!-- 로그인 폼 -->
<div class="row" style="margin: 0;">
    <div class="col-xs-4" style="background-color: #ffffff; border: none;"></div>
    <div class="col-xs-4" style="background-color: #ffffff; border: none;">
        <form action="/doLogin" method="post">
            <div class="input-group">
                <span id="sizing-addon2" class="input-group-addon" style="width: 100px;">ID</span>
                <input class="form-control" type="text" name="memberId"  placeholder="MemberId" aria-describedby="sizing-addon2" style="width: 200px;">
            </div>
            <p></p>
            <div class="input-group">
                <span id="sizing-addon2" class="input-group-addon" style="width: 100px;">PW</span>
                <input class="form-control" type="password" name="password" placeholder="Password" aria-describedby="sizing-addon2" style="width: 200px;">
            </div>
            <p></p>
            <div><button type="submit" class="btn btn-default" style="width: 100%;">Login</button></div>
            <p></p>
            <div><a class="btn btn-default" href="/signUp/" style="width: 100%;">SignUp</a></div>
        </form>
    </div>
    <div class="col-xs-4" style="background-color: #ffffff; border: none;"></div>
</div>
<!-- /로그인 폼 -->