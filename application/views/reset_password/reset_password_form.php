<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <h4 class="text-center mb-4">Ganti Password</h4>
                    
                    <!-- Password Update Form -->
                    <form method="post" action="<?= base_url('user/user/update_password') ?>">
                        <input type="hidden" name="token" value="<?= $token ?>">

                        <div class="form-group">
                            <label for="new_password">Password Baru:</label>
                            <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Masukkan password baru" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Ganti Password</button>
                    </form>
                    
                    <!-- Back to Login Link -->
                    <div class="text-center mt-3">
                        <a href="<?= base_url('auth/login'); ?>" class="small">Kembali ke Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
