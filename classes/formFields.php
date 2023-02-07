<?php


class formFields
{
    function __construct()
    {
    }

    public function inputText($id = "random-id",$title = "No title found",$defaultValue = "",$placeHolder =  "",$required = false){
        return '<label for="'.$id.'" class="form-label h6">'.$title.' '.($required?'<span class="text-danger">*</span>':"").'</label>
                <input type="text" class="form-control mb-2" name = "'.$id.'" id="'.$id.'" value="'.$defaultValue.'" placeholder = "'.$placeHolder.'" >
                <div class="text-danger" id = "'.$id.'_validation" style = "display:none">Please provide a valid '.$placeHolder.'.</div>';
    }

    public function inputNumber($id = "random-id",$title = "No title found",$defaultValue = "",$placeHolder =  "",$required = false){
        return '<label for="'.$id.'" class="form-label h6">'.$title.' '.($required?'<span class="text-danger">*</span>':"").'</label>
                <input type="number" class="form-control mb-2" name = "'.$id.'" id="'.$id.'" value="'.$defaultValue.'" placeholder = "'.$placeHolder.'" >
                <div class="text-danger" id = "'.$id.'_validation" style = "display:none">Please provide a valid '.$placeHolder.'.</div>';
    }


    public function inputTextArea($id = "random-id",$title = "No title found",$defaultValue = "",$placeHolder =  "",$required = false){
        return '<label for="'.$id.'" class="form-label h6">'.$title.' '.($required?'<span class="text-danger">*</span>':"").'</label>
                <textarea class="form-control mb-2" name = "'.$id.'" id="'.$id.'" value="'.$defaultValue.'" placeholder = "'.$placeHolder.'" rows = "3" ></textarea>
                <div class="text-danger" id = "'.$id.'_validation" style = "display:none">Please provide a valid '.$placeHolder.'.</div>';
    }


    public function inputPassword($id = "random-id",$title = "No title found",$defaultValue = "",$placeHolder =  "",$required = false){
        return '<label for="'.$id.'" class="form-label h6">'.$title.' '.($required?'<span class="text-danger">*</span>':"").'</label>
                <input type="password" class="form-control mb-2" name = "'.$id.'" id="'.$id.'" value="'.$defaultValue.'" placeholder = "'.$placeHolder.'" >
                <div class="text-danger" id = "'.$id.'_validation" style = "display:none">Please provide a valid '.$placeHolder.'.</div>';
    }

    public function inputAutoComplete($id = "random-id",$title = "No title found",$defaultValue = "",$placeHolder =  "",$required = false){
        return '<label for="'.$id.'" class="form-label h6">'.$title.' '.($required?'<span class="text-danger">*</span>':"").'</label>
                <div class = "'.$id.'_container"><input class="form-control mb-2" name = "'.$id.'" id="'.$id.'" value="'.$defaultValue.'" placeholder = "'.$placeHolder.'" /></div>';
    }

    public function inputTable($id = "random-id",$title = "No title found",$tableHead = []){
        $return = '';
        $return .= '<label for="'.$id.'" class="form-label h6">'.$title.'</label>';
        $return .= '<div class = "'.$id.'_container">';
        $htmlBody = '';
        foreach ($tableHead as $th) {
            $htmlBody .= "<th>$th</th>";
        }

        $return .= '<table class="table '.$id.'_table"><thead class="bg-primary text-white '.$id.'_table_head">'.$htmlBody.'</thead><tbody class = "'.$id.'_table_body"></tbody></table>';
        $return .= '</div>';

        return $return;

    }

    public function inputEmail($id = "random-id",$title = "No title found",$defaultValue = "",$placeHolder =  "",$required = false){
        return $this->inputText($id,$title,$defaultValue,$placeHolder,$required);
    }

    public function inputMobile($id = "random-id",$title = "No title found",$defaultValue = "",$placeHolder =  "",$prefix = "",$required = false){
        return '<label for="'.$id.'" class="form-label h6">'.$title.' '.($required?'<span class="text-danger">*</span>':"").'</label>
                <div class="input-group">
                    <span class="input-group-text" id="'.$id.'_addOn">'.$prefix.'</span>
                    <input type="text" class="form-control" name = "'.$id.'" id="'.$id.'" value="'.$defaultValue.'" placeholder = "'.$placeHolder.'"  aria-describedby="'.$id.'_addOn" maxlength="11"> 
                </div>
                <div class="text-danger" id = "'.$id.'_validation" style = "display:none">Please provide a valid mobile number</div>';
    }

    public function dropdown($id = "random-id",$title = "No title found",$defaultValue = "",$placeHolder =  "",$options = [],$required = false){
        $return = '<label for="'.$id.'" class="form-label h6">'.$title.' '.($required?'<span class="text-danger">*</span>':"").'</label>';
        $html_options = '';
        if(!$placeHolder)
            $html_options .= '<option value="'.$html_options.'">'.$html_options.'</option>';
        foreach ($options AS $option){
            $html_options .= '<option value="'.$option["id"].'" '.($option["id"] == $defaultValue?"selected":"").'>'.$option["title"].'</option>';
        }

        $return .= '<select class="form-select" id="'.$id.'" >'.$html_options.'</select>';
        $return .= '<div class="text-danger" id = "'.$id.'_validation" style = "display:none">Please select a option</div>';
        return $return;
    }

    public function inputCheckBox($id = "random-id",$title = "No title found",$defaultValue = "",$onchangeCallBack = null){
        return '<label for="'.$id.'" class="form-label h6">'.$title.'</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="'.$id.'" id="'.$id.'" onchange="'.$onchangeCallBack.'" '.($defaultValue == 1?"checked":"").'  />
                    </div>';

    }

