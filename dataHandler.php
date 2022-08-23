<?php
    include('config.php');
    include('mailerFunction.php');
    include('functions.php');

    if(isset($_POST['intent'])){
        $intent = $_POST['intent'];
        
        //1 - login block
        if(strcmp($intent, '_login') == 0){
            $username = $_POST['_username'];
            $password = md5($_POST['_password']);

            $query = "SELECT * FROM adminbase WHERE username='$username' AND password='$password' AND status=1";
            $result = $conn->query($query);
            if($result->num_rows == 1){
                $row = $result->fetch_assoc();
                session_start();
                $_SESSION['adminid'] = $row['adminid'];
                $_SESSION['accessLevel'] = $row['accessLevel'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['department'] = $row['department'];
                if($row['firstLogin']==1){
                    header('Location: changePasswordFirstLogin');
                }else{
                    header('Location: dashboard');
                }
            }else{
                echo "<script>window.location.href='index?error=incorrectCredentials'</script>";
            }
        }

        //2 - new report block
        elseif(strcmp($intent, 'newReport') == 0){
            $departmentid = $_POST['departmentid'];
            $departmentname = $_POST['departmentname'];
            $adminid = $_POST['adminid'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $objective = $_POST['objective'];
            $resource = $_POST['resource'];
            $sdate = $_POST['sdate'];
            $edate = $_POST['edate'];
            $mode = $_POST['mode'];
            $attendee = $_POST['attendee'];
            $target_dir = "eventImages/";
            $count = count($_FILES['image']['name']);
            if($count>5){
                header('Location: addReport?message=manyImages');
            }else{
                $tillNumQuery = "SELECT * FROM department WHERE departmentid='$departmentid'";
                $tillNumResult = $conn->query($tillNumQuery);
                $tillNumRow = $tillNumResult->fetch_assoc();
                $deptCode = $tillNumRow['departmentcode'];
                $tillNum = $tillNumRow['documentTill'];
                $tillNum++;
                $monthNumeral = substr($sdate, 5, 2);
                switch($monthNumeral){
                    case '01':
                        $month = 'JAN';
                        break;
                    case '02':
                        $month = 'FEB';
                        break;
                    case '03':
                        $month = 'MAR';
                        break;
                    case '04':
                        $month = 'APR';
                        break;
                    case '05':
                        $month = 'MAY';
                        break;
                    case '06':
                        $month = 'JUN';
                        break;
                    case '07':
                        $month = 'JUL';
                        break;
                    case '08':
                        $month = 'AUG';
                        break;
                    case '09':
                        $month = 'SEP';
                        break;
                    case '10':
                        $month = 'OCT';
                        break;
                    case '11':
                        $month = 'NOV';
                        break;
                    case '12':
                        $month = 'DEC';
                        break;
                    default:
                        $month = 'ILLEGAL';
                }
                $reportid = $deptCode."_NEWS".$tillNum."_".$month.substr($sdate, 0, 4);
                // $reportid = md5(date('dmYHisu').rand(0,100));

                $updatenum = "UPDATE department SET documentTill='$tillNum' WHERE departmentid='$departmentid'";
                $updatenumresult = $conn->query($updatenum);
                $query = "INSERT INTO report (reportid, departmentid, adminid, title, description, objective, resource, sdate, edate, mode, attendee) VALUES ('$reportid', '$departmentid', '$adminid', '$title', '$description', '$objective', '$resource', '$sdate', '$edate', '$mode', '$attendee')";
                $result = $conn->query($query);
                if($result === TRUE){
                    for($i=0; $i<$count; $i++){
                        $target_file = $target_dir.basename($_FILES["image"]["name"][$i]);
                        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                        $newfilename = md5(date('dmYHisu')).$i;
                        $target_file = $target_dir.$newfilename.".".$fileType;
                        move_uploaded_file($_FILES["image"]["tmp_name"][$i], $target_file);
                        $imgquery = "INSERT INTO imagefiles (imageid, reportid, fileLocation) VALUES ('$newfilename', '$reportid', '$target_file')";
                        $imgresult = $conn->query($imgquery);
                    }

                    $subject = "New Report Submitted";
                    $message = "New Report Submitted By ".$departmentname.". Report ID : ".$reportid;
                    mailsomeone('all', $subject, $message);
                    header('Location: addReport?message=success');
                }else{
                    header('Location: addReport?message=dbError');
                }
            }
        }

        //newUser
        elseif(strcmp($intent, 'newUser') == 0){
            $name = $_POST['name'];
            $username = $_POST['username'];
            $rawpwd = $_POST['password'];
            $password = md5($_POST['password']);
            $email = $_POST['email'];
            $department = $_POST['department'];
            $accessLevel = $_POST['accessLevel'];
            $adminid = md5(date('dmYHisu').rand(0,100));
            $query = "INSERT INTO adminbase (adminid, username, password, name, email, department, accessLevel) VALUES ('$adminid', '$username', '$password', '$name', '$email', '$department', '$accessLevel')";
            $result = $conn->query($query);

            $to = $adminid;
            $subject = "New User Created";
            $message = "New User Created for Silicon Report Portal. Login Credentials are as follows : <br>Login URL : <a href='https://events.silicon.ac.in'>events.silicon.ac.in</a><br>Username : ".$username."<br>Password : ".$rawpwd."<br><br>Note : <b>You will be prompted to change password upon first login</b>.<br><br>Regards,<br>Silicon Report Portal";
            mailsomeone($adminid, $subject, $message);
            if($result === TRUE){
                header('Location: userManagement?message=success');
            }
        }

        //admin password change
        elseif(strcmp($intent, 'suAdminPasswordChange') == 0){
            if(isset($_POST['adminid'])){
                $adminid = $_POST['adminid'];
                $password = md5($_POST['password']);
                $query = "UPDATE adminbase SET password='$password', firstLogin='1' WHERE adminid='$adminid'";
                $result = $conn->query($query);
                if($result === TRUE){
                    header('Location: userManagement?message=success');
                }
            }
        }

        //admin change access level
        elseif(strcmp($intent, 'suAdminChangeAccessLevel') == 0){
            if(isset($_POST['adminid'])){
                $adminid = $_POST['adminid'];
                $accessLevel = $_POST['accessLevel'];
                $name = $_POST['name'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $department = $_POST['department'];
                $query = "UPDATE adminbase SET name='$name', username='$username', email='$email', department='$department', accessLevel='$accessLevel' WHERE adminid='$adminid'";
                $result = $conn->query($query);
                if($result === TRUE){
                    header('Location: userManagement?message=success');
                }
            }
        }

        //admin change access level
        elseif(strcmp($intent, 'suAdminRevokeUser') == 0){
            if(isset($_POST['adminid'])){
                $adminid = $_POST['adminid'];
                $query = "UPDATE adminbase SET status=1 WHERE adminid='$adminid'";
                $result = $conn->query($query);
                if($result === TRUE){
                    header('Location: userManagement?message=success');
                }
            }
        }

        //new Department
        elseif(strcmp($intent, 'newDepartment') == 0){
            $name = $_POST['name'];
            $code = $_POST['code'];
            $color = $_POST['deptColor'];
            $departmentid = md5(date('dmYHisu').rand(0,100));
            $query = "INSERT INTO department (departmentid, departmentname, departmentcode, departmentcolor) VALUES ('$departmentid', '$name', '$code', '$color')";
            $result = $conn->query($query);
            if($result === TRUE){
                header('Location: departmentManagement?message=success');
            }
        }

        //changePassword
        elseif(strcmp($intent, '_changePassword') == 0){
            if(isset($_POST['adminid'])){
                $oldpwd = md5($_POST['cpassword']);
                $npwd = md5($_POST['npassword']);
                $adminid = $_POST['adminid'];

                $query = "SELECT * FROM adminbase WHERE adminid='$adminid' AND password='$oldpwd' AND status=1";
                $result = $conn->query($query);
                if($result->num_rows==1){
                    $updatequery = "UPDATE adminbase SET password='$npwd', firstLogin='0' WHERE adminid='$adminid'";
                    $updateresult = $conn->query($updatequery);
                    if($updateresult === TRUE){
                        header('Location: index');
                    }
                }else{
                    header('Location: index');
                }
            }
        }

        elseif(strcmp($intent, 'uploadFinalReport') == 0){
            if(isset($_POST['reportid'])){
                $reportid = $_POST['reportid'];
                $target_dir = "finalReport/";
                $target_file = $target_dir.basename($_FILES["finalReport"]["name"]);
                $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $newfilename = md5(date('dmYHisu'));
                $target_file = $target_dir.$newfilename.".".$fileType;
                move_uploaded_file($_FILES["finalReport"]["tmp_name"], $target_file);
                $imgquery = "UPDATE report SET finalDocument='$target_file', finalDocumentAvailable='1' WHERE reportid='$reportid'";
                $imgresult = $conn->query($imgquery);

                $to = getAdminId($reportid);
                $subject = "Final Report Published";
                $message = "Final Report has been published for Report ID ; <b>".$reportid."</b>. You can view the report in the portal. <br><br>Regards,<br>Silicon Report Portal";
                mailsomeone($to, $subject, $message);
                header('Location: allReports');
            }else{
                header('Location: allReports');
            }
        }

        elseif(strcmp($intent, 'editReport') == 0){
            if(isset($_POST['reportid'])){
                $reportid = $_POST['reportid'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $objective = $_POST['objective'];
                $resource = $_POST['resource'];
                $sdate = $_POST['sdate'];
                $edate = $_POST['edate'];
                $mode = $_POST['mode'];
                $attendee = $_POST['attendee'];

                $query = "UPDATE report SET title='$title', description='$description', objective='$objective', resource='$resource', sdate='$sdate', edate='$edate', mode='$mode', attendee='$attendee' WHERE reportid='$reportid'";
                $result = $conn->query($query);

                if($result === TRUE){
                    header('Location: reports');
                }
            }
        }

        elseif(strcmp($intent, 'publicSharingEnable') == 0){
            if(isset($_POST['reportid'])){
                $reportid = $_POST['reportid'];
                $reportpassword = $_POST['reportpassword'];

                $str = "123456789ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz";
                $link = substr(str_shuffle($str), 0, 8);
                
                $imgquery = "UPDATE report SET reportpassword='$reportpassword', publicSharing='1', reportShortLink='$link' WHERE reportid='$reportid'";
                $imgresult = $conn->query($imgquery);
                header('Location: reportSharing');
            }else{
                header('Location: reportSharing');
            }
        }


        elseif(strcmp($intent, 'newUpcomingEvent') == 0){
            if(isset($_POST['departmentid'])){
                $departmentid = $_POST['departmentid'];
                $eventName = $_POST['eventName'];
                $fromDate = $_POST['fromDate'];
                $toDate = $_POST['toDate'];
                $fromTime = $_POST['fromTime'];
                $toTime = $_POST['toTime'];
                $audience = $_POST['audience'];
                $venue = $_POST['venue'];
                $description = $_POST['description'];

                $eventid = md5(date('dmYHisu').rand(0,100));

                $target_dir = "infographic/";
                $target_file = $target_dir.basename($_FILES["image"]["name"]);
                $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $newfilename = md5(date('dmYHisu'));
                $target_file = $target_dir.$newfilename.".".$fileType;
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

                $query = "INSERT INTO events (eventid, departmentid, name, fromDate, toDate, fromTime, toTime, audience, venue, description, infographic) VALUES ('$eventid', '$departmentid', '$eventName', '$fromDate', '$toDate', '$fromTime', '$toTime', '$audience', '$venue', '$description', '$target_file')";
                $result = $conn->query($query);

                if($result === TRUE){
                    header('Location: newEvent');
                }else{
                    header('Location: newEvent');
                }
            }
        }

        elseif(strcmp($intent, 'addMoreImages') == 0){
            if(isset($_POST['reportid'])){
                $reportid = $_POST['reportid'];
                $count = count($_FILES['image']['name']);
                $target_dir = "eventImages/";
                for($i=0; $i<$count; $i++){
                    $target_file = $target_dir.basename($_FILES["image"]["name"][$i]);
                    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $newfilename = md5(date('dmYHisu')).$i;
                    $target_file = $target_dir.$newfilename.".".$fileType;
                    move_uploaded_file($_FILES["image"]["tmp_name"][$i], $target_file);
                    $imgquery = "INSERT INTO imagefiles (imageid, reportid, fileLocation) VALUES ('$newfilename', '$reportid', '$target_file')";
                    $imgresult = $conn->query($imgquery);
                }
                echo "<script>window.location.href='manageImage?reportid=".$reportid."'</script>";
            }
        }

        elseif(strcmp($intent, 'requestSPC') == 0){
            if(isset($_POST['reportid'])){
                $reportid = $_POST['reportid'];
                $edate = $_POST['edate'];
                $requestid = md5(date('dmYHisu').rand(0,100));

                $query = "INSERT INTO spcRequests (requestid, reportid, tillDate) VALUES ('$requestid', '$reportid', '$edate')";
                $result = $conn->query($query);

                if($result === TRUE){
                    echo "<script>window.location.href='manageImage?reportid=".$reportid."'</script>";
                }else{
                    echo "<script>window.location.href='manageImage?reportid=".$reportid."'</script>";
                }
            }
        }
    }
?>
