
<table>
    <?php
        foreach ($_SERVER as $parm => $value): ?>
        <tr>
            <td><?php print $parm; ?></td>
            <td><?php print $value; ?></td>
        </tr>
    <?php 
        endforeach; ?>
</table>