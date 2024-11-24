<?= $this->extend('shield/app') ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="col-md-7">
    <div class="mb-4">
        <h3>Login</h3>
        <p class="mb-4">Welcome to Megavision Sales App.</p>
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

    <?php if (session('message') !== null) : ?>
        <div class="alert alert-success" role="alert"><?= session('message') ?></div>
    <?php endif ?>

    <form action="<?= url_to('login') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group first">
            <label for="emailInput">Email</label>
            <input type="email" class="form-control" id="emailInput" name="email" inputmode="email" autocomplete="email" value="<?= old('email') ?>" required>
        </div>
        <div class="form-group last mb-3">
            <label for="passwordInput">Password</label>
            <input type="password" class="form-control" id="passwordInput" name="password" inputmode="text" autocomplete="current-password" required>
        </div>

        <div class="d-flex mb-5 align-items-center">
            <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                    <input type="checkbox" name="remember" <?php if (old('remember')): ?> checked<?php endif ?> />
                    <div class="control__indicator"></div>
                </label>
            <?php endif; ?>
        </div>

        <input type="submit" value="<?= lang('Auth.login') ?>" class="btn btn-block btn-primary">

        <span class="d-block text-center my-4 text-muted">&mdash; or &mdash;</span>

        <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
            <p class="text-center"><?= lang('Auth.forgotPassword') ?> <a href="<?= url_to('magic-link') ?>"><?= lang('Auth.useMagicLink') ?></a></p>
        <?php endif ?>

        <?php if (setting('Auth.allowRegistration')) : ?>
            <p class="text-center"><?= lang('Auth.needAccount') ?> <a href="<?= url_to('register') ?>"><?= lang('Auth.register') ?></a></p>
        <?php endif ?>
    </form>
</div>

<?= $this->endSection() ?>