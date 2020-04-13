<?php

namespace App\Support;


class Azk
{
    public static function getMDStatus($id)
    {
        if (!$id) {
        	return 'Tidak Tersedia';
        } else
        return 'Tersedia';
    }

    public static function showAlert($status, $message)
    {
        if($status == 'error')
        {
            return '<div class="alert alert-danger alert-notification alert-dismissible fade show" role="alert"><p class="mb-0">'.$message.'</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
        elseif($status == 'success')
        {
            return '<div class="alert alert-primary alert-notification alert-dismissible fade show " role="alert"><p class="mb-0">'.$message.'</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
        else
        {
            return '<div class="alert alert-warning alert-notification alert-dismissible fade show" role="alert"><p class="mb-0">'.$message.'</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
    }

}
