<div class="row<?=key_exists('required', $rules) ? ' checked' : NULL?>">
    <div class="col-xs-6">
        <?=  create_checkbox('required', $rules)?>
        <strong>Required</strong>
    </div>
</div>
<div class="row<?=key_exists('maxlength', $rules) ? ' checked' : NULL?>">
    <div class="col-xs-6">
        <?=  create_checkbox('maxlength', $rules)?>
        <strong>Max length:</strong>
    </div>
    <div class="col-xs-6">
        <?=  create_input('maxlength', $rules, 'number')?>
    </div>
</div>    
<div class="row<?=key_exists('regexp', $rules) ? ' checked' : NULL?>">
    <div class="col-xs-6">
        <?=  create_checkbox('regexp', $rules)?>
        <strong>RegExp:</strong>
    </div>
    <div class="col-xs-6">
        <?=  create_input('regexp', $rules)?>
    </div>
</div>  
<div class="row<?=key_exists('max', $rules) ? ' checked' : NULL?>">
    <div class="col-xs-6">
        <?=  create_checkbox('max', $rules)?>
        <strong>Max:</strong>
    </div>
    <div class="col-xs-6">
        <?=  create_input('max', $rules, 'number')?>
    </div>
</div>   
<div class="row<?=key_exists('min', $rules) ? ' checked' : NULL?>">
    <div class="col-xs-6">
        <?=  create_checkbox('min', $rules)?>
        <strong>Min:</strong>
    </div>
    <div class="col-xs-6">
        <?=  create_input('min', $rules, 'number')?>
    </div>
</div>  

<?php 
    function create_checkbox($name, $rules){
        return Form::checkbox($name, NULL, key_exists($name, $rules), array('class' => 'rule-check')) . ' &nbsp;&nbsp';
    }
    
    function create_input($name, $rules, $type = 'text'){
        $value = key_exists($name, $rules) ? $rules[$name] : NULL;
        $attr = array(
            'class' => 'form-control input-sm rule-value',
            'type' => $type
        );
        
        if(!key_exists($name, $rules)){
            $attr['disabled'] = 'disabled';
        }
        
        return Form::input($name.'_value', $value, $attr);
    }
?>