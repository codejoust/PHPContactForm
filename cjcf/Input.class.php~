<?php

class Input{

private $label;
public $html;
public $name;
public $required;
public $result;
public $val;
private $errorLabel;
public $err;

function __construct($name,$label,$errorLabel,$type = 'text', $required = false){
    $this->label = $label;
    $this->name = $name;
    $this->required = $required;
    if (!$errorLabel){ $errorLabel = $GLOBALS['opts["error"]']; }
    $this->errorLabel = $errorLabel;
    $this->type = $type;
}
function buildHTML(){
    if (!in_array($this->type, array('text','radio','checkbox'))) { $type = 'text'; } else { $type = $this->type; } 
    if ($this->err){
        $error = " <span class='error'>{$this->errorLabel}</span>";
    } else { $error = '';}
    if ($this->required){ $req = 'required'; } else {$req = '';}
    
    if ($this->type == 'textarea' || $this->type == 'address'){
    $input = "<span class='space'></span><textarea name='{$this->name}' id='{$this->name}' class='{$this->type} {$this->name} $req' rows='5' cols='30'>{$this->val}</textarea>";
    }
    else{
    $input = "<input type='{$this->type}' value='{$this->val}' class='{$this->type} {$this->name} $req' name='{$this->name}' id='{$this->name}' />";
    }
    
        return $this->html = "<li><label class='{$this->err}' for='{$this->name}'>{$this->label}$error</label>$input</li>\n";
}
function getResult(){
    return $this->result = "<li><strong class='{$this->name} {$this->type} {$this->required}'>{$this->label}</strong> : <span class='text'>{$this->val}</span></li>\n";
}
function getVal(){
$this->val = getVar($this->name);

    if ($this->required == true){
        if ($this->type == 'email'){
           if (!filter_var($this->val,FILTER_VALIDATE_EMAIL)) { $this->addErr(); }
        }
        else if (!($this->val)) { $this->addErr(); }
   }
}

function addErr(){
    $this->err = true;
    getOption('submit','no sir.');
}

}
