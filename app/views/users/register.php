<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="flex justify-center items-center rounded-lg h-screen bg-gray-200">
    <div class="w-full md:w-2/3 lg:w-1/2 xl:w-2/5 bg-white shadow-md rounded p-8">
      <h2 class="text-3xl font-semibold mb-4 text-center">Create An Account</h2>
      <p class="text-gray-600 text-center">Please fill out this form to register with us</p>
      <form action="<?php echo URLROOT; ?>/users/register" method="post">
        <div class="mb-4">
          <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name: <sup>*</sup></label>
          <input type="text" name="name" class="form-input w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-green-500" value="<?php echo $data['name']; ?>">
          <span class="text-Black text-sm"><?php echo $data['name_err']; ?></span>
        </div>
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
        <div class="mb-4">
          <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password: <sup>*</sup></label>
          <input type="password" name="confirm_password" class="form-input w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-green-500" value="<?php echo $data['confirm_password']; ?>">
          <span class="text-black text-sm"><?php echo $data['confirm_password_err']; ?></span>
        </div>
        <div class="flex items-center justify-between">
          <button type="submit" class="bg-black text-white px-8 py-3 rounded hover:bg-red-600 focus:outline-none">Register</button>
          <a href="<?php echo URLROOT; ?>/users/login" class="text-gray-500">Have an account? Login</a>
        </div>
      </form>
    </div>
  </div>

 



  
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
      let valid = true;

      // Name validation: only letters and spaces
      const nameInput = form.querySelector('[name="name"]');
      const nameRegex = /^[A-Za-z ]+$/;
      if (!nameRegex.test(nameInput.value)) {
        alert('Please enter a valid name (only letters and spaces allowed)');
        valid = false;
      }

      // Email validation
      const emailInput = form.querySelector('[name="email"]');
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(emailInput.value)) {
        alert('Please enter a valid email address');
        valid = false;
      }

      // Password validation: at least 8 characters
      const passwordInput = form.querySelector('[name="password"]');
      if (passwordInput.value.length < 8) {
        alert('Password must be at least 8 characters long');
        valid = false;
      }

      // Confirm Password validation: must match password
      const confirmPasswordInput = form.querySelector('[name="confirm_password"]');
      if (confirmPasswordInput.value !== passwordInput.value) {
        alert('Passwords do not match');
        valid = false;
      }

      // Prevent form submission if validation fails
      if (!valid) {
        event.preventDefault();
      }
    });
  });
</script>



<!-- ... Your PHP and HTML code ... -->

<?php require APPROOT . '/views/inc/footer.php'; ?>
