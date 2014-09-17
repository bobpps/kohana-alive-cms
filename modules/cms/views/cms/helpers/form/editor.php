<div class="input-display">
    <a href="#" title="Редактировать"><?=$value?></a>
</div>
<div class="input-editor">
    <div class="input-group">
        <?=Form::input($name, $value, $attributes)?>
        <span class="input-group-btn">
            <button title="Применить" class="btn btn-default btn-sm ok-button" type="button" style="vertical-align: top;">
                <span class="glyphicon glyphicon-ok-sign"></span>
            </button>
            <button title="Отменить" class="btn btn-default btn-sm cancel-button" type="button" style="vertical-align: top;">
                <span class="glyphicon glyphicon-remove-sign"></span>
            </button>
        </span>          
    </div>    
</div>