<?php

namespace App\Support;


class Azk
{
    public static function getMDStatus($id)
    {
        if (!$id) {
        	return '<td style="text-align:center;color:red">Tidak Tersedia</td>';
        } else
        return '<td style="text-align:center;">Tersedia</td>';;
    }

    public static function getStatusPenerbit($id)
    {
        if (!$id) {
            return '<td style="text-align:center;color:red">Non-Active</td>';
        } else
        return '<td style="text-align:center;">Active</td>';
    }

    public static function getStatusTransaksi($id)
    {
        if($id==0)
        {
            return '<td style="text-align:center;color:red">Belum Kembali</td>';
        }
        else
        {
            return '<td style="text-align:center;color:green">Sudah Kembali</td>';
        }
    }

    public static function getStatusDenda($id)
    {
        if($id==1)
        {
            return '<td style="text-align:center;color:red">Belum Dibayar</td>';
        }
        else
        {
            return '<td style="text-align:center;color:green">Sudah Dibayar</td>';
        }
    }

    public static function getDataDenda($id)
    {
        if($id==1)
        {
            return '<td style="text-align:center;color:red">Belum Dibayar</td>';
        } elseif ($id==2) {
            return '<td style="text-align:center;">Tidak Ada</td>';
        } else {
            return '<td style="text-align:center;color:green">Sudah Dibayar</td>';
            
        }
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

    public static function monthDropdown($name="month", $selected=null)
    {
        $dd = '<select class="form-control" name="'.$name.'" id="'.$name.'">';

        $months = array(
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember');

        $months_data = array(
                1 => 'January',
                2 => 'February',
                3 => 'March',
                4 => 'April',
                5 => 'May',
                6 => 'June',
                7 => 'July',
                8 => 'August',
                9 => 'September',
                10 => 'October',
                11 => 'November',
                12 => 'December');
        /*** the current month ***/
        $selected = is_null($selected) ? date('n', time()) : $selected;

        for ($i = 1; $i <= 12; $i++)
        {
                $dd .= '<option value="'.$months_data[$i].'"';
                if ($i == $selected)
                {
                        $dd .= ' selected';
                }
                /*** get the month ***/
                $dd .= '>'.$months[$i].'</option>';
        }
        $dd .= '</select>';
        return $dd;
    }

}
