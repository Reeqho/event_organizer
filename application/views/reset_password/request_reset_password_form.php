<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Ganti Password</h2>
    <form method="post" action="<?= base_url('user/user/request_reset_password') ?>">
        <div class="form-group">
            <label for="email">Alamat Email:</label>
            <input type="email" class="form-control" name="email" required placeholder="Masukkan email Anda">
        </div>
        <button type="submit" class="btn btn-primary">Kirim Link Reset Password</button>
    </form>
</div>
</body>
</html>
