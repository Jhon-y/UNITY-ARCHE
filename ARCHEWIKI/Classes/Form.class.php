<?php


class Form{

    public static function montaSelect(array $elementos, $name="", $class="", $default="0"): String{
        $select = "<select name='$name' id='$name' class='$class'>";
        $select .= "<option value='0'>Selecione</option>";
        
        foreach ($elementos as $elemento){
            $select .= "<option value='{$elemento->getIdU()}'";
            $select .= $default == $elemento->getIdU()?" selected ":"";
            $select .= ">{$elemento->getNome()}</option>";
        }
        $select .= "</select>";
        return $select;
    }


}
