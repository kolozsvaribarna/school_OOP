<?php
echo <<<HTML
<form method='post' action='/subjects'>
    <fieldset>
    <label for="subject">Tantárgy</label>
    <input type="text" name="name" id="name" value="">
    <br>
    <button type="submit" name="btn-update" class="btn-save"><i class="fa fa-save"></i>&nbsp;Hozzáad</button>
</fieldset>
</form>
<form method='post' action='/subjects'>
<input type="hidden" name="_method" value="GET">
<button type="submit" name="btn-cancel" class="btn-cancel"><i class="fa fa-undo"></i>&nbsp;Vissza</button>
</form>
HTML;