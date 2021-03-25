<?php
//include file attachment.php for saving file at DB , table into DataBase must be named "attachments"
require_once('class/attachment.php');
require_once('class/wl_log.php');

/**
 * @param $method
 * @param $companyName
 * @param $username
 */

function upload_attachment($method, $companyName, $username, $ids = [],$web = null)
{
$data = $_REQUEST . "\n" . $_FILES;
wl_log_write($data);
    if (!empty($_FILES)) {
        foreach ($_FILES as $FILE) {
            //$_FILES all file what we must save
            $errors1 = [];                                                                                                       // Store errors here

            $fileExtensionsAllowed = ['jpeg', 'jpg', 'pdf', 'png'];                                                                // These will be the only file extensions allowed

            $fileName = $FILE['name'];                                                                                          //File name
            $fileSize = $FILE['size'];                                                                                          // File size

            $fileTmpName = $FILE['tmp_name'];

            $fileExtension = strtolower(end(explode('.', $fileName)));//File extension

            if (!in_array($fileExtension, $fileExtensionsAllowed)) {                                                            // check can we upload file with this extension
                $errors1[] = "This file extension is not allowed. Please upload a JPEG or PNG,PDF file";
            }

            if ($fileSize > 2000000) {                                                                                          // check can we upload file with this file size max 2 MB
                $errors1[] = "File exceeds maximum size (2MB)";
            }
            if (empty($errors1)) {
                $strids = '';
                foreach ($ids as $id) {
                    $strids = $strids . $id . ',';
                }
                $attachment = new attachment();                                                                                     //create new object of class attachment
                $attachment->file_name = (strlen($fileName) > 10) ? substr($fileName, 0, 10) . '...' : $fileName;   //File name 10 character and other "..."
                $attachment->origin_file_name = $fileName;
                $attachment->upload_date = date('Y-m-d H:i');                                                            //Date when file was upload
                $attachment->uploaded_by = $username;

                if ($method == 0) {
                    $attachment->ids_mail = null;
                    $attachment->id_tickets = $ids[0];
                } else {
                    $attachment->ids_mail = $strids;
                    $attachment->id_tickets = null;

                }
                $last_insert_id = $attachment->attachment_add();
//                var_dump($attachment);//call function to save data about file into db
                if ($last_insert_id) {

                    foreach ($companyName as $item) {

                        $currentDirectory = getcwd();                                                                                  //get current directory

                        if ($method == 0) {                                                                                            // 0 - tickets ; 1 - mail
                            $uploadDirectory = '/' . $item['upload_dir'] . "/tickets/attachment/";
                        } else {
                            $uploadDirectory = "/" . $item['upload_dir'] . "/mail_attatch/";
                        }

                        $uploadPath = $currentDirectory . $uploadDirectory;                                                             //Path where we must save attached file

                        if (!is_dir($uploadPath)) {                                                                                     //check if directory where we want to upload already create
                            mkdir($uploadPath, 0777, true);                                                                  //if not create it
                        }
                        $didUpload = move_uploaded_file($fileTmpName, $uploadPath . $fileName);                     //download file into directory

                    }
                }


            } else {
                echo json_encode(['errors1' => $errors1]);
            }

        }
    } else {
        echo json_encode(['message' => 'Somethings went wrong']);
    }
}

