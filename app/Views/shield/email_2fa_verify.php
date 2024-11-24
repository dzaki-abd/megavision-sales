<?= $this->extend('shield/app') ?>

<?= $this->section('title') ?><?= lang('Auth.email2FATitle') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="col-md-7">
    <div class="mb-4">
        <h3><?= lang('Auth.emailEnterCode') ?></h3>
        <p class="mb-4"><?= lang('Auth.emailConfirmCode') ?></p>
    </div>

    <?php if (session('error')) : ?>
        <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif ?>

    <form action="<?= url_to('auth-action-verify') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="codeInput">Code</label>
            <input type="number" class="form-control" name="token" id="codeInput"
                inputmode="numeric" pattern="[0-9]*" autocomplete="one-time-code" required>
        </div>

        <input type="submit" value="<?= lang('Auth.confirm') ?>" class="btn btn-block btn-primary">
    </form>
</div>

<?= $this->endSection() ?>