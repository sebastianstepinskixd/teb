<div class="delete">
    <?php if(!empty($params['note'])) : ?>
            <ul>
                <li>
                    Tytuł: <?php echo htmlentities($params['note']['title']) ?>
                </li>
                <li>
                    Treść: <?php echo htmlentities($params['note']['description']) ?></textarea>
                </li>
                <li>
                    Utworzono: <?php echo htmlentities($params['note']['created']) ?></textarea>
                </li>
                <li>
                    <a href="<?php echo $params['BASE_URL'] ?>">Powrót do listy notatek</a>
                </li>
                <li>
                <form action="<?php echo $params['BASE_URL'] ?>?action=delete" class="note-form" method="POST">
                    <input type="text" name="id" id="id" value="<?php echo $params['note']['id'] ?>" hidden>
                    <input type="submit" value="Usuń">
                </form>
                </li>
            </ul>
    <?php else : ?>
        <div>
            Brak danych do wyświetlenia 
            <a href="<?php echo $params['BASE_URL'] ?>">Powrót do listy notatek</a>
        </div>
    <?php endif; ?>
</div>