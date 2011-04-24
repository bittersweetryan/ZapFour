<?php
    # functions-db.php file

    # Query Class

    Class Query {
        var $action;
        var $connect;

        function Query($query,$sql) {
            $this->action = mysql_query($query,$sql);
            $this->connect = $sql;
        }
		
		function Error() {
		    if(mysql_errno($this->connect))
		        return 'Error #' . mysql_errno($this->connect) . ': ' . mysql_error($this->connect) . '<br />';
		    else
		        return false;
		}
		
		function LastID() {
		    return mysql_insert_id($this->connect);
		}
		
		function Affected() {
		    return mysql_affected_rows($this->connect);
		}
		
        function NumRows() {
		    return mysql_num_rows($this->action);
		}
		
		function FetchAssoc() {
		    return mysql_fetch_assoc($this->action);
		}
    }
?>
