<p>Form submitted with SUCCESS!</p>
<ul>
    <li>First Name: <?= $firstname ?></li>
    <li>Last Name: <?= $lastname ?></li>
    <li>Username: <?= $username ?></li>
    <li>Email: <?= $email ?></li>
    <li>Password: <?= $password ?></li>
</ul>
<p><?php echo anchor('register', 'Try it again!'); ?></p>