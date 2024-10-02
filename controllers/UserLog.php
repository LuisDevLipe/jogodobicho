<?php
namespace controllers;
include_once $_SERVER["DOCUMENT_ROOT"] . "/jogodobicho/models/UserLog.php";
use models\UserLog;

class UserLogController extends UserLog
{
    public function __construct($username)
    {
        parent::__construct(username: $username | '');
    }

    public function findUserLogs($queryOption, $queryParam): bool|array
    {
        if (!in_array(needle: $queryOption, haystack: ['--cpf', '--nome', '--all'])) {
            return false;
        }

        $query_result = $this->queryUserLogs(queryOption: $queryOption, queryParam: $queryParam);
        if ($query_result->num_rows === 0) {
            return false;
        }
        return $query_result->fetch_all(mode: MYSQLI_ASSOC);
    }
}

?>