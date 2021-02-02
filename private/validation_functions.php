<?php
    $valErrors = [
        "name"=> [
            'Name cannot be empty',
            'Name cannot be less than 3 characters',
            'Name cannot be numeric'
        ],
        
        "title"=> [
            'Title cannot be empty',
            'Title cannot be less than 3 characters',
            'Title cannot be numeric'
        ],

        "password"=>[
            "password cannot be blank",
            "password doesn't match"
        ],

        "email"=>[
            'email cannot be blank'
        ],
        "LoginPassword"=>[
            "password cannot be blank",
        ],

    ];
    
    $errorArray = [];//Defaultly No errors is recorded

    function is_blank($value) {
        return !isset($value) || trim($value) === '';
    }

    function has_presence($value) {
        return !is_blank($value);
    }

    function has_length_greater_than($value, $min) {
        $length = strlen($value);
        return $length > $min;
    }

    function has_length_less_than($value, $max) {
        $length = strlen($value);
        return $length < $max;
    }

    function has_length_exactly($value, $exact) {
        $length = strlen($value);
        return $length == $exact;
    }

    function isNumeric($data){
        return is_numeric(trim($data));
    }

    function string_contain_specific_character($haystack,$neddle,$expectedpos){
        $pos = strpos($haystack,$neddle);
        return (int)$pos === $expectedpos ? true : false;
    }


    function errorsFunc($rule, $unvalidatedData){
        global $valErrors; $errorResult = [];
        $unvalidatedDataKey = array_keys($unvalidatedData)[0];
        $unvalidatedDataValue = array_values($unvalidatedData)[0];
        switch ($rule) {
            case 'title':
                if(is_blank($unvalidatedDataValue)){
                    $errorResult[$unvalidatedDataKey] =  $valErrors[$rule][0];
                }elseif(has_length_less_than($unvalidatedDataValue, 3)){
                    $errorResult[$unvalidatedDataKey] =  $valErrors[$rule][1];
                }elseif(isNumeric($unvalidatedDataValue)){
                    $errorResult[$unvalidatedDataKey] =  $valErrors[$rule][2];
                }
                break;
                case 'name':
                    if(is_blank($unvalidatedDataValue)){
                        $errorResult[$unvalidatedDataKey] =  $valErrors[$rule][0];
                    }elseif(has_length_less_than($unvalidatedDataValue, 3)){
                        $errorResult[$unvalidatedDataKey] =  $valErrors[$rule][1];
                    }elseif(isNumeric($unvalidatedDataValue)){
                        $errorResult[$unvalidatedDataKey] =  $valErrors[$rule][2];
                    }
                break;

                case "password":
                    if(is_blank($unvalidatedData['password'])){
                        $errorResult['password'] = $valErrors[$rule][0];
                    }elseif($unvalidatedData['password'] === $unvalidatedData['confirm_password']){
                        $errorResult['password'] = $valErrors[$rule][1];
                    }
                    break;
                case "email":
                     if(is_blank($unvalidatedDataValue)){
                        $errorResult[$unvalidatedDataKey] =  $valErrors[$rule][0];
                     }
                    break;

                    case "LoginPassword":
                        if(is_blank($unvalidatedDataValue)){
                            $errorResult[$unvalidatedDataKey] =  $valErrors[$rule][0];
                        }
                    break;
                
            default:
                # code...
                break;
        }

        return $errorResult;


    }

    function validate_data($data=[], $SpecifiedRules=[], $excludedData = null){
    /* $SpecifiedRules is define as follows:
        $SpecifiedRules = ["data-key"=>"rule"]
        example:
        $SpecifiedRules = ["username"=>"name"]. This means you want to validate the data mapped to the key "username" using the validation rule "name"
        validation rule will always be added in the $valErrors array with thier specific error messages that will be displayed to the user
        N/B: the sequence of validating and displaying the error messages really matters when check is done in the errorsFunc function.(very important). This means when the checks is done for a praticular rule, error message will be disaplayed using the order specified in the $valErrors array

    */
        // For usage of this validation function, start by specify the validation rule you want to use in validating each unvalidated data field. You can also exclude the data field you don't want to validate. 
    // The data array to be validated is the first argument, the second argument is the valiation rule to be used in performing validation on each data field. N/B: you have to make sure that the sequence of specifying the validation rule follows the data field you have in the first argument array.
    
    // Finally, note you can also specify the data fields you want to specifically don't want to validate. This is specify as the third argument. Seperate each data field you don't want to validate in a string.
        global $valErrors, $errorArray; $confirm_pass = "";
        // regenerate and exclude data specified in the excludeData parameter 
        if(isset($data['confirm_password'])){
            $confirm_pass =  $data['confirm_password'];
        }
        
        $data = exclude_and_regenerate($data, $excludedData);

        
        $defaultRuleKeys = array_keys($valErrors);
        $SpecifiedRulesValues = array_values($SpecifiedRules);
        $rulesCount = count($SpecifiedRulesValues);
        $dataKey = array_keys($data);
        $dataValue = array_values($data);
        for($i = 0;  $i <= $rulesCount-1; $i++){
            if(in_array($SpecifiedRulesValues[$i], $defaultRuleKeys)){
                $unvalidatedData[$dataKey[$i]] = $dataValue[$i];
                if($SpecifiedRulesValues[$i] === 'password'){
                    $unvalidatedData[$dataKey[$i]] = $dataValue[$i];
                    $unvalidatedData["confirm_password"] =  $confirm_pass;
                }
                $returnedErrorResult = errorsFunc($SpecifiedRulesValues[$i], $unvalidatedData);
                if(!empty($returnedErrorResult)){
                    $errorArray[$dataKey[$i]] = $returnedErrorResult[$dataKey[$i]];
                }

            }else{
                throw new Exception("Invalid Error Rule", 1);
            }

        }

        return !empty($errorArray) ? $errorArray : false;

    }



?>