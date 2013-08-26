<div class="checkout grid_16">
  <div class="newAccount grid_8 alpha" >
    <h4>{{ l('Create New Account') }}</h4>
    <form method="post" action="register">
      <fieldset>
        <? if(Session::get('lan') == "ar")$a_style = ' style="float:right;"';
           else $a_style = ''; ?>
        <div class="errors"><? echo implode("<br />" ,$errors->all()) ?></div>
        <label{{ $a_style }} for="firstName">{{ l('First Name') }}: </label>
        <input type="text" tabindex="1" size="30" value="" id="firstName" name="first_name" class="text" />
        <br />
        <label{{ $a_style }} for="lastName">{{ l('Last Name') }}: </label>
        <input type="text" tabindex="2" size="30" value="" id="lastName" name="last_name" class="text" />
        <br />
        <label{{ $a_style }} for="email">{{ l('Email') }}:</label>
        <input type="text" tabindex="3" size="30" value="" id="email" name="email" class="text" />
        <br />
        <label{{ $a_style }} for="password">{{ l('Password') }}:</label>
        <input type="password" tabindex="4" size="30" value="" id="password" name="password" class="text" />
        <br />
        <label{{ $a_style }} for="repassword">{{ l('Retype Password') }}:</label>
        <input type="password" tabindex="5" size="30" value="" id="repassword" name="re_password" class="text" />
        <br />
        <input type="checkbox" tabindex="6" style="margin-top:10px; position:relative; top:2px;" name="remember" value="true" />
        &nbsp {{ l('Remeber me on this computer') }}
        <div class="clear"></div>
      </fieldset>
      <p>
        <input type="submit" value="Create New Account" name="update" class="newAccountButton" />
      </p>
      <input type="hidden" value="30" />
    </form>
  </div>
  <div class="loginPage grid_8 omega">
    <h4>{{ l('Login') }}</h4>
    <form method="post" action="">
      <fieldset>
        <div class="errors"><? if(isset($login_errors))echo $login_errors; ?></div>
        <label{{ $a_style }}{{ $a_style }} for="email2">{{ l('Email') }}:</label>
        <input type="text" tabindex="7" size="30" value="" id="email2" name="email" class="text" />
        <br />
        <label{{ $a_style }} for="password2">{{ l('Password') }}:</label>
        <input type="password" tabindex="8" size="30" value="" id="password2" name="password" class="text" />
        <br />
        <input type="checkbox" tabindex="9" style="margin-top:10px; position:relative; top:2px;" name="remember" value="true" />
        &nbsp {{ l('Remeber me on this computer') }}
        <div class="clear"></div>
      </fieldset>
      <p>
        <input type="submit" value="Login" name="update" class="userLogin" />
      </p>
      <input type="hidden" value="30" />
    </form>
  </div>
</div>