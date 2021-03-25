<?php

require_once('configs/config.inc.php');

global $db;

$db_master = $db['database_master'];
$dbHandle = mysql_connect("localhost", $db['username'], $db['password']);
$company_id = 1;
$dbSel = mysql_select_db($db['database_master'], $dbHandle);

$res = mysql_query("SELECT * FROM company WHERE id = $company_id", $dbHandle);

while ($db_datas = mysql_fetch_array($res)) {
    $db_company = $db_datas['db_name'];
    $flag = 1;
    $dbSel = mysql_select_db($db_company, $dbHandle);
    $res_ticket = mysql_query("SELECT t.*,c.type AS category_type FROM support_tickets_old t INNER JOIN support_categories c ON t.category_id = c.id WHERE 1 ORDER BY id", $dbHandle);
    while ($db_tickets = mysql_fetch_array($res_ticket)) {
        $id = $db_tickets['id'];
        $date = $db_tickets['date'];
        $created_user = $db_tickets['created_user'];
        $ticket_type = $db_tickets['ticket_type'];
        $category_type = ($db_tickets['category_type'] == 'Internal') ? 1 : 2;
        $admin_user = $db_tickets['admin_user'];
        $priority = $db_tickets['priority'];
        $category_id = $db_tickets['category_id'];
        $title = $db_tickets['title'];
        $description = $db_tickets['description'];
        $attachment = $db_tickets['attachment'];
        $affected_user = $db_tickets['affected_user'];
        $affected_user_phone = $db_tickets['affected_user_phone'];
        $status = $db_tickets['status'];
        $dbSel = mysql_select_db($db['database_master'], $dbHandle);
        $sql_insert_master = "INSERT INTO support_ticket_master (company_id, category_type,date) VALUES($company_id, $category_type, '$date')";
        if (mysql_query($sql_insert_master)) {
            $ticket_id = mysql_insert_id();
            if ($ticket_id == $id) {
                if ($category_type == 1) {
                    $dbSel = mysql_select_db($db_company, $dbHandle);
                    $sql_insert_ticket = "INSERT INTO support_tickets (id, date, created_user, admin_user, category_id, priority, title, description, attachment, affected_user, affected_user_phone, status) VALUES($ticket_id, '$date', '$created_user', '$admin_user', $category_id, $priority, '$title', '$description', '$attachment', '$affected_user', '$affected_user_phone', $status)";
                    if (mysql_query($sql_insert_ticket)) {
                        $i = 0;
                        $res_answers = mysql_query("SELECT * FROM support_ticket_answers WHERE ticket_id = $ticket_id ORDER BY id", $dbHandle);
                        while ($db_answer = mysql_fetch_array($res_answers)) {
                            $date = $db_answer['date'];
                            $submited_user = $db_answer['submited_user'];
                            $answer = $db_answer['answer'];
                            $category_id = $db_answer['category_id'];
                            $priority = $db_answer['priority'];
                            $admin_user = $db_answer['admin_user'];
                            $attachment = $db_answer['attachment'];
                            $status = $db_answer['status'];
                            $hidden = $db_answer['hidden'];
                            $sql_insert_answer = "INSERT INTO support_ticket_answers (date, ticket_id, submited_user, answer, category_id, priority, admin_user, attachment, status, hidden) VALUES('$date', $ticket_id, '$submited_user', '$answer', $category_id, $priority, '$admin_user', '$attachment', $status, $hidden)";
                            if (!mysql_query($sql_insert_answer)) {
                                break;
                            }
                            $i++;
                        }
                        echo "TicketID:" . $ticket_id . ", Answers:" . $i . "<br/>";
                    }
                } else {
                    $dbSel = mysql_select_db($db['database_master'], $dbHandle);
                    $sql_insert_ticket = "INSERT INTO support_tickets (id, date, created_user, category_id, ticket_type, priority, title, description, attachment, status) VALUES($ticket_id, '$date', '$created_user', $category_id, $ticket_type, $priority, '$title', '$description', '$attachment', $status)";
                    if (mysql_query($sql_insert_ticket)) {
                        $i = 0;
                        $res_answers = mysql_query("SELECT * FROM support_ticket_answers WHERE ticket_id = $ticket_id ORDER BY id", $dbHandle);
                        while ($db_answer = mysql_fetch_array($res_answers)) {
                            $date = $db_answer['date'];
                            $submited_user = $db_answer['submited_user'];
                            $answer = $db_answer['answer'];
                            $category_id = $db_answer['category_id'];
                            $ticket_type = $db_answer['ticket_type'];
                            $priority = $db_answer['priority'];
                            $attachment = $db_answer['attachment'];
                            $status = $db_answer['status'];
                            $hidden = $db_answer['hidden'];
                            $sql_insert_answer = "INSERT INTO support_ticket_answers (date, ticket_id, submited_user, answer, ticket_type, category_id, priority, attachment, status, hidden) VALUES('$date', $ticket_id, '$submited_user', '$answer', $ticket_type, $category_id, $priority, '$attachment', $status, $hidden)";
                            if (!mysql_query($sql_insert_answer)) {
                                break;
                            }
                            $i++;
                        }
                        echo "TicketID:" . $ticket_id . ", Answers:" . $i . "<br/>";
                    }
                }
            } else {
                break;
            }
        } else {

            break;
        }
    }
}
