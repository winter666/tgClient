<form id="form" method="POST" action="/register">
    @csrf
    <div class="form-group">
        <label for="name">Your Name<sup>*</sup></label>
        <input id="name" type="text" class="form-control" name="name"/>
        <span class="text-danger"></span>
    </div>
    <div class="form-group">
        <label for="email">E-mail<sup>*</sup></label>
        <input id="email" type="email" class="form-control" name="email"/>
        <span class="text-danger"></span>
    </div>
    <div class="form-group">
        <label for="password">Password<sup>*</sup></label>
        <input id="password" type="password" class="form-control" name="password"/>
        <span class="text-danger"></span>
    </div>
    <div class="form-group">
        <label for="password_confirmation">Password Confirm<sup>*</sup></label>
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"/>
        <span class="text-danger"></span>
    </div>
</form>
