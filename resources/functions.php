<?php
$upload_directory = "uploads";

// helper function

function last_id()
{
    global $connection;
    return mysqli_insert_id($connection);
}

function set_message($msg)
{
    if (!empty($msg)) {
        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }
}

function display_message()
{
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function redirect($location)
{
    header("Location: $location");
}

function query($sql)
{
    global $connection;
    return mysqli_query($connection, $sql);
}

function confirm($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

function escape_string($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}


function fetch_array($result)
{

    return ($row = mysqli_fetch_array($result));
}

/*********************************FRONT END FUNCTIONS************************************/

function login_admin()
{
    if (isset($_POST['submit'])) {
        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);

        $query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' AND role='Admin' ");
        confirm($query);

        if (mysqli_num_rows($query) == 0) {
            $query2 = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' AND role='User' ");
            confirm($query2);
            if (mysqli_num_rows($query2) == 0) {
                set_message("<div class='alert alert-danger text-center'>
                Your Password or Username are wrong! </div>");
                redirect("");
            } else {
                $row =  $query2->fetch_assoc();
                $user_data = $row['user_id'];
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $user_data;
                redirect("user");
            }
        } else {
            $row =  $query->fetch_assoc();
            $user_data = $row['user_id'];
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user_data;
            redirect("admin");
        }
    }
}
// ===========================check_login==============
function check_login()
{
    if (isset($_SESSION['user_id'])) {

        $id = $_SESSION['user_id'];
        $query = query("select * from users where user_id = '$id' limit 1");

        if ($query && mysqli_num_rows($query) > 0) {

            $user_data = mysqli_fetch_assoc($query);
            return $user_data;
        }
    }

    //redirect to login
    header("Location: ../");
    die;
}

function check_login_user()
{
    if (isset($_SESSION['user_id'])) {

        $id = $_SESSION['user_id'];
        $query = query("select * from users where user_id = '$id' limit 1");

        if ($query && mysqli_num_rows($query) > 0) {

            $user_data = mysqli_fetch_assoc($query);
            return $user_data;
        }
    }

    //redirect to login
    header("Location: ../");
    die;
}
function name_user()
{
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query =  query("SELECT * FROM users WHERE user_id =  $id ");
        confirm($query);
        while ($row = fetch_array($query)) {

            $name = <<<DELIMETER
        {$row['username']}

        DELIMETER;
        }
        echo $name;
    } else {
        echo "Hello";
    }
}






/*********************************BACK END FUNCTIONS************************************/




/************************************Admin products ******************* */

function display_image($picture)
{

    global $upload_directory;
    return $upload_directory . DS . $picture;
}


function display_admin()
{

    $category_query = query("SELECT * FROM admin");
    confirm($category_query);

    while ($row = fetch_array($category_query)) {

        $id = $row['id'];
        $username = $row['username'];
        $img = $row['img'];

        $password = $row['password'];

        $user = <<<DELIMETER

        <tr>
        <td>{$id}</td>
        <td>{$username} </td>
        <td><img width='60' src="../imguser/{$img}"></td>
        <td><a class="btn btn-danger" href="../resources/templates/back/delete_admin.php?id={$row['id']}" ><span class="fas fa-trash"></span></a></td>
        <td><a class="btn btn-primary" href="itemth?edit_admin&id={$row['id']}" ><span class="fas fa-user-edit"></span></a></td>
        
        </tr>

        <script>
        $('.btn-danger').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')
            Swal.fire({
                title: "លុបអ្នកចូលប្រើប្រាស់!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        })

        </script>

        DELIMETER;
        echo $user;
    }
}

function get_category_name()
{
  
    $query2 = query("SELECT * FROM student_name");
    confirm($query2);

    $result = '';

    while ($row = fetch_array($query2)) {

        $result .= '
        <tr>
        <td> ' . $row['student_id'] . '</td>
        <td>' . $row['student_name'] . '</td>
        <td> ' . $row['dob'] . '</td>
        <td> ' . $row['sex'] . '</td>
        <td> ' . $row['phone'] . '</td>
    
    
        <td>
        <a href="editorder.php?id=1" class="btn btn-info" role="button"><span class="glyphicon glyphicon-edit" style="color:#ffffff" data-toggle="tooltip" title="Edit Order"></span></a>
        </td>
    
        <td>
        <button id=1 class="btn btn-danger btndelete"> <span class="glyphicon glyphicon-trash" style="color:#ffffff" data-toggle="tooltip" title="Delete Order"></span></button>
        </td>
        </tr>

     ';
    }



    echo $result;
}




////////////////////get name bar


function get_name_bar()
{
    $query = query("SELECT * FROM category_name");
    confirm($query);
    $result = '';

    while ($row = fetch_array($query)) {

        $result .= '
        <th>' . $row['txt'] . '</th>

     ';
    }

    echo $result;

}

//////////////////////////////////add subject

function add_subject()
{

    if (isset($_POST['btnsave'])) {
        $category = $_POST['txtcategory'];
        $txtcolor = $_POST['txtcolor'];
        if (empty($category)) {

            $error = '<script type="text/javascript">
    jQuery(function validation(){
      swal({
        title:"Feild is Empty!",
        text: "Please Fill Feild!!",
        icon: "error",
        button: "Ok",
      });
    });
    </script>';

            echo $error;
            set_message($error);
            redirect("itemt?addsubject");
        }
        if (!isset($error)) {
            $query_check = query("SELECT * FROM tbl_category_sb WHERE sb_name = '$category'");
            confirm($query_check);
            if (mysqli_num_rows($query_check) == 0) {

                $query = query("INSERT into tbl_category_sb(sb_name,color) values('{$category}','{$txtcolor}')");
                $last_id = last_id();
                confirm($query);

                $query_student_name = query("SELECT * FROM student_name ");
                confirm($query_student_name);
                while ($row = fetch_array($query_student_name)) {
                    $student_id = $row['student_id'];

                    $query_tbl_score = query("INSERT into tbl_score(student_id,sb_id,score) values('{$student_id}','{$last_id}','{0}')");
                    confirm($query_tbl_score);
                }

                $echo = '<script type="text/javascript">
        jQuery(function validation(){
          swal({
            title:"Added!", 
            text: "Your Category is Added!",
            icon: "success",
            button: "Ok",
          });
        });
        </script>';
                echo $echo;
                set_message($echo);
                redirect("itemt?addsubject");
            } else {
                $echoc = '<script type="text/javascript">
        jQuery(function validation(){
          swal({
            title:"Error!",
            text: "មុខវិជ្ជានេះមានរូចហើយ!",
            icon: "error",
            button: "Ok",
          });
        });
        </script>';

                echo $echoc;
                set_message($echoc);
                redirect("itemt?addsubject");
            }
        }
    }

    if (isset($_POST['btnedit'])) {
        $query = query("SELECT * FROM tbl_category_sb where sb_id=" . $_POST['btnedit']);
        confirm($query);
        if ($query) {
            while ($row = fetch_array($query)) {
                echo '
        <div class="col-md-4">
        <div class="form-group">
            <label>Category</label>
            <input type="hidden" class="form-control"  value="' . $row['sb_id'] . '" name="txtid" placeholder="Enter Category">
            <input type="text" class="form-control" name="txtcategory" value="' . $row['sb_name'] . '" placeholder="Enter Category">
         </div>
         <div class="form-group">
         <label>Color</label>
         <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
         <ul class="fc-color-picker" id="color-chooser">
           <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-primary " href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-warning " href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-purole " href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-b" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-c" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-d" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-e" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-f" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-g" href="#"><i class="fa fa-square"></i></a></li>

         </ul>
       </div>
         <input type="text" class="form-control" name="txtcolor" id="add-new-event" value="' . $row['color'] . '" placeholder="Enter Category">
         </div>
        <button type="submit" name="btnupdate" class="btn btn-info">Update</button>
        </div>';
            }
        }
    } else {
        echo '
        <div class="col-md-4">
        <div class="form-group">
            <label>Category</label>
            <input type="text" class="form-control" name="txtcategory" placeholder="Enter Category">
        </div>
        
        <div class="form-group">
         <label>Color</label>
         <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
         <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
         <ul class="fc-color-picker" id="color-chooser">
           <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-primary " href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-warning " href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-purole " href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-b" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-c" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-d" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-e" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-f" href="#"><i class="fa fa-square"></i></a></li>
           <li><a class="text-g" href="#"><i class="fa fa-square"></i></a></li>

         </ul>
       </div>
         <input type="text" class="form-control" name="txtcolor"  id="add-new-event" placeholder="Enter Category">
         </div>
        <button type="submit" name="btnsave" class="btn btn-warning">Save</button>
    </div>';
    }


    //// btn_Update 

    if (isset($_POST['btnupdate'])) {
        $category = $_POST['txtcategory'];
        $txtcolor = $_POST['txtcolor'];
        $id = $_POST['txtid'];
        if (empty($category)) {

            $errorupdate = '<script type="text/javascript">
        jQuery(function validation(){
          swal({
            title:"Error!",
            text: "Feild is empty : please enter category!",
            icon: "error",
            button: "Ok",
          });
        });
        </script>';

            echo $errorupdate;
            set_message($errorupdate);
            redirect("itemt?addsubject");
        }

        if (!isset($errorupdate)) {
            $update = query("UPDATE tbl_category_sb set sb_name= '$category',color='$txtcolor' where sb_id=" . $id);
            confirm($update);
            if ($update) {

                $echo = '<script type="text/javascript">
            jQuery(function validation(){
              swal({
                title:"Updated!",
                text: "Your Category is Update!",
                icon: "success",
                button: "Ok",
              });
            });
            </script>';

                echo $echo;
                set_message($echo);
                redirect("itemt?addsubject");
            } else {
                $echo = '<script type="text/javascript">
            jQuery(function validation(){
              swal({
                title:"Error!",
                text: "Your Category is Not Update!",
                icon: "error",
                button: "Ok",
              });
            });
            </script>';
                echo $echo;
                set_message($echo);
                redirect("itemt?addsubject");
            }
        }
    }
}


function get_category_sb()
{

    $query = query("SELECT * from tbl_category_sb  ");
    confirm($query);
    while ($row = fetch_array($query)) {

        echo '
            <tr>
            <td>' . $row['sb_id'] . '</td>
            <td>' . $row['sb_name'] . '</td>
            <td><ul class="fc-color-picker"><li style="color:' . show_color_subject($row['sb_id']) . '"><i class="fa fa-square"></i></li></ul></td>
            <td><button type="submit" value="' . $row['sb_id'] . '" name="btnedit" class="btn btn-success">Edit</button></td>
            <td><button type="submit" value="' . $row['sb_id'] . '" name="btndelete" class="btn btn-danger">Delete</button></td>
          </tr>
        ';
    }
    if (isset($_POST['btndelete'])) {
        $delete = query("delete from tbl_category_sb where sb_id=" . $_POST['btndelete']);
        confirm($delete);
        if ($delete) {
            $delete = query("delete from tbl_score where sb_id=" . $_POST['btndelete']);
            $echo = '<script type="text/javascript">
            jQuery(function validation(){
              swal({
                title:"Deleted!",
                text: "Your Category is Deleted!",
                icon: "success",
                button: "Ok",
              });
            });
            </script>';
            echo $echo;
            set_message($echo);
            redirect("itemt?addsubject");
        } else {
            $echo = '<script type="text/javascript">
            jQuery(function validation(){
              swal({
                title:"Error!",
                text: "Your Category is Not Deleted!",
                icon: "error",
                button: "Ok",
              });
            });
            </script>';
            echo $echo;
            set_message($echo);
            redirect("itemt?addsubject");
        }
    }
}




///////////////////////////////////////////////////////////////////////////////////name sb





function show_color_subject($id)
{

    $query = query("SELECT * FROM tbl_category_sb  WHERE sb_id= '$id'");
    confirm($query);

    while ($row = fetch_array($query)) {

        $categories_options = <<<DELIMETER
        {$row['color']}

DELIMETER;
        return $categories_options;
    }
}

function fill_product()
{
    $output = '';
    $query = query("SELECT * from student_name order by student_id asc");
    confirm($query);

    foreach ($query as $row) {
        $output .= '<option value="' . $row["student_id"] . '">' . $row["student_name"] . '</option>';
    }
    return $output;
}





function show_score()
{
    $query = query("SELECT * FROM category_name");
    confirm($query);
    $query2 = query("SELECT * FROM student_name");
    confirm($query2);
    $query_sb = query("SELECT * FROM tbl_category_sb");
    confirm($query_sb);


    $result = '';
    $result .= '
    <thead>
    <tr> ';
    while ($row = fetch_array($query)) {
        $result .= '
        <th>' . $row['txt'] . '</th>

     ';
    }
    while ($row = fetch_array($query_sb)) {

        $result .= '
        <th>' . $row['sb_name'] . '</th>

     ';
    }
    $result .= '
    </tr>
    </thead>
    <tbody>

    ';
    while ($row = fetch_array($query2)) {
        $sdid = $row['student_id'];

        $result .= '
        
        <tr>
        <td> ' . $row['student_id'] . '</td>
        <td>' . $row['student_name'] . '</td>
        <td> ' . $row['dob'] . '</td>
        <td> ' . $row['sex'] . '</td>
        <td> ' . $row['phone'] . '</td>

     ';

        $tbl_score = query("SELECT * FROM tbl_score WHERE student_id= '$sdid' ");
        confirm($tbl_score);
        while ($row = fetch_array($tbl_score)) {
            $sdidd = $row['score'];
            $student_id = $row['student_id'];

            $result .= '
        <input type="hidden" class="form-control pname" name="student_id[]" value="' . $student_id . '" >
         <input type="hidden" class="form-control stock"name="sb_id[]" value="' . $row["sb_id"] . '">
         <td><input type="text" class="form-control stock"  style="width: 50px ;" name="score[]" value="' . $row["score"] . '"></td> 

      ';
        }
    }

    $result .= '
    </tr>
    </tbody>
    ';


    echo $result;
}

function add_score_made()
{
    if (isset($_POST['btnsave'])) {
        $student_id = $_POST['student_id'];
        $sb_id = $_POST['sb_id'];
        $score = $_POST['score'];
        $date = $_POST['date'];
        $monthly = date('Y-m', strtotime($date));
        $show = date('m', strtotime($date));
        $showw = convert_month_kh($show);

        $query_check = query("SELECT * FROM tbl_monthly_score WHERE monthly = '$monthly'");
        confirm($query_check);
        if (mysqli_num_rows($query_check) == 0) {
            for ($i = 0; $i < count($student_id); $i++) {
                $arrstudent_id = $student_id[$i];
                $arrsb_id = $sb_id[$i];
                $arrscore = $score[$i];
                $arrdate = $date;

                $query = query("INSERT INTO tbl_monthly_score(student_id,sb_id,score,date,monthly) VALUES('{$arrstudent_id}','{$arrsb_id}','{$arrscore}','{$arrdate}','{$monthly}') ");
                confirm($query);

                $echo = '<script type="text/javascript">
                jQuery(function validation(){
                  swal({
                    title:"Added!", 
                    text: "បានបញ្ចូលពន្ទុ ខែ' . $showw . '!",
                    icon: "success",
                    button: "Ok",
                  });
                });
                </script>';
                echo $echo;
                set_message($echo);
                redirect("itemt?addscore");
            }
        } else {
            $echo = '<script type="text/javascript">
                jQuery(function validation(){
                  swal({
                    title:"Error!",
                    text: "ខែ' . $showw . 'បានបញ្ចូលរូចហើយ!",
                    icon: "error",
                    button: "Ok",
                  });
                });
                </script>';
            echo $echo;
            set_message($echo);
            redirect("itemt?addscore");
        }
    }
}


function convert_month_kh($value)
{
    $kh_month =
        '{
            "01": "មករា",
            "1": "មករា",
            "02": "កុម្ភៈ",
            "2": "កុម្ភៈ",
            "03": "មិនា",
            "3": "មិនា",
            "04": "មេសា",
            "4": "មេសា",
            "05": "ឧសភា",
            "5": "ឧសភា",
            "06": "មិថុនា",
            "6": "មិថុនា",
            "07": "កក្កដា",
            "7": "កក្កដា",
            "08": "សីហា",
            "8": "សីហា",
            "09": "កញ្ញា",
            "9": "កញ្ញា",
            "10": "តុលា",
            "11": "វិចិ្ឆកា",
            "12": "ធ្នូ"
        }';


    $month = json_decode($kh_month);
    return $month->$value;
}


function updatescore()
{

    if (isset($_POST['btnupdate'])) {
        $student_id = $_POST['student_id'];
        $sb_id = $_POST['sb_id'];
        $score = $_POST['score'];
        $date = $_POST['date'];
        $monthly = date('Y-m', strtotime($date));
        $show = date('m', strtotime($date));
        $showw = convert_month_kh($show);

        for ($i = 0; $i < count($student_id); $i++) {
            $arrstudent_id = $student_id[$i];
            $arrsb_id = $sb_id[$i];
            $arrscore = $score[$i];
            $arrdate = $monthly;

            $query = query("UPDATE tbl_monthly_score SET score ='$arrscore' WHERE student_id = '$arrstudent_id' AND sb_id = '$arrsb_id' and monthly ='$arrdate'");
            confirm($query);
            $echo = '<script type="text/javascript">
                jQuery(function validation(){
                  swal({
                    title:"Added!", 
                    text: "បានកែប្រែពន្ទុ ខែ' . $showw . '!",
                    icon: "success",
                    button: "Ok",
                  });
                });
                </script>';
            echo $echo;
            set_message($echo);
            redirect("itemt?sbname");
        }
        if ($query == null) {
            $echo = '<script type="text/javascript">
                jQuery(function validation(){
                  swal({
                    title:"Error!",
                    text: "ខែ' . $showw . 'កែប្រែមិនបាន!",
                    icon: "error",
                    button: "Ok",
                  });
                });
                </script>';
            echo $echo;
            set_message($echo);
            redirect("itemt?sbname");
        }
    }
}

function get_sb_name()
{
    $date = date('Y-m-d');
    $monthly = date('Y-m', strtotime($date));
    $query = query("SELECT * FROM category_name");
    confirm($query);
    $query2 = query("SELECT * FROM student_name");
    confirm($query2);
    $query_sb = query("SELECT * FROM tbl_category_sb");
    confirm($query_sb);


    $result = '';
    $result .= '
<table class="table table-striped">
    <thead>
    <tr> ';
    while ($row = fetch_array($query)) {
        $result .= '
        <th>' . $row['txt'] . '</th>

     ';
    }
    while ($row = fetch_array($query_sb)) {

        $result .= '
        <th>' . $row['sb_name'] . '</th>

     ';
    }
    $result .= '
    </tr>
    </thead>
    <tbody>

    ';
    while ($row = fetch_array($query2)) {
        $sdid = $row['student_id'];

        $result .= '
        <tr>
        <td> ' . $row['student_id'] . '</td>
        <td>' . $row['student_name'] . '</td>
        <td> ' . $row['dob'] . '</td>
        <td> ' . $row['sex'] . '</td>
        <td> ' . $row['phone'] . '</td>

     ';

        $tbl_monthly_score = query("SELECT * FROM tbl_monthly_score WHERE student_id= '$sdid' and monthly= '$monthly'");
        confirm($tbl_monthly_score);
        while ($row = fetch_array($tbl_monthly_score)) {
            $sdidd = $row['score'];

            $result .= '
         <td> <span class="labelth" style="background-color: ' . show_color_subject($row['sb_id']) . '">' .  $sdidd . '</span></td>

      ';
        }
    }

    $result .= '
    </tr>
    </tbody>
    </table>
    <hr>
    <div align="center">
      <a class="btn btn-info" href="itemth?editscore&date=' . $monthly . '">កែប្រែ</a>
    </div>
    <hr>
    ';


    echo $result;
}
