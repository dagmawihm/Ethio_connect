<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Groups page | Ethio Connect</title>

    <?php
    include_once "inc/header.php";
    ?>



    <section class="companies-info">
        <div class="container">
            <div class="company-title">
                <h3>Groups</h3>
            </div>

            <div class="companies-list">
                <div class="row">

                    <a href="group_create_form.php">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="company_profile_info">
                                <div class="company-up-info">
                                    <img src="group_img\group_pp\create.png" alt="">
                                    <h3>Create Group</h3>
                                    <h4>Create Your own group</h4>
                                    <ul>
                                        <li><a href="group_create_form.php" style="background-color: #2972e0;" title="" class="flww"><i class="fa fa-users"></i>
                                                Create</a></li>
                                        <br><br><br><br>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </a>

                    <?php
                    $sql_my_groups = "SELECT group_id FROM group_members where user_id = '$user_id'";
                    $result_my_groups = mysqli_query($db, $sql_my_groups);
                    while ($row = mysqli_fetch_array($result_my_groups)) {
                        $group_id = $row['group_id'];

                        $sql_group_info = "SELECT * FROM groups where group_id = '$group_id'";
                        $result_group_info = mysqli_query($db, $sql_group_info);
                        while ($row = mysqli_fetch_array($result_group_info)) {
                            $group_name = $row['group_name'];
                            $category = $row['category'];
                            $profile_pic = $row['profile_pic'];
                            $web_address = $row['web_address'];
                        }

                    ?>

                        <a href="group.php?webaddress=<?php echo $web_address; ?>">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="company_profile_info">
                                    <div class="company-up-info">
                                        <img src="group_img\group_pp\<?php echo $profile_pic; ?>" alt="">
                                        <h3><?php echo $group_name; ?></h3>
                                        <h4><?php echo $category; ?></h4>
                                        <ul>
                                            <form action="" method="post">
                                                <button type="submit" style="display: none;" name="leave" value="<?php echo $group_id; ?>" id="leave<?php echo $group_id; ?>"></button>
                                            </form>
                                            <li><a href="" style="background-color: red;" title="" class="flww"><label for="leave<?php echo $group_id; ?>"><i class="fa fa-times"></i>
                                                        Leave</label></a></li>
                                        </ul>
                                    </div>
                                    <a href="group.php?webaddress=<?php echo $web_address; ?>" title="" class="view-more-pro">View group</a>
                                </div>
                            </div>
                        </a>

                    <?php
                    }
                    if (isset($_POST['leave'])) {
                        $group_id_leave = $_POST['leave'];
                        $sql_del_messages = "DELETE FROM group_members WHERE group_id = '$group_id_leave' AND user_id = '$user_id'";
                        mysqli_query($db, $sql_del_messages);
                        echo '<script type="text/javascript">';
                        echo "window.location.href = 'groups.php';";
                        echo "</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>




    <?php
    include_once "inc/footer.php";
    ?>

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.range-min.js"></script>
    <script type="text/javascript" src="lib/slick/slick.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    </body>

</html>