    public function inputRadio($id = "random-id",$title = "No title found",$options = [],$defaultValue = "",$required = false,$onchangeCallBack = null){
        $return = '<label for="'.$id.'" class="form-label h6">'.$title.' '.($required?'<span class="text-danger">*</span>':"").'</label>';
        if(!is_array($options))
            $options = [];
        foreach ($options AS $option){
            $optionId = isset($option["id"])?$option["id"]:"";
            $return .= '<div class="form-check">
                            <input class="form-check-input" type="radio" name="'.$id.'" id="'.$optionId.'" onchange="'.$onchangeCallBack.'" '.($optionId == $defaultValue?"checked":"").' value = "'.(isset($option["value"])?$option["value"]:"").'" />
                            <label class="form-check-label" for="'.$optionId.'">'.(isset($option["title"])?$option["title"]:"").'</label>
                        </div>';
        }

        return $return;
    }

    public function monthPicker($id = "random-id",$title = "No title found",$defaultValue = "",$placeHolder =  "",$required = false){
        return '<label for="'.$id.'" class="form-label h6">'.$title.' '.($required?'<span class="text-danger">*</span>':"").'</label>
                <input type="text" class="form-control mb-2" name = "'.$id.'" id="'.$id.'" value="'.$defaultValue.'" placeholder = "'.$placeHolder.'" >
                <script>
                    $("#'.$id.'").datepicker({
                        autoclose: true,
                        format: "yyyy-mm",
                        startView: "months",
                        minViewMode: "months"
                    });
                </script>';
    }

    public function inputDate($id = "random-id",$title = "No title found",$defaultValue = "",$placeHolder =  "",$required = false){
        return '<label for="'.$id.'" class="form-label h6">'.$title.' '.($required?'<span class="text-danger">*</span>':"").'</label>
                <input type="text" class="form-control mb-2" name = "'.$id.'" id="'.$id.'" value="'.$defaultValue.'" placeholder = "'.$placeHolder.'" >
                <script>
                    $("#'.$id.'").datepicker({
                        autoclose: true,
                        format: "yyyy-mm-dd",
                    });
                </script>';
    }

    public function inputMonth($id = "random-id",$title = "No title found",$defaultValue = "",$placeHolder =  "",$required = false){
        return '<label for="'.$id.'" class="form-label h6">'.$title.' '.($required?'<span class="text-danger">*</span>':"").'</label>
                <input type="text" class="form-control mb-2" name = "'.$id.'" id="'.$id.'" value="'.$defaultValue.'" placeholder = "'.$placeHolder.'" >
                <script>
                    $("#'.$id.'").datepicker({
                        autoclose: true,
                        format: "mm/yy",
                        startView: "months",
                        minViewMode: "months"
                    });
                </script>';
    }


    public function labelField($title = "No title found",$defaultValue = ""){
        $id = uniqid("label-field-")."-".time();
        return '<div class = "mb-3">
                    <label for="'.$id.'" class="form-label h6">'.$title.'</label>
                    <div class = "fw-normal" id = "'.$id.'">'.$defaultValue.'</div>
                </div>';
    }


    public function breadCrumb($links = []){
        $htmlReturn = '<li class="breadcrumb-item"><a href="../" class="text-decoration-none">Dashboard</a></li>';
        foreach ($links AS $link){
            $hrefTag = $link["title"];
            if(isset($link["url"]) && $link["url"]){
                $hrefTag = '<a href="'.$link["url"].'" class="text-decoration-none">'.$link["title"].'</a>';
            }

            $htmlReturn .= '<li class="breadcrumb-item '.(isset($link["active"])?"active":"").'">'.$hrefTag.'</li>';
        }

        return '<nav aria-label="breadcrumb">
                    <ol class="breadcrumb">'.$htmlReturn.'</ol>
                </nav>';

    }

    public function grid($name = "",$primaryColumn = "id",$apiURL = "",$columnArray = [],$operationArray = []){
        $return = '';
        $tableHead = '';
        $tableBody = [];
        foreach ($columnArray AS $column){
            if(isset($column["title"])){
                $tableHead .= '<th>'.$column["title"].'</th>';
                $tableBody[] = ["data" => $column["id"]];
            }
        }


        if(count($operationArray)){
            $tableHead .= '<th>ACTION</th>';
        }

        $return .= '<div class="table-responsive">
                        <table id="'.$name.'" class="table" style="width: 100%;white-space: nowrap;">
                            <thead>
                            <tr>'.$tableHead.'</tr>
                            </thead>
                        </table>
                    </div>';

        $return .= '<script>
                    $(() => {
                        let name        = "'.$name.'";
                        let primaryCol  = "'.$primaryColumn.'";
                        let apiURL      = "'.$apiURL.'";
                        let gridCols    = '.json_encode($tableBody).';
                        let gridOps     = '.json_encode($operationArray).';
                        
                        if(gridOps.length){
                            gridCols.push({
                                "data" : `${primaryCol}`, 
                                "render" : renderCol 
                            });
                        }
                        
                      
                        $(`#${name}`).DataTable({
                            ajax: `../api/${apiURL}`,
                            columns : gridCols,
                            order: [[0, "desc"]],
                            columnDefs: [{target : 0, visible : false}]
                        });
                        
                        function renderCol(data, type){
                            let returnHTML = ``;
                            returnHTML += `<div class="d-flex gap-1">`;
                            $.each(gridOps,(key,ops)=>{
                                returnHTML += `<a href = "${ops.url}&_id=${data}" class="btn ${ops.class} btn-sm"><i class="${ops.icon}"></i></a>`;
                            })
                            returnHTML += `</div>`;
                            
                            return returnHTML;
                        }
                    });
                </script>';
        
        return $return;
    }


}