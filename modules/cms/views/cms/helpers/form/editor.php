<div class="input-display">
    <a href="#" title="Редактировать"><?=$value?></a>
</div>
<div class="input-editor">
    <?=Form::input($name, $value, $attributes)?>
    <a href="#" class="ok-button" title="Применить"><span style="color: green;" class="glyphicon glyphicon-ok-circle"></span></a>
    <a href="#" class="cancel-button" title="Отменить"><span style="color: red;" class="glyphicon glyphicon-remove-circle"></span></a>                        
</div>