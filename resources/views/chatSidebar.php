<ul id="user-list">
    <?php foreach ($_SESSION['allUsers'] as $user): ?>
        <li class="user-item"
            data-chat-id="<?= $this->getChatId($_SESSION['usuario']['id'], $user['id']) ?>"
            data-user-id="<?= $user['id'] ?>"
            data-user-name="<?= htmlspecialchars($user['nombre']) ?>">

            <img src="https://randomuser.me/api/portraits/<?= ($user['gender'] ?? 'male') === 'female' ? 'women' : 'men' ?>/<?= rand(1, 99) ?>.jpg" alt="">
            <span class="username"><?= htmlspecialchars($user['nombre']) ?></span>
            <span class="user-role">(<?= htmlspecialchars($user['rol'] ?? 'Rol no definido') ?>)</span>
            <span class="unread-count" id="unread-<?= $user['id'] ?>"></span>
        </li>
    <?php endforeach; ?>
</ul>