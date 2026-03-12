<section class="card auth-card">
    <h2>Create Account</h2>
    <form method="POST" action="/?page=register_submit">
        <label>Full Name</label>
        <input type="text" name="full_name" required>
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Password</label>
        <input type="password" name="password" minlength="6" required>
        <button type="submit">Register</button>
    </form>
</section>
