<div class="show">
    <?php $note = $params['note'] ?? null; ?>
    <?php if ($note) : ?>
        <ul>
            <li> ID: <?php echo (int)$note['id'] ?> </li>
            <li> Tytuł: <?php echo htmlentities($note['title']) ?> </li>
            <li> Opis: <?php echo htmlentities($note['description']) ?> </li>
            <li> Utworzono: <?php echo htmlentities($note['created']) ?> </li>
            <li> <a href="<?php echo $params['BASE_URL'] ?>">Powrót do listy</a> </li>
            <li> <a href="<?php echo $params['BASE_URL'] ?>?action=edit&id=<?php echo $note['id'] ?>"> <button>Edytuj</button> </a>
        </ul>
    <?php else : ?>
        <div>Brak notatki do wyświetlenia</div>
    <?php endif; ?>
</div>