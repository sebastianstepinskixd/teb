<h3>Edycja notatki</h3>
<div>
    <form action="<?php echo $params['BASE_URL'] ?>?action=edit" class="note-form" method="POST">
        <ul>
            <li>
                <label for="title">Tytuł <span class="required">*</span></label>
                <input type="text" name="title" id="title" class="filed-long">
            </li>
            <li>
                <label for="field5">Treść</label>
                <textarea name="description" id="field5", class="field-long field-textarea"></textarea>
            </li>
            <li>
                <input type="submit" value="Zapisz">
            </li>
        </ul>
    </form>
</div>