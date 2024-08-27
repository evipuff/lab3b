<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <!-- Add the Bulma CSS here -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>
<body>
<section class="section">
    <h1 class="title">User Registration</h1>
    <h2 class="subtitle">
        This is the IPT10 PHP Quiz Web Application Laboratory Activity. Please register
    </h2>
    <!-- Supply the correct HTTP method and target form handler resource -->
    <form method="POST" action="instructions.php">
        <div class="field">
            <label class="label">Name</label>
            <div class="control">
                <input class="input" type="text" name="complete_name" placeholder="Complete Name">
            </div>
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" name="email" type="email" />
            </div>
        </div>

        <div class="field">
            <label class="label">Birthdate</label>
            <div class="control">
                <input class="input" name="birthdate" type="date" />
            </div>
        </div>

        <div class="field">
            <label class="label">Contact Number</label>
            <div class="control">
                <input class="input" name="contact_number" type="tel" />
            </div>
        </div>

        <!-- Next button -->
        <button id="nextButton" type="submit" class="button is-link" disabled>Next</button>
    </form>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const nameInput = document.querySelector('input[name="complete_name"]');
        const emailInput = document.querySelector('input[name="email"]');
        const nextButton = document.querySelector('button[type="submit"]');

        function validateForm() {
            const nameValid = nameInput.value.trim() !== '';
            const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value);
            nextButton.disabled = !(nameValid && emailValid);
        }

        nameInput.addEventListener('input', validateForm);
        emailInput.addEventListener('input', validateForm);
        validateForm();
    });
</script>

</body>
</html>
