<?php // Odswiezanie co 1 sekunde ustawione, zeby mozliwa byla "gra w sieci"
    $page = $_SERVER['PHP_SELF'];
    $sec = "1";
?>
<!DOTYPE html>
<html> 
    <head>
        <style>
        .cell{
            width : 150px;
            font-size: 50px;
            color: yellow;
        }
        .button{
            width : 458px;
            font-size: 50px;
            color: green; 
        }
        table.center{
            margin-left:auto;
            margin-right:auto;
        }
        </style>
        <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
    <body style = "background-color:powderblue;"> 
        <?php 
            require_once('TicTacToeFunctions.php');
            RUN();
        ?>
        <br><br><br><br>;
        <FORM action="TicTacToe.php" method="POST"> 
        <TABLE class="center">
            <TR>
                <TD colspan='3'><INPUT name="info" type="reset" class="button" disabled value="<?php echo Move();?>"></TD>
            <TR>
                <TD><INPUT name="a11" type="submit" class="cell" <?php echo isDisabled('a11');?> value="<?php echo getValue('a11'); ?>"></TD>
                <TD><INPUT name="a12" type="submit" class="cell" <?php echo isDisabled('a12');?> value="<?php echo getValue('a12'); ?>"></TD>
                <TD><INPUT name="a13" type="submit" class="cell" <?php echo isDisabled('a13');?> value="<?php echo getValue('a13'); ?>"></TD>
            </TR>
            <TR>
                <TD><INPUT name="a21" type="submit" class="cell" <?php echo isDisabled('a21');?> value="<?php echo getValue('a21'); ?>"></TD>
                <TD><INPUT name="a22" type="submit" class="cell" <?php echo isDisabled('a22');?> value="<?php echo getValue('a22'); ?>"></TD>
                <TD><INPUT name="a23" type="submit" class="cell" <?php echo isDisabled('a23');?> value="<?php echo getValue('a23'); ?>"></TD>
            </TR>
            <TR>
                <TD><INPUT name="a31" type="submit" class="cell" <?php echo isDisabled('a31');?> value="<?php echo getValue('a31'); ?>"></TD>
                <TD><INPUT name="a32" type="submit" class="cell" <?php echo isDisabled('a32');?> value="<?php echo getValue('a32'); ?>"></TD>
                <TD><INPUT name="a33" type="submit" class="cell" <?php echo isDisabled('a33');?> value="<?php echo getValue('a33'); ?>"></TD>
            </TR>
            <TR>
                <TD colspan='3'><INPUT name="newgame" type="submit" class="button" value = "Restart"  ></TD>
            </TR>
        </TABLE>
        </FORM>
    </body>

</html>