<style>
            @page {
            margin: 0px 0px 0px 0px !important;
            padding: 0px 0px 0px 0px !important;
        }
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: normal;
            src: url(http://themes.googleusercontent.com/static/fonts/opensans/v8/cJZKeOuBrn4kERxqtaUH3aCWcynf_cDxXwCLxiixG1c.ttf) format('truetype');
            }

    html { margin: 0px;height:200px;}
	body {  
		font-family: 'Arial';
		}   

</style>
<?php
    function encode_img_base64( $img_path = false, $img_type = 'png' ){
        if( $img_path ){
            //convert image into Binary data
            $img_data = fopen ( $img_path, 'rb' );
            $img_size = filesize ( $img_path );
            $binary_image = fread ( $img_data, $img_size );
            fclose ( $img_data );
            $img_src = "data:image/".$img_type.";base64,".str_replace ("\n", "", base64_encode($binary_image));
            return $img_src;
        }
    
        return false;
    }

?>
<html>
    <body>

<table style="margin-top:0px" width="200">
    <tr>
        <td style="text-align:center;">
		<p style="margin-top:0pt;margin-bottom:0pt; line-height:115%; font-size:15pt"><?=$profil->nama?></p>
		<p style="margin-top:0pt;margin-bottom:0pt; line-height:115%; font-size:12pt"><?=$profil->alamat?></p>
        </td>
    </tr>       
</table>
<hr>
<table width="200">
<tr>
        <td style="text-align:center;">
		<p style="text-align:center;font-family:'Arial';margin-top:0px;margin-bottom:5px"><?=$row->poli?></p>
		<p style="text-align:center;font-family:'Arial';margin-top:0px;margin-bottom:5px"><?=$row->dpjp?></p>
		<p style="text-align:center;font-family:'Arial';margin-top:0px;margin-bottom:5px">No</p>
        <p style="text-align:center;font-family:'Arial';margin-top:0px;margin-bottom:5px;font-size:30pt"> <?=$row->antrian?></p>
	</tr>       
</table>
</table>
</body>
</html>
