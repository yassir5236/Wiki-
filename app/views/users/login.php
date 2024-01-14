<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="flex justify-center items-center h-screen rounded-lg bg-gray-200">
    <div class="w-full md:w-2/3 lg:w-1/2 xl:w-1/3 bg-white shadow-md rounded p-8">
      <div class="mb-6">
        <?php flash('register_success'); ?>
        <h2 class="text-3xl font-semibold mb-4 text-center">Login</h2>
        <p class="text-gray-600 text-center">Please fill in your credentials to log in</p>
      </div>
      <form action="<?php echo URLROOT; ?>/users/login" method="post">
        <div class="mb-4">
          <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email: <sup>*</sup></label>
          <input type="email" name="email" class="form-input w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-green-500" value="<?php echo $data['email']; ?>">
          <span class="text-black text-sm"><?php echo $data['email_err']; ?></span>
        </div>
        <div class="mb-4">
          <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password: <sup>*</sup></label>
          <input type="password" name="password" class="form-input w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-green-500" value="<?php echo $data['password']; ?>">
          <span class="text-black text-sm"><?php echo $data['password_err']; ?></span>
        </div>
        <div class="flex items-center justify-between">
          <button type="submit" class="bg-black text-white px-8 py-3 rounded hover:bg-red-600 focus:outline-none">Login</button>
          <a href="<?php echo URLROOT; ?>/users/register" class="text-gray-500">No account? Register</a>
        </div>
      </form>
    </div>
  </div>



  <script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('form').addEventListener('submit', function (e) {
      // Validation de l'email
      let emailInput = document.querySelector('[name="email"]');
      let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailInput.value.trim() || !emailRegex.test(emailInput.value.trim())) {
        alert('Veuillez entrer une adresse e-mail valide');
        e.preventDefault();
        return;
      }

      // Validation du mot de passe
      let passwordInput = document.querySelector('[name="password"]');
      if (!passwordInput.value.trim()) {
        alert('Veuillez entrer votre mot de passe');
        e.preventDefault();
        return;
      }
    });
  });
</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>
