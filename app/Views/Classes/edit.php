<?php
echo <<<HTML
<form method='post' action='/classes'>
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="id" value="{$class->id}">
    <fieldset>
    <label for="class_name">Osztály</label>
    <input type="text" name="class_name" id="name" value="{$class->class_name}"><br>
    <label for="year">Év</label>
    <input type="text" name="year" id="name" value="{$class->year}">
    <br>
    <button type="submit" name="btn-update" class="btn-save"><i class="fa fa-save"></i>&nbsp;Mentés</button>
</fieldset>
</form>
<form method='post' action='/classes'>
<input type="hidden" name="_method" value="GET">
<button type="submit" name="btn-cancel" class="btn-cancel"><i class="fa fa-undo"></i>&nbsp;Vissza</button>
</form>
HTML;
