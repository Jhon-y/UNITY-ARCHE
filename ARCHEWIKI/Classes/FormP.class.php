<?php
class FormP {
    public static function montaSelect(array $saves, $name = "", $class = "", $default = "0"): string {
        $select = "<select name='$name' id='$name' class='$class'>";
        $select .= "<option value='0'>Selecione</option>";

        foreach ($saves as $save) {
            $select .= "<option value='{$save->getIdS()}'";
            $select .= ($default == $save->getIdS()) ? " selected" : "";
            $select .= ">{$save->getIdS()}</option>";
        }

        $select .= "</select>";
        return $select;
    }
}
