<div class="modal fade" id="modal-login" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Login to Proceed</h4>
      </div>
      <form role="form" method="POST" action="{{ url('customer/auth/login') }}">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="customer-email">Email address</label>
            <input type="email" name="email" class="form-control form-control-sm" id="customer-email" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label class="col-form-label col-form-label-sm" for="customer-password">Password</label>
            <input type="password" name="password" class="form-control form-control-sm" id="customer-password">
          </div>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <input type="hidden" name="cart" value="{{ $cartcount }}">
          <button class="btn btn-md btn-warning btn-block" type="submit">Sign in</button>
          <a href="{{ url('customer/auth/register') }}" class="btn btn-md btn-secondary btn-block">Don't have an Account? Register Now!</a>
        </div>    
      </form>
    </div>
  </div>
</div>