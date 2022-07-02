<div class="form-row">
  <div class="form-group col-md-6">
    <label>Fullname</label>
    <input type="text" name="name" class="form-control form-control-sm" value="{{ isset($user->name) ? $user->name : '' }}" />
  </div>
  <div class="form-group col-md-6">
    <label>Email</label>
    <input type="email" name="email" class="form-control form-control-sm" value="{{ isset($user->email) ? $user->email : '' }}" />
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label>Password</label>
    <input type="password" name="password" class="form-control form-control-sm" />
  </div>
  <div class="form-group col-md-6">
    <label>Retype Password</label>
    <input type="password" name="password_confirmation" class="form-control form-control-sm" />
  </div>
</div>
<div class="form-group">
  <div class="text-center">
    <button type="submit" class="btn btn-primary btn-md">Save Changes</button>
  </div>
</div>