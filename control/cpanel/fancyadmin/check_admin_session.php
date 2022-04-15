<?php

if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A" || (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    echo'<div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">*</button>
            <strong> Oh snap!</strong> Something is not right here. One of the following events have occured:
                <ul>
                    <li> It seems like your session is expired</li>
                    <li>You dont have sufficient priviledge to view this page.</li>
                    <li>You are not logged in as an Admin.</li>
                </ul>
        </div>';

        if ($_SESSION['UserType'] != "A") {
            echo'<div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">*</button>
                    <strong> Final Diagnosis!</strong> You are not logged in as an Admin.
                </div>';
                
        }
        
        exit;
        
    }