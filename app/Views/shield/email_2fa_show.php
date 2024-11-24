<?= $this->extend('shield/app') ?>

<?= $this->section('title') ?><?= lang('Auth.email2FATitle') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="col-md-7">
    <div class="mb-4">
        <h3><?= lang('Auth.email2FATitle') ?></h3>
        <p class="mb-4"><?= lang('Auth.confirmEmailAddress') ?></p>
    </div>

    <?php if (session('error')) : ?>
        <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif ?>

    <form action="<?= url_to('auth-action-handle') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="emailInput"><?= lang('Auth.email') ?></label>
            <input type="email" class="form-control" name="email" id="emailInput"
                inputmode="email" autocomplete="email"
                <?php /** @var CodeIgniter\Shield\Entities\User $user */ ?>
                value="<?= old('email', $user->email) ?>" required>
        </div>

        <input type="submit" value="<?= lang('Auth.send') ?>" class="btn btn-block btn-primary">
    </form>
</div>

<?= $this->endSection() ?>