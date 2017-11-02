<?php
function cate_parent($data, $parent=0, $str="--", $select=0){
    foreach ($data as $key =>$val ){
        $id= $val['id'];

        $name=$val['name'];

        // 1 cap
        //echo"<option>$name</option>";
        // end 1 cap

        // cap 2
//        if($val['parent_id'==$parent])
//        {
//            echo "<option value='$id'>$str $name</option>";
//            cate_parent($data,$id,$str."--");
//        }
        // end cap 2

        // chon muc ma ta dang sua dung select=0; va da cap nhu sau, trong csdl cap 1 co parent_id =0;
        //da cap
        if($val['parent_id']== $parent)
        {
            if ($select != 0 && $id == $select)
            {
                echo "<option value='$id' selected='selected'>$str $name</option>";
            } else
            {
                echo "<option value='$id'>$str $name</option>";
            }

            cate_parent($data, $id, $str . "--", $select);

        }
    }
}
?>