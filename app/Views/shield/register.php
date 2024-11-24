<?= $this->extend('shield/app') ?>

<?= $this->section('title') ?><?= lang('Auth.register') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="col-md-7">
    <div class="mb-4">
        <h3>Register</h3>
        <p class="mb-4">Register your account here to use Megavision Sales App.</p>
    </div>

    <?php if (session('error') !== null) : ?>
        <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
    <?php elseif (session('errors') !== null) : ?>
        <div class="alert alert-danger" role="alert">
            <?php if (is_array(session('errors'))) : ?>
                <?php foreach (session('errors') as $error) : ?>
                    <?= $error ?>
                    <br>
                <?php endforeach ?>
            <?php else : ?>
                <?= session('errors') ?>
            <?php endif ?>
        </div>
    <?php endif ?>

    <form action="<?= url_to('register') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group first">
            <label for="emailInput">Email</label>
            <input type="email" class="form-control" id="emailInput" name="email" inputmode="email" autocomplete="email" value="<?= old('email') ?>" required>
        </div>
        <div class="form-group second">
            <label for="usernameInput">Username</label>
            <input type="text" class="form-control" id="usernameInput" name="username" inputmode="text" autocomplete="username" value="<?= old('username') ?>" required>
        </div>
        <div class="form-group third">
            <label for="passwordInput">Password</label>
            <input type="password" class="form-control" id="passwordInput" name="password" inputmode="text" autocomplete="new-password" required>
        </div>
        <div class="form-group last mb-3">
            <label for="passwordConfirmInput">Confirm Password</label>
            <input type="password" class="form-control" id="passwordConfirmInput" name="password_confirm" inputmode="text" autocomplete="new-password" required>
        </div>

        <input type="submit" value="<?= lang('Auth.register') ?>" class="btn btn-block btn-primary">

        <span class="d-block text-center my-4 text-muted">&mdash; or &mdash;</span>

        <p class="text-center"><?= lang('Auth.haveAccount') ?> <a href="<?= url_to('login') ?>"><?= lang('Auth.login') ?></a></p>
    </form>
</div>

<?= $this->endSection() ?>