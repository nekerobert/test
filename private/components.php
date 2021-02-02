<?php
    function empty_table_component($span){
        return '<tr>
        <td colspan="'.$span.'" class="empty-table"> <div class="empty-table-wrapper"><i class="fa fa-exclamation-triangle text-danger empty-icon"></i><div>Data not available</div></div></td>
        </tr>';
    }
    
    function pages_table_component($result){
        $str = "";
        $pageCount = 1;
        if(is_bool($result)){
            // No record was retrieve from database
            $str.= empty_table_component(5);

        }elseif(is_array($result)){
            // Only a single record existed;
            $page = $result;
            $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$page["title"].'</td>
                <td>'.formatted_date($page["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit Page" class="btn btn-sm text-white btn-warning" href="'.DASHBOARD_PATH.'pages/'.u($page['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Delete Page" class="btn btn-sm text-white btn-danger" href="'.DASHBOARD_PATH.'pages/'.u($page['id']).'/delete'.'"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';

        }else{
            // An Object was return
            // Fetch records from the objects
            while($page = mysqli_fetch_assoc($result)){
                // Sanitize data
                $page = sanitize_html($page);
                $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$page["title"].'</td>
                <td>'.formatted_date($page["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit Page" href="'.DASHBOARD_PATH.'pages/'.u($page['id']).'/edit'.'" class="btn btn-sm btn-warning text-white edit-link" ><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($page["id"]).'" class="btn btn-sm btn-danger text-white delete-link"><i class="fa fa-trash"></i></a>
                </td>
                
            </tr>';
            $pageCount++;
            
        }
        
    }
        
   
        return $str;
    }

    function display_delete_modal($data){
       $hiddenEle = isset($_SESSION['csrf_token']) ? "<input type=\"hidden\" name=\"csrf_token\" value=\"".$_SESSION['csrf_token']."\">": csrf_token_tag();
        
       return '<div id="deletemodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deletemodal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color:red" id="deletemodal">Do you want to delete this '.$data.' ?</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    '.$hiddenEle.'
                </div>
            </div>
        </div>
    </div>
' ;

    }


    function sliders_table_component($result){
        $str = "";
        $pageCount = 1;
        if(is_bool($result)){
            // No record was retrieve from database
            $str.= empty_table_component(8);

        }elseif(is_array($result)){
            $slider = regenerate_with_required(json_to_array($result["content"]), 'primary_title,secondary_title');
            $slider["id"] = $result["id"];
            $slider["date_created"] = $result["date_created"];
            $slider["img"] = full_upload_url($result["path"]);
            // sanitize to avoid xss attack
            $slider = sanitize_html($slider);
            $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$slider["primary_title"].'</td>
                <td>'.$slider["secondary_title"].'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$slider["img"].'" /></td>
                <td>'.formatted_date($slider["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit Slider" class="btn btn-sm btn-warning text-white" href="'.DASHBOARD_PATH.'sliders/'.u($slider['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($slider["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';

        }else{
            // An Object was return
            // Fetch records from the objects
            while($record = mysqli_fetch_assoc($result)){
                $data = json_to_array($record["content"]);
                $slider = regenerate_with_required($data, 'primary_title,secondary_title');
                $slider["id"] = $record["id"];
                $slider["date_created"] = $record["date_created"];
                $slider["img"] = full_upload_url($record["path"]);
                // Sanitize to avoid xss attack
                $slider = sanitize_html($slider);
                $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$slider["primary_title"].'</td>
                <td>'.$slider["secondary_title"].'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$slider["img"].'"/></td>
                <td>'.formatted_date($slider["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit Slider" class="btn btn-sm btn-warning" href="'.DASHBOARD_PATH.'sliders/'.u($slider['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($slider["id"]).'" class="btn btn-sm btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';
            $pageCount++;
            
        }
            
        }

        return $str;
        
    }
    
    function tips_table_component($result){
        $str = "";
        $pageCount = 1;
        if(is_bool($result)){
            // No record was retrieve from database
            $str.= empty_table_component(6);

        }elseif(is_array($result)){
            $tip = regenerate_with_required(json_to_array($result["content"]), 'tip_title');
            $tip["id"] = $result["id"];
            $tip["date_created"] = $result["date_created"];
            $tip["img"] = full_upload_url($result["path"]);
            // sanitize to avoid xss attack
            $tip = sanitize_html($tip);
            $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$tip["tip_title"].'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$tip["img"].'" /></td>
                <td>'.formatted_date($tip["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit Health Tip" class="btn btn-sm btn-warning text-dark" href="'.DASHBOARD_PATH.'pages/home/sections/health-tips/'.u($tip['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($tip["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';

        }else{
            // An Object was return
            // Fetch records from the objects
            while($record = mysqli_fetch_assoc($result)){
                $data = json_to_array($record["content"]);
                $tip = regenerate_with_required($data, 'tip_title');
                $tip["id"] = $record["id"];
                $tip["date_created"] = $record["date_created"];
                $tip["img"] = full_upload_url($record["path"]);
                // Sanitize to avoid xss attack
                $tip = sanitize_html($tip);
                $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$tip["tip_title"].'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$tip["img"].'"/></td>
                <td>'.formatted_date($tip["date_created"]).'</td>
                <td>
                <a data-toggle="tooltip" data-placement="top" title="Edit Health Tip" class="btn btn-sm btn-warning text-dark" href="'.DASHBOARD_PATH.'pages/home/sections/health-tips/'.u($tip['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
            </td>
            <td>
            <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($tip["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
            </td>
            </tr>
        ';
            $pageCount++;
            
        }
            
        }

        return $str;
        
    }

    function items_table_component($result){
        $str = "";
        $pageCount = 1;
        if(is_bool($result)){
            // No record was retrieve from database
            $str.= empty_table_component(6);

        }elseif(is_array($result)){
            $item = regenerate_with_required(json_to_array($result["content"]), 'item_title');
            $item["id"] = $result["id"];
            $item["date_created"] = $result["date_created"];
            $item["img"] = full_upload_url($result["path"]);
            // sanitize to avoid xss attack
            $item = sanitize_html($item);
            $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$item["item_title"].'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$item["img"].'" /></td>
                <td>'.formatted_date($item["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit Health Tip" class="btn btn-sm btn-warning text-dark" href="'.DASHBOARD_PATH.'pages/home/sections/strength-items/'.u($item['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($item["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';

        }else{
            // An Object was return
            // Fetch records from the objects
            while($record = mysqli_fetch_assoc($result)){
                $data = json_to_array($record["content"]);
                $item = regenerate_with_required($data, 'item_title');
                $item["id"] = $record["id"];
                $item["date_created"] = $record["date_created"];
                $item["img"] = full_upload_url($record["path"]);
                // Sanitize to avoid xss attack
                $item = sanitize_html($item);
                $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$item["item_title"].'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$item["img"].'"/></td>
                <td>'.formatted_date($item["date_created"]).'</td>
                <td>
                <a data-toggle="tooltip" data-placement="top" title="Edit Key Strength" class="btn btn-sm btn-warning text-dark" href="'.DASHBOARD_PATH.'pages/home/sections/strength-items/'.u($item['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
            </td>
            <td>
            <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($item["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
            </td>
            </tr>
        ';
            $pageCount++;
            
        }
            
        }

        return $str;
        
    }

    function equipment_table_component($result){
        $str = "";
        $pageCount = 1;
        if(is_bool($result)){
            // No record was retrieve from database
            $str.= empty_table_component(5);

        }elseif(is_array($result)){
            $item = json_to_array($result["content"]);
            $item["id"] = $result["id"];
            $item["date_created"] = $result["date_created"];
            $item["img"] = full_upload_url($item["path"]);
            // sanitize to avoid xss attack
            $item = sanitize_html($item);
            $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$item["img"].'" /></td>
                <td>'.formatted_date($item["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Update Equipment Image" class="btn btn-sm btn-warning text-dark" href="'.DASHBOARD_PATH.'pages/home/sections/equipments/'.u($item['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($item["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';

        }else{
            // An Object was return
            // Fetch records from the objects
            while($record = mysqli_fetch_assoc($result)){
                $item = json_to_array($record["content"]);
                $item["id"] = $record["id"];
                $item["date_created"] = $record["date_created"];
                $item["img"] = full_upload_url($item["path"]);
                // Sanitize to avoid xss attack
                $item = sanitize_html($item);
                $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$item["img"].'" /></td>
                <td>'.formatted_date($item["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Update Equipment Image" class="btn btn-sm btn-warning text-dark" href="'.DASHBOARD_PATH.'pages/home/sections/equipment-items/'.u($item['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($item["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';
            $pageCount++;
            
        }
            
        }

        return $str;
        
    }

    function sliderImage_table_component($result){
        $str = "";
        $pageCount = 1;
        if(is_bool($result)){
            // No record was retrieve from database
            $str.= empty_table_component(5);

        }elseif(is_array($result)){
            $item = json_to_array($result["content"]);
            $item["id"] = $result["id"];
            $item["date_created"] = $result["date_created"];
            $item["img"] = full_upload_url($item["path"]);
            // sanitize to avoid xss attack
            $item = sanitize_html($item);
            $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$item["img"].'" /></td>
                <td>'.formatted_date($item["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Update Slider Image" class="btn btn-sm btn-warning text-dark" href="'.DASHBOARD_PATH.'pages/about-us/sections/about-slider/'.u($item['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($item["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';

        }else{
            // An Object was return
            // Fetch records from the objects
            while($record = mysqli_fetch_assoc($result)){
                $item = json_to_array($record["content"]);
                $item["id"] = $record["id"];
                $item["date_created"] = $record["date_created"];
                $item["img"] = full_upload_url($item["path"]);
                // Sanitize to avoid xss attack
                $item = sanitize_html($item);
                $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$item["img"].'" /></td>
                <td>'.formatted_date($item["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Update Slider Image" class="btn btn-sm btn-warning text-dark" href="'.DASHBOARD_PATH.'pages/about-us/sections/about-slider/'.u($item['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($item["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';
            $pageCount++;
            
        }
            
        }

        return $str;
        
    }

    function challenge_table_component($result){
        $str = "";
        $pageCount = 1;
        if(is_bool($result)){
            // No record was retrieve from database
            $str.= empty_table_component(6);

        }elseif(is_array($result)){
            $challenge = regenerate_with_required(json_to_array($result["content"]), 'challenge_title');
            $challenge["id"] = $result["id"];
            $challenge["date_created"] = $result["date_created"];
            $challenge["img"] = full_upload_url($result["path"]);
            // sanitize to avoid xss attack
            $challenge = sanitize_html($challenge);
            $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$challenge["challenge_title"].'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$challenge["img"].'" /></td>
                <td>'.formatted_date($challenge["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit Challenge" class="btn btn-sm btn-warning text-dark" href="'.DASHBOARD_PATH.'pages/about-us/sections/challenge/'.u($challenge['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($challenge["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';

        }else{
            // An Object was return
            // Fetch records from the objects
            while($record = mysqli_fetch_assoc($result)){
                $data = json_to_array($record["content"]);
                $challenge = regenerate_with_required($data, 'challenge_title');
                $challenge["id"] = $record["id"];
                $challenge["date_created"] = $record["date_created"];
                $challenge["img"] = full_upload_url($record["path"]);
                // Sanitize to avoid xss attack
                $challenge = sanitize_html($challenge);
                $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$challenge["challenge_title"].'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$challenge["img"].'"/></td>
                <td>'.formatted_date($challenge["date_created"]).'</td>
                <td>
                <a data-toggle="tooltip" data-placement="top" title="Edit Health Tip" class="btn btn-sm btn-warning text-dark" href="'.DASHBOARD_PATH.'pages/about-us/sections/challenge/'.u($challenge['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
            </td>
            <td>
            <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($challenge["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
            </td>
            </tr>
        ';
            $pageCount++;
            
        }
            
        }

        return $str;
        
    }

    function faq_table_component($result){
        $str = "";
        $pageCount = 1;
        if(is_bool($result)){
            // No record was retrieve from database
            $str.= empty_table_component(6);

        }elseif(is_array($result)){
            // Only a single record existed;
            $data = $result;
            $faq = json_to_array($result["content"]);
            $faq['date_created'] = $data["date_created"];
            $faq["id"] = $data["id"];
            $faq = sanitize_html($faq);
            $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$faq["faq_title"].'</td>
                <td>'.$faq["faq_answer"].'</td>
                <td>'.formatted_date($faq["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit FAQ" class="btn btn-sm text-white btn-warning" href="'.DASHBOARD_PATH.'pages/faq/'.u($faq['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Delete FAQ" class="btn btn-sm text-white btn-danger" href="'.DASHBOARD_PATH.'pages/faq/'.u($faq['id']).'/delete'.'"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';

        }else{
            // An Object was return
            // Fetch records from the objects
            while($record = mysqli_fetch_assoc($result)){
                // Sanitize data
                $faq = json_to_array($record["content"]);
                $faq['date_created'] = $record["date_created"];
                $faq["id"] = $record["id"];
                $faq = sanitize_html($faq);
                $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$faq["faq_title"].'</td>
                <td>'.$faq["faq_answer"].'</td>
                <td>'.formatted_date($faq["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit FAQ" class="btn btn-sm text-white btn-warning" href="'.DASHBOARD_PATH.'pages/faq/'.u($faq['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($faq["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';
            $pageCount++;
            
        }
        
    }
        
   
        return $str;
    }

    function coreValue_table_component($result){
        $str = "";
        $pageCount = 1;
        if(is_bool($result)){
            // No record was retrieve from database
            $str.= empty_table_component(5);

        }elseif(is_array($result)){
            // Only a single record existed;
            $item = sanitize_html(json_to_array($result["content"]));
            $item["date_created"] = $result["date_created"];
            $item["id"] = h($result["id"]);
            $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$item["item_title"].'</td>
                <td>'.formatted_date($item["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit Core value item" class="btn btn-sm text-white btn-warning" href="'.DASHBOARD_PATH.'pages/about-us/sections/value-items/'.u($item['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($item["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>

                </td>
            </tr>
        ';

        }else{
            // An Object was return
            // Fetch records from the objects
            while($record = mysqli_fetch_assoc($result)){
                // Sanitize data
                $item = sanitize_html(json_to_array($record["content"]));
                $item["date_created"] = $record["date_created"];
                $item["id"] = h($record["id"]);
                $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$item["item_title"].'</td>
                <td>'.formatted_date($item["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit Core value item" class="btn btn-sm text-white btn-warning" href="'.DASHBOARD_PATH.'pages/about-us/sections/value-items/'.u($item['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($item["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>';
            $pageCount++;
            
        }
        
    }
        
   
        return $str;
    }

    function team_table_component($result){
        $str = "";
        $pageCount = 1;
        if(is_bool($result)){
            // No record was retrieve from database
            $str.= empty_table_component(10);

        }elseif(is_array($result)){
            $member = regenerate_with_required(json_to_array($result["content"]), 'member_name,member_position,member_fb,member_tw,member_lk');
            $member["id"] = $result["id"];
            $member["date_created"] = $result["date_created"];
            $member["img"] = full_upload_url($result["path"]);
            // sanitize to avoid xss attack
            $member= sanitize_html($member);
            $fbstatus = $member["member_fb"] === "" ? "Not Available" : $member["member_fb"];
            $twstatus = $member["member_tw"] === "" ? "Not Available" : $member["member_tw"];
            $lkstatus = $member["member_lk"] === "" ? "Not Available" : $member["member_lk"];
            $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$member["member_name"].'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$member["img"].'" /></td>
                <td>'.$member["member_position"].'</td>
                <td>'.$fbstatus.'</td>
                <td>'.$twstatus.'</td>
                <td>'.$lkstatus.'</td>
                <td>'.formatted_date($member["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit member image" class="btn btn-sm btn-warning text-white" href="'.DASHBOARD_PATH.'pages/about-us/sections/team/'.u($member['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($member["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';

        }else{
            // An Object was return
            // Fetch records from the objects
            while($record = mysqli_fetch_assoc($result)){
                $data = json_to_array($record["content"]);
                $member = regenerate_with_required($data, 'member_name,member_position,member_fb,member_tw,member_lk');
                $member["id"] = $record["id"];
                $member["date_created"] = $record["date_created"];
                $member["img"] = full_upload_url($record["path"]);
                // Sanitize to avoid xss attack
                $member= sanitize_html($member);
                $fbstatus = $member["member_fb"] === "" ? "Not Available" : $member["member_fb"];
                $twstatus = $member["member_tw"] === "" ? "Not Available" : $member["member_tw"];
                $lkstatus = $member["member_lk"] === "" ? "Not Available" : $member["member_lk"];
                $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$member["member_name"].'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$member["img"].'" /></td>
                <td>'.$member["member_position"].'</td>
                <td>'.$fbstatus.'</td>
                <td>'.$twstatus.'</td>
                <td>'.$lkstatus.'</td>
                <td>'.formatted_date($member["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit member image" class="btn btn-sm btn-warning text-white" href="'.DASHBOARD_PATH.'pages/about-us/sections/team/'.u($member['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($member["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';
            $pageCount++;
            
        }
            
        }

        return $str;
        
    }

    function testimonial_table_component($result){
        $str = "";
        $pageCount = 1;
        if(is_bool($result)){
            // No record was retrieve from database
            $str.= empty_table_component(6);

        }elseif(is_array($result)){
            $testimonial = regenerate_with_required(json_to_array($result["content"]), 'testifier_name,testifier_title');
            $testimonial["id"] = $result["id"];
            $testimonial["date_created"] = $result["date_created"];
            $testimonial["img"] = full_upload_url($result["path"]);
            // sanitize to avoid xss attack
            $testimonial = sanitize_html($testimonial);
           
            $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$testimonial["img"].'" /></td>
                <td>'.$testimonial["testifier_name"].'</td>
                <td>'.$testimonial["testifier_title"].'</td>
                <td>'.formatted_date($testimonial["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit testimonial" class="btn btn-sm btn-warning text-white" href="'.DASHBOARD_PATH.'pages/about-us/sections/testimonial-items/'.u($testimonial['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($testimonial["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';

        }else{
            // An Object was return
            // Fetch records from the objects
            while($record = mysqli_fetch_assoc($result)){
                $data = json_to_array($record["content"]);
                $testimonial = regenerate_with_required($data, 'testifier_name,testifier_title');
                $testimonial["id"] = $record["id"];
                $testimonial["date_created"] = $record["date_created"];
                $testimonial["img"] = full_upload_url($record["path"]);
                // sanitize to avoid xss attack
                $testimonial = sanitize_html($testimonial);
                
                $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$testimonial["img"].'" /></td>
                <td>'.$testimonial["testifier_name"].'</td>
                <td>'.$testimonial["testifier_title"].'</td>
                <td>'.formatted_date($testimonial["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit Testimonial" class="btn btn-sm btn-warning text-white" href="'.DASHBOARD_PATH.'pages/about-us/sections/testimonial-items/'.u($testimonial['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($testimonial["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';
            $pageCount++;
            
        }
            
        }

        return $str;
        
    }


    function category_table_component($result, $cat=null){
        $url =  $cat === 'gallery' ? 
          'pages/gallery/sections/gallery-category/':
        'pages/services/sections/service-category/';
        $str = "";
        $pageCount = 1;
        if(is_bool($result)){
            // No record was retrieve from database
            $str.= empty_table_component(5);
        }elseif(is_array($result)){
            // Only a single record existed;
            $category = $result;
            $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$category["cat_title"].'</td>
                <td>'.$category["type"].'</td>
                <td>'.formatted_date($category["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit Category" class="btn btn-sm text-white btn-warning" href="'.DASHBOARD_PATH.''. $url.''.u($category['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                    <a data-toggle="modal" data-target="#deletemodal" data-key="'.u($category["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';

        }else{
            // An Object was return
            // Fetch records from the objects
            while($category = mysqli_fetch_assoc($result)){
                // Sanitize data
                $category = sanitize_html($category);
                $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$category["cat_title"].'</td>
                <td>'.$category["type"].'</td>
                <td>'.formatted_date($category["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit Category" class="btn btn-sm text-white btn-warning" href="'.DASHBOARD_PATH.''.$url.''.u($category['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                    <a data-toggle="modal" data-target="#deletemodal" data-key="'.u($category["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>';
            
            $pageCount++;
            
        }
        
    }
        
   
        return $str;
    }


    function populate_select_el($data, $test, $array_key, $select_name){
        $str = "<option value=''>Select {$select_name}</option> ";
        if(is_bool($data)){
            return $str;
        }elseif(is_array($data)){
            $selected = strlen($test) !== 0 ?
            ( trim(strtolower($data[$array_key])) === trim(strtolower($test)) ? 'selected':'') : '';            
            $str .= '<option value="'.trim($data[$array_key]).'" '.$selected.'>'.ucfirst($data[$array_key]).'</option>';
            return $str;
        }else{
            while($el = mysqli_fetch_assoc($data)){
                $selected =  strlen($test) !== 0 ?
                ( trim(strtolower($el[$array_key])) === trim(strtolower($test)) ? 'selected':'') : '';    
                $str .= '<option value="'.trim($el[$array_key]).'" '.$selected.'>'.ucfirst($el[$array_key]).'</option>';
            }

            return $str;

        }



    }

    function service_table_component($result){
        $str = "";
        $pageCount = 1;
        if(is_bool($result)){
            // No record was retrieve from database
            $str.= empty_table_component(7);

        }elseif(is_array($result)){
            $service = regenerate_with_required(json_to_array($result["content"]), 'full_title,short_title,service_cat');
            $service["id"] = $result["id"];
            $service["date_created"] = $result["date_created"];
            $service["img"] = full_upload_url($result["path"]);
            // sanitize to avoid xss attack
            $service = sanitize_html($service);
            $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$service["short_title"].'</td>
                <td>'.$service["full_title"].'</td>
                <td>'.$service["service_cat"].'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$service["img"].'" /></td>
                <td>'.formatted_date($service["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit Service" class="btn btn-sm btn-warning text-dark" href="'.DASHBOARD_PATH.'pages/services/sections/service-items/'.u($service['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($service["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';

        }else{
            // An Object was return
            // Fetch records from the objects
            while($record = mysqli_fetch_assoc($result)){
                $data = json_to_array($record["content"]);
                $service = regenerate_with_required($data, 'full_title,short_title,service_cat');
                $service["id"] = $record["id"];
                $service["date_created"] = $record["date_created"];
                $service["img"] = full_upload_url($record["path"]);
                // sanitize to avoid xss attack
                $service = sanitize_html($service);
                // Sanitize to avoid xss attack
                $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$service["short_title"].'</td>
                <td>'.$service["full_title"].'</td>
                <td>'.$service["service_cat"].'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$service["img"].'" /></td>
                <td>'.formatted_date($service["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit Service" class="btn btn-sm btn-warning text-dark" href="'.DASHBOARD_PATH.'pages/services/sections/service-items/'.u($service['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($service["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';
            $pageCount++;
            
        }
            
        }

        return $str;
        
    }

    
    function gallery_table_component($result){
        $str = "";
        $pageCount = 1;
        if(is_bool($result)){
            // No record was retrieve from database
            $str.= empty_table_component(6);

        }elseif(is_array($result)){
            $gallery = json_to_array($result["content"]);
            $gallery["id"] = $result["id"];
            $gallery["date_created"] = $result["date_created"];
            $gallery["img"] = full_upload_url($gallery["path"]);
            // sanitize to avoid xss attack
            $gallery = sanitize_html($gallery);
            $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$gallery["img"].'" /></td>
                <td>'.$gallery['gallery_cat'].'</td>
                <td>'.formatted_date($gallery["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Update Equipment Image" class="btn btn-sm btn-warning text-dark" href="'.DASHBOARD_PATH.'pages/gallery/sections/gallery-items/'.u($gallery['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($gallery["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';

        }else{
            // An Object was return
            // Fetch records from the objects
            while($record = mysqli_fetch_assoc($result)){
                $gallery = json_to_array($record["content"]);
                $gallery["id"] = $record["id"];
                $gallery["date_created"] = $record["date_created"];
                $gallery["img"] = full_upload_url($gallery["path"]);
                  // Sanitize to avoid xss attack
                $gallery = sanitize_html($gallery);
                $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td><img class="img-fluid image-thumbnail" src="'.$gallery["img"].'" /></td>
                <td>'.$gallery['gallery_cat'].'</td>
                <td>'.formatted_date($gallery["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Update Gallery image" class="btn btn-sm btn-warning text-dark" href="'.DASHBOARD_PATH.'pages/gallery/sections/gallery-items/'.u($gallery['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($gallery["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';
            $pageCount++;
            
        }
            
    }

        return $str;
        
    }



    function usercontact_table_component($result){
        $str = "";
        $pageCount = 1;
        if(is_bool($result)){
            // No record was retrieve from database
            $str.= empty_table_component(7);

        }elseif(is_array($result)){
            // Only a single record existed;
            $data = $result;
            $usercontact = json_to_array($result["content"]);
            $usercontact['date_created'] = $data["date_created"];
            $usercontact["id"] = $data["id"];
            $usercontact = sanitize_html($usercontact);
            $str.= '<tr>
            <td>'.$pageCount.'</td>
            <td>'.$usercontact["user_firstname"].'</td>
            <td>'.$usercontact["user_emailaddr"].'</td>
            <td>'.$usercontact["feedback_msg"].'</td>
            <td>'.formatted_date($usercontact["date_created"]).'</td>
            <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit usercontact" class="btn btn-sm text-white btn-warning" href="'.DASHBOARD_PATH.'pages/contact-us/sections/usercontact/'.u($usercontact['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Delete usercontact" class="btn btn-sm text-white btn-danger" href="'.DASHBOARD_PATH.'pages/contact-us/sections/usercontact/'.u($usercontact['id']).'/delete'.'"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';

        }else{
            // An Object was return
            // Fetch records from the objects
            while($record = mysqli_fetch_assoc($result)){
                // Sanitize data
                $usercontact = json_to_array($record["content"]);
                $usercontact['date_created'] = $record["date_created"];
                $usercontact["id"] = $record["id"];
                $usercontact = sanitize_html($usercontact);
                $str.= '<tr>
                <td>'.$pageCount.'</td>
                <td>'.$usercontact["user_firstname"].'</td>
                <td>'.$usercontact["user_emailaddr"].'</td>
                <td>'.$usercontact["feedback_msg"].'</td>
                <td>'.formatted_date($usercontact["date_created"]).'</td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="Edit usercontact" class="btn btn-sm text-white btn-warning" href="'.DASHBOARD_PATH.'pages/contact-us/sections/usercontact/'.u($usercontact['id']).'/edit'.'"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                <a  data-toggle="modal" data-target="#deletemodal" data-key="'.u($usercontact["id"]).'" class="btn btn-sm text-white btn-danger delete-link"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        ';
            $pageCount++;
            
        }
        
    }
        
   
        return $str;
    }
   

?>