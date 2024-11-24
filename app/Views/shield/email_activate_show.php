<?= $this->extend('shield/app') ?>

<?= $this->section('title') ?><?= lang('Auth.emailActivateTitle') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="col-md-7">
    <div class="mb-4">
        <h3><?= lang('Auth.emailActivateTitle') ?></h3>
        <p class="mb-4"><?= lang('Auth.emailActivateBody') ?></p>
    </div>

    <?php if (session('error')) : ?>
        <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif ?>

    <form action="<?= url_to('auth-action-verify') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="tokenInput"><?= lang('Auth.token') ?></label>
            <input type="text" class="form-control" id="tokenInput" name="token" inputmode="numeric"
                pattern="[0-9]*" autocomplete="one-time-code" value="<?= old('token') ?>" required>
        </div>

        <input type="submit" value="<?= lang('Auth.send') ?>" class="btn btn-block btn-primary">
    </form>
</div>

<?= $this->endSection() ?>