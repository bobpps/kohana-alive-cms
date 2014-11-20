<?php foreach ($rules as $rule_name => $value) : ?>

    <?php if($rule_name == 'required') : ?>
        <button class="btn btn-default btn-sm validation-rules" type="button" title="Required">R</button>
    <?php endif; ?>

    <?php if($rule_name == 'maxlength') : ?>
        <button class="btn btn-default btn-sm validation-rules" type="button" data-value="<?=$value?>" title="Max length: <?=$value?>">ML</button>
    <?php endif; ?>

    <?php if($rule_name == 'regexp') : ?>
        <button class="btn btn-default btn-sm validation-rules" type="button" data-value="<?=$value?>" title="RegEx (pattern): <?=$value?>">RE</button>
    <?php endif; ?>

    <?php if($rule_name == 'min') : ?>
        <button class="btn btn-default btn-sm validation-rules" type="button" data-value="<?=$value?>" title="Min: <?=$value?>">Min</button>
    <?php endif; ?>

    <?php if($rule_name == 'max') : ?>
        <button class="btn btn-default btn-sm validation-rules" type="button" data-value="<?=$value?>" title="Max: <?=$value?>">Max</button>
    <?php endif; ?>

<?php endforeach; ?>

<!--<button class="btn btn-default btn-sm validation-rules" type="button" title="Required">R</button>
<button class="btn btn-default btn-sm validation-rules" type="button" data-value="255" title="Max length: 255">ML</button>
<button class="btn btn-default btn-sm validation-rules" type="button" data-value="\d [0-9]" title="RegEx (pattern): \d [0-9]">RE</button>-->