<h3>Edycja notatki</h3>
<div>
    <?php if(!empty($params['note'])) : ?>
        <form action="<?php echo $params['BASE_URL'] ?>?action=edit" class="note-form" method="POST">
            <input type="text" name="id" id="id" value="<?php echo $params['note']['id'] ?>">
            <ul>
                <li>
                    <label for="title">Tytuł <span class="required">*</span></label>
                    <input type="text" name="title" id="title" class="filed-long" value="<?php echo $params['note']['title'] ?>">
                </li>
                <li>
                    <label for="field5">Treść</label>
                    <textarea name="description" id="field5", class="field-long field-textarea"><?php echo $params['note']['description'] ?></textarea>
                </li>
                <li>
                    <input type="submit" value="Zapisz">
                </li>
            </ul>
        </form>
    <?php else : ?>
        <div>
            Brak danych do wyświetlenia 
            <a href="<?php echo $params['BASE_URL'] ?>">Powrót do listy notatek</a>
        </div>
    <?php endif; ?>
</div>