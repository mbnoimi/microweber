<?php

/*

type: layout

name: Default

description: Default register template

*/

?>
<?php if (is_logged() == false): ?>
    <script type="text/javascript">
        mw.moduleCSS("<?php print modules_url(); ?>users/users_modules.css");
        mw.require('forms.js', true);
        mw.require('url.js', true);
        $(document).ready(function () {
            mw.$('#user_registration_form_holder').submit(function () {
                mw.form.post(mw.$('#user_registration_form_holder'), '<?php print site_url('api') ?>/user_register', function () {
                    mw.response('#register_form_holder', this);
                    if (this.success) {
                        mw.reload_module('users/register');
                        window.location.href = window.location.href;
                    }
                });
                return false;
            });
        });
    </script>

<div class="card mt-5">
    <div id="register_form_holder" class="card-body">
        <h5><?php _e("Register new account"); ?></h5>

        <br />
        <form class="p-t-10" action="#" id="user_registration_form_holder" method="post">
            <?php print csrf_form(); ?>
            <?php if ($form_show_first_name): ?>
                <div class="form-group">
                    <input class="form-control input-lg" type="text" name="first_name" placeholder="<?php _e('First Name'); ?>">
                </div>
            <?php endif; ?>

            <?php if ($form_show_last_name): ?>
                <div class="form-group">
                    <input class="form-control input-lg" type="text" name="last_name" placeholder="<?php _e('Last Name'); ?>">
                </div>
            <?php endif; ?>

            <div class="form-group">
                <input class="form-control input-lg" type="email" name="email" placeholder="E-mail">
            </div>

            <div class="form-group m-t-20">
                <input class="form-control input-lg" type="password" name="password" placeholder="Password">
            </div>

            <?php if ($form_show_password_confirmation): ?>
                <div class="form-group m-t-20">
                    <input class="form-control input-lg" type="password" name="password2" placeholder="<?php _e("Confirm Password"); ?>">
                </div>
            <?php endif; ?>

            <?php if (!$captcha_disabled): ?>
                <module type="captcha" template="skin-1"/>
            <?php endif; ?>


            <div class="row">
                <div class="col-12">
                    <p class="personal-data">Your personal data will be used to support your expirience
                        throughout this website, to manage access to your account
                        and for other purposes described in our <a href="#">privacy policy</a>.</p>
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-lg btn-block m-t-30 m-b-20"><?php print $form_btn_title ?></button>

            <div class="text-center">
            <b> <?php _e("OR"); ?></b>
                <br />
                <br />
            <a class="btn btn-default m-t-3 m-b-20" href="<?php echo route('checkout.login'); ?>">
              <i class="mdi mdi-key"></i>  <?php _e("Already have account? Login"); ?>
            </a>
            </div>

        </form>
    </div>
    </div>
<?php else: ?>
    <p class="text-center">
        You Are Logged In
    </p>
<?php endif; ?>
<br/>