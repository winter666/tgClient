<form id="form" method="POST" action="/login">
    @csrf
    <div class="form-group">
        <label for="email">E-mail</label>
        <input id="email" type="email" class="form-control" name="email"/>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input id="password" type="password" class="form-control" name="password"/>
    </div>
</form>
